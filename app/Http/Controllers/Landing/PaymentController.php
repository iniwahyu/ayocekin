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
use App\Models\OrderInvoice;
use App\Models\OrderLog;

class PaymentController extends Controller
{
    private $views      = '/landing/payment';
    private $url        = "/payment";

    public function __construct()
    {
        $this->mBankManual      = new BankManual();
        $this->mGameProduk      = new GameProduk();
        $this->mGameMaster      = new GameMaster();
        $this->mOrder           = new Order();
        $this->mOrderInvoice    = new OrderInvoice();
        $this->mOrderLog        = new OrderLog();
    }

    public function order(Request $request)
    {
        // Validate
        // dd($request->all());
        if ($request->has('user_id') && $request->has('server_id')) {
            $request->validate([
                'user_id' => 'required',
                'server_id' => 'required',
                'services' => 'required',
                'payment' => 'required',
            ]);
        }
        if ($request->has('user_id')) {
            $request->validate([
                'user_id' => 'required',
                'services' => 'required',
                'payment' => 'required',
            ]);
        }
        if ($request->has('server_id')) {
            $request->validate([
                'server_id' => 'required',
                'services' => 'required',
                'payment' => 'required',
            ]);
        }
        if ($request->has('kingdom') && $request->has('user_id') && $request->has('email_game')) {
            $request->validate([
                'kingdom' => 'required',
                'user_id' => 'required',
                'email_game' => 'required',
                'services' => 'required',
                'payment' => 'required',
            ]);
        }

        // Get Data
        $products = $this->mGameProduk->where('id', $request->services)->first();
        $price = $products->harga;
        $priceNew = $price;
        if ($request->payment == 2) {
            $priceNew = $price + rand(100,999);
        }

        $setSession = [
            'order' => $request->all(),
            'price' => $price,
            'price_new' => $priceNew,
            'checkout' => true,
        ];
        session($setSession);
        return redirect('payment/checkout');
    }

    public function checkout()
    {
        if (session()->get('checkout') != true) {
            return redirect('/')->with('error', 'Sorry');
        }
        // Variable Session
        $serviceId          = session()->get('order')['services'];
        $paymentId          = session()->get('order')['payment'];
        $paymentDetailId    = session()->get('order')['payment_detail'];

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

        $invoiceCode  = strtoupper(bin2hex(random_bytes(5)));
        $invoiceCode = date('dmY').'-'.$invoiceCode;


        // jika payment manual maka bayar=harga
        if($paymentId==2){

            $dataInvoice = [
                'idUser'            => session()->get('users_id'),
                'kode_invoice'      => $invoiceCode,
                'status'            => 1,
                'payment_status'    => 1,
            ];
            $this->mOrderInvoice->create($dataInvoice);

            $gameProduk     = $this->mGameProduk->where('id', $services->product_id)->first();
            $gameMaster     = $this->mGameMaster->where('id', $gameProduk->idGMaster)->first();

            // Table order
            // payment status
            // 1: Pending, 2: Tertunda, 3:Invalid, 4: Gagal, 5: di Terima
            // status transaksi
            // 1: Pending, 2:DiKonfirmasi, 3:Proses, 4:di Tolak , 5: Selesai
            $dataOrder = [
                'idGMaster'         => $services->game_id,
                'idGProduk'         => $services->product_id,
                'idUser'            => session()->get('users_id'),
                'status'            => 1,
                'payment_status'    => 1,
                'img'               => $fileName ?? null,
                'idPayment'         => $paymentId,
                'kode_invoice'      => $invoiceCode,
                'payment'           => $paymentDetail->nama.'-'.$paymentDetail->rekening, // isi bank-norek (admin)
                'akun'              => session()->get('order')['user_id'] ?? null,
                'server'            => session()->get('order')['server_id'] ?? null,
                'kingdom'           => session()->get('order')['kingdom'] ?? null,
                'email_game'        => session()->get('order')['email_game'] ?? null,
                'harga'             => $gameProduk['harga'],
                'bayar'             => session()->get('price_new'),
            ];
            $simpanOrder = $this->mOrder->create($dataOrder);

            // log order
            $dataOrderLog = [
                'idOrder'           => $simpanOrder['id'],
                'kode_invoice'      => $invoiceCode,
                'game'              => $simpanOrder->game->nama,
                'gameProduk'        => $simpanOrder->gameProduk->nama,
                'akun'              => session()->get('order')['user_id'] ?? null,
                'server'            => session()->get('order')['server_id'] ?? null,
                'kingdom'           => session()->get('order')['kingdom'] ?? null,
                'email_game'        => session()->get('order')['email_game'] ?? null,
                'harga'             => $gameProduk['harga'],
                'bayar'             => session()->get('price_new'),
                'status'            => 1,
                'status_payment'    => 1,
                'payment'           => $paymentDetail->nama.'-'.$paymentDetail->rekening, // isi bank-norek (admin)
                'payment_jenis'     => 'Manual',
                'img'               => $fileName ?? null,
                'akun_pemesan'      => $simpanOrder->user->username,
            ];
            $this->mOrderLog->create($dataOrderLog);

        }

        // Remove Session
        session()->forget('order');
        session()->forget('checkout');
        
        if ($gameMaster->qserver == 5) {
            $message = 'Orderan Baru Kode *#' . $invoiceCode . '*';
            // $status = kirimWhatsapp(); //notif order
        } else {

        }

        // echo json_encode($status); die;

        // Response
        return redirect("setting/history")->with('success', 'Konfirmasi Pembayaran sudah dikirim ke admin. ');
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