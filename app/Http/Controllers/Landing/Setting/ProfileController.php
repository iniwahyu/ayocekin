<?php

namespace App\Http\Controllers\Landing\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model
use App\Models\Profile;

class ProfileController extends Controller
{
    private $views      = '/landing/setting/profile';
    private $url        = "/setting/profile";

    public function __construct()
    {
        $this->mProfile = new Profile();
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

        // View
        return view("$this->views/index", $data);
    }

    public function update(Request $request, $id)
    {
        
    }
}