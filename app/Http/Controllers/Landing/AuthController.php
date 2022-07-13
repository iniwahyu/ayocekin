<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;
use Str;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;

// Load Model
use App\Models\GameMaster;
use App\Models\UserModel;
use App\Models\Profile;
use App\Models\Banner;

class AuthController extends Controller
{
    private $views      = '/landing/auth';
    private $url        = "/landing/auth";

    public function __construct()
    {
        $this->mUser    = new UserModel();
        $this->mProfile = new Profile();
    }

    public function register()
    {
        // Variable
        $data = [
            'title' => 'Halaman Register',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/register", $data);
    }

    public function registerProses(Request $request)
    {
        // 0: Pending, 1: Tidak Aktif, 2: Aktif, 3: Banned
        // Validate
        $request->validate([
            'username'  => 'required|unique:user,username|min:6|max:50',
            'password'  => 'required|min:6',
            'email'     => 'required|unique:profile,email',
            'phone'     => 'required|unique:profile,phone',
        ]);

        if (substr($request->phone, 0, 2) != '62') {
            echo "Harus diawali dengan 62";
            return redirect()->back()->with('error', 'Maaf! Nomor Handphone Harus Diawali dengan 62')->withInput();
        }
        if (strlen($request->phone) < 10) {
            return redirect()->back()->with('error', 'Maaf! Nomor Handphone Kurang dari 10 Karakter')->withInput();
        }
        if (strlen($request->phone) > 13) {
            return redirect()->back()->with('error', 'Maaf! Nomor Handphone Lebih dari 13 Karakter')->withInput();
        }
        // dd($request->all());
    
        // ===================================================== //
        DB::beginTransaction();
        try {
            // Global Variable
            $otpCode = rand(111111,999999);

            // Table user
            $dataUser = [
                'username'      => $request->username,
                'password'      => Hash::make($request->password),
                'sandi'         => $request->password,
                'idURole'       => 3,
                'role'          => 3,
                'status'        => 0,
                'otp'           => $otpCode,
            ];
            $users = $this->mUser->create($dataUser);
            // $idUser = $users->id;
    
            // Table user_profile
            $dataUserProfile = [
                'idUser'    => $users->id,
                'email'     => $request->email,
                'phone'     => phoneIndo($request->phone),
                'nama'      => $request->username,
                // 'jk'        => 'Jenis Kelamin Belum Diatur',
                'address'    => 'Alamat Belum Diatur',
            ];
            $this->mProfile->create($dataUserProfile);

            // Send Mail
            // $this->mailRegister('Email Verifikasi', $request->email, $users->id);

            // Send Whatsapp
            $message = 'Terima Kasih Sudah Melakukan Pendaftaran. Berikut Kode OTP Anda%0a*'.$otpCode.'*';
            kirimWhatsapp($request->phone, $message, 'express');

            // Response
            DB::commit();
            $response['code'] = '201';
            $response['message'] = 'Akun berhasil didaftarkan';

            $response['arti'] = 'success';
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }

        // Response
        return redirect('verification/' . $users->id)->with($response['arti'], $response['message']);
    }

    public function verification($usersId)
    {
        // Get Data
        $users = $this->mUser->where('id', $usersId)->first();

        if ($users->status != 0) {
            // Response
            return redirect('/')->with('error', 'Maaf! Link Anda Expired');
        }

        // Variable
        $data = [
            'title' => 'Halaman Verifikasi',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'usersId' => $usersId,
        ];

        // View
        return view("$this->views/verification", $data);
    }

    public function verificationProses(Request $request)
    {
        // Get Data
        $users = $this->mUser->where(['id' => $request->id, 'otp' => $request->otp])->first();

        if ($users == null) {
            // Response
            $response = [
                'code' => 404,
                'status' => false,
                'message' => 'OTP Tidak Sesuai',
                'data' => ''
            ];
            return response()->json($response);
        }

        // Update
        $dataUser = [
            'status' => 1,
        ];
        $this->mUser->where('id', $request->id)->update($dataUser);

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'OTP Sesuai',
            'data' => ''
        ];
        return response()->json($response);
    }

