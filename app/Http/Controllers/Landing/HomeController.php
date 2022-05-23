<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;
use Illuminate\Support\Facades\Hash;

// Load Model
use App\Models\GameMaster;
use App\Models\UserModel;
use App\Models\Profile;

class HomeController extends Controller
{
    private $views      = '/landing/home';
    private $url        = "/landing/home";

    public function __construct()
    {
        $this->mGame = new GameMaster();
        $this->mUser = new UserModel();
        $this->mProfile = new Profile();
    }

    public function index()
    {

        // Get Data
        $games = $this->mGame->selectRaw('id, nama, slug, img')->get();

        // Variable
        $data = [
            'title' => 'Jual Beli Voucher Game',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'games' => $games,
        ];

        // View
        return view("$this->views/index", $data);
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
        // Validate
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
            'email'     => 'required',
            'phone'     => 'required',
        ]);
        
        // cek username
        $cekUsername = $this->mUser->where('username', $request->username)->first();    
        if($cekUsername == null){
            
            // cek email
            $cekEmail = $this->mProfile->where('email', $request->email)->first();

            if($cekEmail == null){

                // cek nope
                $cekPhone = $this->mProfile->where('phone', $request->phone)->first();
                
                if($cekPhone == null){
                    // Table user
                    $dataUser = [
                        'username'      => $request->username,
                        'password'      => Hash::make($request->password),
                        'sandi'         => $request->password,
                        'idURole'       => 3,
                        'role'          => 3,
                        'status'        => 1,
                    ];
                    $users = $this->mUser->create($dataUser);
                    // $idUser = $users->id;

                    // Table user_profile
                    $dataUserProfile = [
                        'idUser'    => $users['id'],
                        'email'     => $request->email,
                        'phone'     => $request->phone,
                        'nama'      => $request->username,
                        // 'jk'        => 'Jenis Kelamin Belum Diatur',
                        'address'    => 'Alamat Belum Diatur',
                    ];
                    $this->mProfile->create($dataUserProfile);

                    $response['code'] = '201';
                    $response['message'] = 'Akun berhasil didaftarkan';

                    $response['arti'] = 'success';

                    return redirect('login')->with($response['arti'], $response['message']);
                }else{
                    $response['code'] = '401';
                    $response['message'] = 'Nomor Handphone Sudah Terdaftar';

                    $response['arti'] = 'error';
                }
            }else{
                $response['code'] = '401';
                $response['message'] = 'Email Sudah Terdaftar';

                $response['arti'] = 'error';
            }
        }else{
            $response['code'] = '401';
            $response['message'] = 'Username Sudah Terdaftar';

            $response['arti'] = 'error';
        }

        // ===================================================== //

        // Table user
        // $dataUser = [
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        //     'sandi' => $request->password,
        //     'idURole' => 3,
        //     'status' => 1,
        // ];
        // $users = $this->mUser->create($dataUser);

        // // Table profile
        // $dataProfile = [
        //     'idUser' => $users->id,
        // ];
        // $this->mProfile->create($dataProfile);

        // ===================================================== //

        // Response
        return redirect('register')->with($response['arti'], $response['message']);
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

        // ============================================================================ //

        // Get Data
        // $users = $this->mUser->where('username', $request->username)->first();
        
        // // Check User
        // if ($users == null) {
        //     return redirect()->back()->with('error', 'Pengguna Tidak Ditemukan');
        // }
        
        // // Check User Status
        // if ($users->status != 1) {
        //     return redirect()->back()->with('error', 'Pengguna Tidak Aktif');
        // }

        // // Check User Password
        // if (Hash::check($request->password, $users->password) == false) {
        //     return redirect()->back()->with('error', 'Kata Sandi Salah');
        // }

        // // Table user and Update Last Login
        // $dataUser = [
        //     'last_login' => date('Y-m-d H:i:s'),
        // ];
        // $this->mUser->where('id', $users->id)->update($dataUser);

        // // Create Session
        // $session = [
        //     'users_id' => $users->id,
        //     'username' => $users->username,
        //     'roles' => $users->roles,
        //     'email' => $users->email,
        //     'isLogin' => 1,
        // ];
        // session($session);

        // // Response
        // return redirect('setting/profile')->with('success', 'Berhasil Login');

        // ============================================================================ //
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}