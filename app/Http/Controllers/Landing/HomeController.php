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

class HomeController extends Controller
{
    private $views      = '/landing/home';
    private $url        = "/landing/home";

    public function __construct()
    {
        $this->mGame = new GameMaster();
        $this->mUser = new UserModel();
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
            'username' => 'required',
            'password' => 'required',
        ]);

        // Table user
        $dataUser = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'sandi' => $request->password,
            'idURole' => 3,
            'status' => 1,
        ];
        $this->mUser->create($dataUser);

        // Response
        return redirect('login')->with('success', 'Registrasi Berhasil');
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
        $users = $this->mUser->where('username', $request->username)->first();
        
        // Check User
        if ($users == null) {
            return redirect()->back()->with('error', 'Pengguna Tidak Ditemukan');
        }
        
        // Check User Status
        if ($users->status != 1) {
            return redirect()->back()->with('error', 'Pengguna Tidak Aktif');
        }

        // Check User Password
        if (Hash::check($request->password, $users->password) == false) {
            return redirect()->back()->with('error', 'Kata Sandi Salah');
        }

        // Table user and Update Last Login
        $dataUser = [
            'last_login' => date('Y-m-d H:i:s'),
        ];
        $this->mUser->where('id', $users->id)->update($dataUser);

        // Create Session
        $session = [
            'users_id' => $users->id,
            'username' => $users->username,
            'roles' => $users->roles,
            'email' => $users->email,
            'isLogin' => 1,
        ];
        session($session);

        // Response
        return redirect('profile')->with('success', 'Berhasil Login');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}