<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Libary
use DB;

// Load Model

class MasterController extends Controller
{
    private $views      = '/superadmin/dashboard';
    private $url        = "/superadmin/dashboard";

    public function __construct()
    {

    }

    public function role()
    {
        // Get Data
        $data = DB::table('user_role')->get();

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Data Tersedia',
            'data' => $data,
        ];
        return response()->json($response);
    }
}