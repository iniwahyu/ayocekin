<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model
use App\Models\UserModel;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $views      = '/superadmin/profile';
    private $url        = "/superadmin/profile";

    public function __construct()
    {
        $this->mUser = new UserModel();
        $this->mProfile = new Profile();
    }

    public function index()
    {
        // Get Data
        $profiles = $this->mProfile->where('idUser', session()->get('users_id'))->first();

        // Variable
        $data = [
            'title' => 'Halaman Rahasia',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'profiles' => $profiles,
        ];

        // View
        return view("$this->views/index", $data);
    }

    public function update(Request $request, $id)
    {
        // Validate

        // Get Data
        $users = $this->mUser->where('id', session()->get('users_id'))->first();

        // Table
        $dataProfile = [
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $this->mProfile->where('idUser', $users->id)->update($dataProfile);

        // Response
        return redirect("$this->url")->with('success', 'Update Profile');
    }
}