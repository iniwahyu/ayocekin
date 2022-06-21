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

use App\Models\BankManual;

class BankManualController extends Controller
{
    private $views      = '/superadmin/bank_manual';
    private $url        = '/superadmin/pembayaran';
    private $title      = 'Halaman Kelola Bank Manual';

    public function __construct()
    {
        $this->mManual = new BankManual();
    
    }

    public function index()
    {
        $manual = $this->mManual->all();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'manual'          => $manual
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Halaman Tambah Bank Manual',
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
            $file->move(public_path(). "/upload/bank/", $fileName);
        }
        
        // Table user
        $dataBankManual = [
            'idUser'        => session()->get('users_id'),
            'idPayment'     => '2',
            'nama'          => $request->nama,
            'kode'          => $request->kode,
            'rekening'      => $request->rekening,
            'nama_pemegang' => $request->nama_pemegang,
            'img'           => $fileName ?? null,
        ];
        $this->mManual->create($dataBankManual);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Rekening Bank');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $manual = $this->mManual->where('id', $id)->first();
        
        $data = [
            'title'         => 'Halaman Perbarui Bank Manual',
            'url'           => $this->url,
            'manual'        => $manual,
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {
         // Photo
         if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/bank/", $fileName);
        }

        $manual = $this->mManual->where('id', $id)->first();

        // Table user
        $dataBankManual = [
            'nama'          => $request->nama,
            'kode'          => $request->kode,
            'rekening'      => $request->rekening,
            'nama_pemegang' => $request->nama_pemegang,
            'img'           => $fileName ?? $manual->img,
        ];
        $this->mManual->where('id', $id)->update($dataBankManual);

        return redirect("$this->url")->with('sukses', 'Informasi Bank Manual Berhasil Di Perbarui');
    }

    public function destroy($id)
    {
        $manual = $this->mManual->where('id', $id)->first();
        $this->mManual->destroy($id);
        
        $data = [
            'message' => "Bank Manual ".$manual->nama." Berhasil di hapus"
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
