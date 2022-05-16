<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model
use App\Models\GameMaster;
use App\Models\GameProduk;

class HistoryController extends Controller
{
    private $views      = '/landing/product';
    private $url        = "/landing/product";

    public function __construct()
    {
        $this->mGame = new GameMaster();
        $this->mGameProduk = new GameProduk();
    }

    public function index($slug = null)
    {
        // Get Data
        echo "halo";
        die;

        // Variable
        $data = [
            'title' => 'Produk',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'games' => $games,
            'products' => $products,
        ];

        // View
        return view("$this->views/index", $data);
    }
}