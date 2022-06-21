<?php

namespace App\Http\Controllers\Landing\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;
use Illuminate\Support\Facades\Hash;

// Load Model
use App\Models\Profile;
use App\Models\UserModel;

class ProfileController extends Controller
{
    private $views      = '/landing/setting/profile';
    private $url        = "/setting/profile";

    public function __construct()
    {
        $this->mProfile = new Profile();
        $this->mUser = new UserModel();
    }

    public function index()
    {
        // Get Data
        $profiles = $this->mProfile->where('idUser', session()->get('users_id'))->first();

        // Variable
        $data = [
            'title' => 'Profile',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'profiles' => $profiles,
        ];
        // dd($data);

        // View
        return view("$this->views/index", $data);
    }

    public function update(Request $request, $id)
    {
        // Validate

        // Table profile
        $dataProfiles = [
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        $this->mProfile->where('id', $id)->update($dataProfiles);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Mengubah Profile');
    }

    public function updatePassword(Request $request, $id)
    {
        // Get Data
        $members = $this->mProfile->where('id', $id)->first();

        // Validate

        // Table user
        $dataUsers = [
            'password' => Hash::make($request->password),
            'sandi' => $request->password,
        ];
        $this->mUser->where('id', $members->idUser)->update($dataUsers);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Mengubah Profile');
    }
}