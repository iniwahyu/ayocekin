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

use App\Models\PaymentQrcode;
use App\Models\BankManual;

class PaymentQrcodeController extends Controller
{
    private $views      = '/superadmin/payment_qrcode';
    private $url        = '/superadmin/payment_qrcode';
    private $title      = 'Halaman Kelola Payment QRcode';

    public function __construct()
    {
        $this->mPQrcode = new PaymentQrcode();
        $this->mManual = new BankManual();
    
    }

    public function index()
    {
        // $qrcode = $this->mPQrcode->all();
        $qrcode = $this->mManual->where('idPayment', '3')->get();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'qrcode'        => $qrcode
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Halaman Tambah Pembayaran QR Code',
            'url'           => $this->url,
        ];
        // View
        return view($this->views . "/create", $data);
    }

    public function store(Request $request)
    {
        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/payment/qrcode/logo/", $fileName);
        }

        if ($request->hasFile('photo2')) {
            $file       = $request->file('photo2');
            $fileName2   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/payment/qrcode/", $fileName);
        }
        
        // Table user
        // $dataPaymentQrcode = [
        //     'idUser'        => session()->get('users_id'),
        //     'idPayment'     => '3',
        //     'nama'          => $request->nama,
        //     'rekening'      => $request->rekening,
        //     'nama_pemegang' => $request->nama_pemegang,
        //     'img'           => $fileName ?? null,
        // ];
        // $this->mPQrcode->create($dataPaymentQrcode);


        $dataPaymentQrcode = [
            'idUser'        => session()->get('users_id'),
            'idPayment'     => '3',
            'nama'          => $request->nama,
            'rekening'      => $request->rekening,
            'nama_pemegang' => $request->nama_pemegang,
            'img'           => $fileName ?? null,
            'img_qrcode'    => $fileName2 ?? null,
        ];
        $this->mManual->create($dataPaymentQrcode);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Pembayaran QR Code');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // $qrcode = $this->mPQrcode->where('id', $id)->first();
        $qrcode = $this->mManual->where('id', $id)->first();
        
        $data = [
            'title'         => 'Halaman Perbarui QR Code',
            'url'           => $this->url,
            'qrcode'        => $qrcode,
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {
         // Photo
         if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/payment/qrcode/", $fileName);
        }

        $qrcode = $this->mPQrcode->where('id', $id)->first();

        // Table user
        $dataPaymentQrcode = [
            'nama'          => $request->nama,
            'rekening'      => $request->rekening,
            'nama_pemegang' => $request->nama_pemegang,
            'img'           => $fileName ?? $qrcode->img,
        ];
        $this->mPQrcode->where('id', $id)->update($dataPaymentQrcode);

        return redirect("$this->url")->with('sukses', 'Informasi Pembayaran QR Code Berhasil Di Perbarui');
    }

    public function destroy($id)
    {
        $qrcode = $this->mPQrcode->where('id', $id)->first();
        $this->mPQrcode->destroy($id);
        
        $data = [
            'message' => "Pembayaran QR Code ".$qrcode->nama." Berhasil di hapus"
        ];

        return $data;
    }

    public function getData(Request $request)
    {
        $data = $this->mGame->all();
        // echo json_encode($data); die;

        return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($data){
                    $html = '<div class="btn-group">
                                <a href="'.url("$this->url/$data->id").'" class="btn btn-primary btn-sm"><i class="material-icons">info</i></a>
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
