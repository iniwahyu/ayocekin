<?php

//redirect ke folder
namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Hash;
use Str;
use File;
use DataTables;

use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\OrderLog;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use App\Models\GameMaster;
// use App\Models\UserModel;
use App\Models\Profile;

class OrderTopupController extends Controller
{
    private $views      = '/superadmin/order';
    private $url        = '/superadmin/order';
    private $title      = 'Halaman Kelola Order Topup';

    public function __construct()
    {
        $this->mOrder           = new Order();
        $this->mOrderInvoice    = new OrderInvoice();
        $this->mOrderLog        = new OrderLog();
        $this->mOrderStatus     = new OrderStatus();
        $this->mPaymentStatus   = new PaymentStatus();
        $this->mGame            = new GameMaster();
        // $this->mUser            = new UserModel();
        $this->mProfile         = new Profile();
    }

    public function index()
    {
        $orderInvoice = $this->mOrderInvoice->all();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'orderInvoice'         => $orderInvoice,
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create()
    {
        $qserver = $this->mQServer->all();
        $data = [
            'title'         => 'Halaman Tambah Game',
            'url'           => $this->url,
            'qserver'          => $qserver
        ];
        // View
        return view($this->views . "/create", $data);
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // $orderInvoice   = $this->mOrderInvoice->where('kode_invoice', $id)->first();
        $order          = $this->mOrder->where('kode_invoice', $id)->first();
        $game = $this->mGame->where('id', $order['idGMaster'])->first();

        $orderStatus    = $this->mOrderStatus->all();
        $paymentStatus  = $this->mPaymentStatus->all();
        

        $data = [
            'title'             => 'Halaman Edit Game',
            'url'               => $this->url,
            // 'orderInvoice'      => $orderInvoice,
            'order'             => $order,
            'qserver'             => $game['qserver'],
            'orderStatus'       => $orderStatus,
            'paymentStatus'     => $paymentStatus,
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {

        $order          = $this->mOrder->where('kode_invoice', $id)->first();
        $orderStatus    = $this->mOrderStatus->where('id', $request->status)->first();
        $paymentStatus  = $this->mPaymentStatus->where('id', $request->payment_status)->first();
        // $user           = $this->mUser->where('id', $order['idUser'])->first();
        $profile        = $this->mProfile->where('idUser', $order['idUser'])->first();

        // echo json_encode($request->all()); die;

        $dataOrder = [
            'status'            => $request->status,
            'payment_status'    => $request->payment_status,
        ];
        $this->mOrder->where('kode_invoice', $id)->update($dataOrder);

        $dataOrderInvoice = [
            'status'            => $request->status,
            'payment_status'    => $request->payment_status,
        ];
        $this->mOrderInvoice->where('kode_invoice', $id)->update($dataOrderInvoice);

        $dataOrderLog = [
            'idOrder'           => $order['idOrder'],
            'kode_invoice'      => $order['kode_invoice'],
            'game'              => $order->game->nama,
            'gameProduk'        => $order->gameProduk->nama,
            'akun'              => $order['akun'],
            'server'            => $order['server'],
            'harga'             => $order['harga'],
            'bayar'             => $order['bayar'],
            'status'            => $orderStatus->nama,
            'payment_status'    => $paymentStatus->nama,
            'payment'           => $order['payment'],
            'payment_jenis'     => $order['payment_jenis'],
            'img'               => $order['img'],
            'akun_pemesan'      => $order['akun_pemesan'],
            'akun_admin'        => session()->get('users_id'),
        ];

        // echo json_encode($dataOrderLog); die;
        $this->mOrderLog->create($dataOrderLog);

        // jika order selesai
        if($request->status == 4){
            // Send Whatsapp
            $message = 'Terima Kasih Sudah Melakukan Order. Pembayaran Anda sudah di Konfirmasi, Mohon di Tunggu';
            kirimWhatsapp($profile['phone'], $message, 'express');
        }

        return redirect("$this->url")->with('sukses', 'Status Order Berhasil Di Perbarui');
    }

    public function destroy($id)
    {

        $game = $this->mGame->where('id', $id)->first();
        $this->mGame->destroy($id);
        
        $data = [
            'message' => "Game ".$game->nama." Berhasil di hapus"
        ];

        return $data;
    }

    public function getData(Request $request)
    {
        $orderInvoice = $this->mOrderInvoice->all();
        // echo json_encode($data); die;

        return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($data){
                    $html = '<div class="btn-group">
                                <a href="'.url("$this->url/$data->id/edit").'" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="'.$data->id.'"><i class="material-icons">delete</i></a>
                            </div>';
                    return $html;
                })
                ->editColumn('img', function($data){
                    return '<img class="avatar" src="'.url("/upload/game/$data->img").'">';
                })
                ->rawColumns(['actions','img'])
                ->make(true);
    }

}
