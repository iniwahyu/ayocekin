<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model

class ProductController extends Controller
{
    private $views      = '/landing/product';
    private $url        = "/landing/product";

    public function __construct()
    {

    }

    public function index()
    {
        // Variable
        $data = [
            'title' => 'Produk',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
    }
}