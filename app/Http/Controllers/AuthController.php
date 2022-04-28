<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// load Library
use DB;
use Illuminate\Support\Facades\Hash;

// Load Model
use App\Models\UserModel;

class AuthController extends Controller
{
    private $views      = '/auth';
    private $url        = "/auth";

    public function __construct()
    {
        $this->mUser = new UserModel();
    }

    public function loginBunker()
    {
        // Variable
        $data = [
            'title' => 'Halaman Rahasia',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/login_bunker", $data);
    }

    public function loginBunkerProses(Request $request)
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
        return redirect('superadmin/dashboard')->with('success', 'Berhasil Login');
    }
}