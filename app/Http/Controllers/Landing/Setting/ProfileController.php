<?php

namespace App\Http\Controllers\Landing\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model
use App\Models\GameMaster;
use App\Models\GameProduk;

class ProductController extends Controller
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
        $games = $this->mGame->selectRaw('id, nama, deskripsi')->where('slug', $slug)->first();
        $products = $this->mGameProduk->selectRaw('id, nama, img, harga')->where('idGMaster', $games->id)->get();

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