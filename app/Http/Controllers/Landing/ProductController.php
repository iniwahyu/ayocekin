<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;

// Load Model
use App\Models\GameMaster;
use App\Models\GameProduk;
use App\Models\PaymentQrcode;

class ProductController extends Controller
{
    private $views      = '/landing/product';
    private $url        = "/landing/product";

    public function __construct()
    {
        $this->mGame = new GameMaster();
        $this->mGameProduk = new GameProduk();
        $this->mPaymentQr = new PaymentQrcode();
    }

    public function index($slug = null)
    {
        // Get Data
        $games = $this->mGame->selectRaw('id, nama, img, deskripsi, qserver, panduan, create_time')->where('slug', $slug)->first();
        $products = $this->mGameProduk->selectRaw('id, nama, img, harga')->where('idGMaster', $games->id)->get();
        $paymentManual = DB::table('payment_bank')->where('deleted_at', null)->get();
        $paymentQr = $this->mPaymentQr->all();

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
            'paymentManual' => $paymentManual,
            'paymentQr' => $paymentQr,
        ];

        // View
        return view("$this->views/index", $data);
    }
}