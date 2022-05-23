<?php

namespace App\Http\Controllers\Landing\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model
use App\Models\Order;

class HistoryController extends Controller
{
    private $views      = '/landing/setting/history';
    private $url        = "/setting/history";

    public function __construct()
    {
        $this->mOrder = new Order();
    }

    public function index()
    {
        // Get Data
        // Variable
        $data = [
            'title' => 'History',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
    }

    // Response JSON
    public function getData(Request $request)
    {
        // Get Data
        $data = $this->mOrder->getOrderUser(session()->get('users_id'))->get();

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Data Ditemukan',
            'data' => $data,
        ];
        return response()->json($response);
    }
    
    public function getOrderUser()
    {
        // SELECT
        // o.`id`, o.`create_time`, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`
        // FROM `order` AS o
        // JOIN game_master AS gm ON gm.`id` = o.`idGMaster`
        // JOIN game_produk AS gp ON gp.`id` = o.`idGProduk`
        // WHERE o.`idUser` = '4'
        $query = DB::table('order AS o');
        $query->selectRaw('o.`id`, o.`create_time`, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`');
        $query->join('game_master AS gm', 'gm.id', '=', 'i.idGMaster');
        $query->join('game_produk AS gp', 'gp.id', '=', 'o.idGProduk');
        $query->where('o.idUser', $usersId);
        return $query;
    }
}