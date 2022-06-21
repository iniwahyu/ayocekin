<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Model
use App\Models\Order;

class DashboardController extends Controller
{
    private $views      = '/superadmin/dashboard';
    private $url        = "/superadmin/dashboard";

    public function __construct()
    {
        $this->mOrder = new Order();
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

    public function countTopup()
    {
        // Get Data
        $orderAll = $this->mOrder->count();
        $orderProcess = $this->mOrder->where('status', 5)->count();
        $orderPending = $this->mOrder->where('status', 1)->count();

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Data Ada',
            'order_all' => $orderAll,
            'order_process' => $orderProcess,
            'order_pending' => $orderPending,
        ];
        return response()->json($response);
    }
}