<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Libary
use DB;

// Load Model

class SandboxController extends Controller
{
    private $views      = '/superadmin/dashboard';
    private $url        = "/superadmin/dashboard";

    public function __construct()
    {

    }

    public function mailRegister()
    {
        // Variable
        $data = [
            'title' => 'Halaman Login',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'kode' => 1,
        ];

        // View
        return view("landing/home/mail_register", $data);
    }

    public function mailForgot()
    {
        // Variable
        $data = [
            'title' => 'Halaman Login',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'kode' => 1,
        ];

        // View
        return view("landing/home/mail_forgot", $data);
    }
}