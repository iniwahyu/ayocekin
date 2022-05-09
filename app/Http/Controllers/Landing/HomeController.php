<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model

class HomeController extends Controller
{
    private $views      = '/landing/home';
    private $url        = "/landing/home";

    public function __construct()
    {

    }

    public function index()
    {
        // Variable
        $data = [
            'title' => 'Jual Beli Voucher Game',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
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
        dd($request->all());
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}