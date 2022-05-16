<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;
use Str;
use File;

// Load Model
use App\Models\BankManual;
use App\Models\GameProduk;
use App\Models\GameMaster;
use App\Models\Order;

class PaymentController extends Controller
{
    private $views      = '/landing/payment';
    private $url        = "/payment";

    public function __construct()
    {
        $this->mBankManual = new BankManual();
        $this->mGameProduk = new GameProduk();
        $this->mGameMaster = new GameMaster();
        $this->mOrder = new Order();
    }

    public function order(Request $request)
    {
        $setSession = [
            'order' => $request->all(),
            'checkout' => true,
        ];
        session($setSession);
        // dd($request->all());
        return redirect('payment/checkout');
    }

    public function checkout()
    {
        if (session()->get('checkout') != true) {
            // echo "ggada akses";
            // die;
        }
        // Variable Session
        $serviceId = session()->get('order')['services'];
        $paymentId = session()->get('order')['payment'];
        $paymentDetailId = session()->get('order')['payment_detail'];

        // Get Data
        $services = $this->mGameMaster->getGameProdukDetail($serviceId)->first();
        if ($paymentId == 1) {
            $paymentDetail = [];
        } else {
            $paymentDetail = $this->mBankManual->where('id', $paymentDetailId)->first();
        }

        // Variable
        $data = [
            'title' => 'Checkout',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'services' => $services,
            'paymentDetail' => $paymentDetail,
        ];
        // dd($data);

        // View
        return view("$this->views/checkout", $data);
    }

    public function paying(Request $request)
    {
        // Variable Session
        $serviceId = session()->get('order')['services'];
        $paymentId = session()->get('order')['payment'];
        $paymentDetailId = session()->get('order')['payment_detail'];

        // Get Data
        $services = $this->mGameMaster->getGameProdukDetail($serviceId)->first();
        if ($paymentId == 1) {
            $paymentDetail = [];
        } else {
            $paymentDetail = $this->mBankManual->where('id', $paymentDetailId)->first();
        }

        // File
        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/proof/", $fileName);
        }

        // Table order
        // 1: Pembayaran Berhasil, 2:Pembayaran Tertunda, 3:Pembayaran Invalid, 4: Pembayaran Gagal
        $dataOrder = [
            'idGMaster' => $services->game_id,
            'idGProduk' => $services->product_id,
            'idUser' => 1,
            'log_akun' => session()->get('order')['user_id'] ?? null,
            'log_server' => session()->get('order')['server_id'] ?? null,
            'status' => 2,
            'img' => $fileName ?? null,
            'idPayment' => $paymentId,
            'log_payment' => $paymentDetail->nama,
        ];
        $this->mOrder->create($dataOrder);

        // Remove Session
        session()->forget('order');
        session()->forget('checkout');
        
        // Response
        return redirect("history");
    }

    // Response JSON
    public function getPaymentList($type = null)
    {
        $data = [];
        if ($type == 1) {
            $data = [];
        } else {
            $data = $this->mBankManual->selectRaw('id, nama, rekening, img, kode, nama_pemegang')->where('idPayment', 2)->get();
        }

        // Response
        if ($data == null) {
            $response = [
                'code' => 404,
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => null,
            ];
        } else {
            $response = [
                'code' => 200,
                'status' => true,
                'message' => 'Data Ditemukan',
                'data' => $data,
            ];
        }
        return response()->json($response);
    }
}