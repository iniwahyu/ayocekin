<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $views      = '/superadmin/dashboard';
    private $url        = "/superadmin/dashboard";

    public function __construct()
    {

    }

    public function index()
    {
        // Variable
        $data = [
            'title' => 'Dashboard',
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