<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library

// Load Model

class ContactController extends Controller
{
    private $views      = '/landing/contact';
    private $url        = "/contact";

    public function __construct()
    {
        
    }

    public function index()
    {
        // Get Data

        // Variable
        $data = [
            'title' => 'Jual Beli Voucher Game',
            'url' => $this->url,
            'breadcrumb' => [
                'Contact',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
    }

    public function store(Request $request)
    {
        // Validate

        // Table

        // Response
        return redirect()->back()->with('success', 'Terima Kasih');
    }
}