    public function verificationRegenerate($usersId)
    {
        // Get Data
        $users = $this->mUser->where('id', $usersId)->first();
        $profile = $this->mProfile->where('idUser', $usersId)->first();

        // Generate
        $otpCode = rand(111111,999999);
        // Table user
        $dataUser = [
            'otp' => $otpCode,
        ];
        $this->mUser->where('id', $usersId)->update($dataUser);

        // Send Whatsapp
        $message = '*[PERMINTAAN ULANG]*%0aTerima Kasih Sudah Melakukan Pendaftaran.Berikut Kode OTP Anda%0a*'.$otpCode.'*';
        kirimWhatsapp($profile->phone, $message, 'express');

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Berhasil Regenerate',
            'data' => $otpCode,
        ];
        return response()->json($response);
    }

    public function forgot()
    {
        // Variable
        $data = [
            'title' => 'Halaman Forgot',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/forgot", $data);
    }

    public function forgotProses(Request $request)
    {
        // Get Data
        $profiles = $this->mProfile->where('email', $request->email)->first();
        if ($profiles == null) {
            return redirect()->back()->with('error', 'Maaf! Email Tidak Diitemukan');
        }

        // Variable
        $codeRecovery = Str::uuid();
        
        // Table user
        $dataUser = [
            'recovery' => $codeRecovery,
            'recovery_request' => Carbon::now(),
        ];
        $this->mUser->where('id', $profiles->idUser)->update($dataUser);

        // Send Mail
        $this->mailForgot('Lupa Kata Sandi', $request->email, $codeRecovery);

        // Response
        return redirect()->back()->with('success', 'Silahkan Cek Email/Spam');
    }

    public function recoveryPass($code)
    {
        // Variable
        $data = [
            'title' => 'Halaman Forgot',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'code' => $code,
        ];

        // View
        return view("$this->views/recoverypass", $data);
    }

    public function recoveryPassProses(Request $request, $code)
    {
        // Get Data
        $users = $this->mUser->where('recovery', $code)->first();

        if ($users == null) {
            return redirect()->back()->with('error', 'Permintaan Tidak Valid');
        }

        // Validate

        // Table user
        $dataUser = [
            'password' => Hash::make($request->password),
            'sandi' => $request->password,
        ];
        $this->mUser->where('id', $users->id)->update($dataUser);

        // Response
        return redirect('login')->with('success', 'Berhasil Mengubah Password');
    }

    public function login()
    {
        // Variable
        $data = [
            'title' => 'Halaman Login',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/login", $data);
    }

    public function loginProses(Request $request)
    {
        // Validate
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Get Data
        $users      = $this->mUser->where('username', $request->username)->first();

        // Check Data Exists or Not
        // if ($users == null || $users->role != 2) {
        if ($users == null) {
            return redirect()->back()->with('error', 'Akun Tidak Ditemukan');

            $response['code'] = '204';
            $response['message'] = 'Akun Tidak Ditemukan';

            // return response()->json($response, 204);
        }else{

            // Check Password True or False
            if (Hash::check($request->password, $users->password) == false) {
                // return redirect()->back()->with('gagal', 'Kata Sandi Salah / Tidak Sesuai');
                return redirect()->back()->with('error', 'Akun Tidak Ditemukan');

                $response['code'] = '204';
                $response['message'] = 'Password Tidak Sesuai';

                // return response()->json($response, 204);
            }else{
                // Check Status is Active or InActive
                if ($users->status != 1) {
                    return redirect()->back()->with('error', 'Akun Kamu Belum Aktif. Aktifkan Terlebih Dahulu Melalui Email');
                    
                    $response['code'] = '204';
                    $response['message'] = 'Akun Kamu Belum Aktif. Aktifkan Terlebih Dahulu Melalui Email';

                    // return response()->json($response, 204);
                }else if($users->status == 1){
                    // Table user and Update Last Login
                    $dataUser = [
                        'last_login' => date('Y-m-d H:i:s'),
                    ];
                    $this->mUser->where('id', $users->id)->update($dataUser);

                    // Create Session
                    $session = [
                        'users_id'  => $users->id,
                        'username'  => $users->username,
                        'role'      => $users->role,
                        'email'     => $users->email,
                        'isLogin'   => 1,
                    ];
                    session($session);

                    $response['code'] = '200';
                    $response['message'] = 'Data ditemukan';
                    // $response['data'] = $data;

                    // Response
                    // return redirect('setting/profile')->with('success', 'Berhasil Login');
                    return redirect('/')->with('success', 'Berhasil Login');

                    // return response()->json($response, 200);
                }
            }
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function activation($usersId)
    {
        
    }

    public function thanks()
    {
        // Variable
        $data = [
            'title' => 'Halaman Terima Kasih',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/thanks", $data);
    }

    public function mailForgot($title = null, $to = null, $kode = null)
    {
        $mail = new PHPMailer(true);
        
        try {
            // Setting Server Email / SMTP
            $mail->SMTPDebug    = 1;
            $mail->isSMTP();
            $mail->Host         = 'mail.ayocekin.com';
            $mail->SMTPAuth     = true;
            $mail->Username     = 'no-reply@ayocekin.com';
            $mail->Password     = '=5TI@3$%P_]&';
            $mail->SMTPSecure   = 'ssl';
            // $mail->Port         = 587;
            $mail->Port         = 465;
            
            // Setting Sender
            $mail->setFrom('no-reply@ayocekin.com', 'no-reply');
            
            // Setting Recipient
            $mail->addAddress($to);
            // Setting Optional
            $mail->addCC('no-reply@ayocekin.com');
            $mail->addReplyTo('no-reply@ayocekin.com', 'no-reply');

            // Setting Body Email
            $mail->isHTML(true);            
            $mail->Subject      = $title . " #".time();
            $body               = view($this->views . "/mail_forgot")->with(['kode' => $kode]);
            // $body               = 'haiii';
            $mail->Body         = $body;
            
            // Setting Connection SMTP
            $mail->smtpConnect([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]);

            // dd($mail);

            // Send Email and Checking
            if( !$mail->send() ) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}