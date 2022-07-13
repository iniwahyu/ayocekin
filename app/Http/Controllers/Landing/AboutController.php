<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model


class AboutController extends Controller
{
    private $views      = '/landing/about';
    private $url        = "/about";

    public function __construct()
    {
        
    }

    public function index()
    {
        // Get Data

        // Variable
        $data = [
            'title' => 'About Us',
            'url' => $this->url,
            'breadcrumb' => [
                'Contact',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
    }
}