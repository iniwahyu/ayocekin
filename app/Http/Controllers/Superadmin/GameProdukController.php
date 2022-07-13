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

use App\Models\GameMaster;
use App\Models\GameProduk;
use App\Models\GambarProduk;

class GameProdukController extends Controller
{
    private $views      = '/superadmin/game_produk';
    private $url        = '/superadmin/game_produk';
    private $title      = 'Halaman Kelola Produk Game';

    public function __construct()
    {
        $this->mGame            = new GameMaster();
        $this->mGameProduk      = new GameProduk();
        $this->mGambarProduk    = new GambarProduk();
    }

    public function index()
    {
        $game = $this->mGame->all();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'game'          => $game
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create($id=null)
    {
        $game           = $this->mGame->all();
        $gambarProduk   = $this->mGambarProduk->all();
        $gameMaster     = $this->mGame->where('id', $id)->first();
        $gameProduk     = $this->mGameProduk->where('idGMaster', $id)->get();

        $data = [
            'title'         => 'Halaman Tambah Produk Game',
            'url'           => $this->url,
            'game'          => $game,
            'gambarProduk'  => $gambarProduk,
            'idGMaster'     => $id,
            'gameMaster'    => $gameMaster,
            'gameProduk'    => $gameProduk,
        ];
        // View
        return view($this->views . "/create", $data);
    }

    public function store(Request $request)
    {
        // echo json_encode($request->all()); die;
        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/game/produk/", $fileName);

            $dataGambarProduk = [
                'idGMaster' => $request->idGMaster,
                'idUser'    => session()->get('users_id'),
                'img'       => $fileName
            ];
            $this->mGambarProduk->create($dataGambarProduk);
        }

        if($request->has('sebelum')){
            $fileName = $request->sebelum;
        }

        // echo json_encode($request->all()); die;

        // Table user
        $dataGameProduk = [
            'idUser'    => session()->get('users_id'),
            'idGMaster' => $request->idGMaster,
            'nama'      => $request->nama,
            'harga'     => $request->harga,
            'img'       => $fileName ?? null,
            'status'    => $request->status ?? 'off',
        ];

        $gameMaster     = $this->mGame->where('id', $request->idGMaster)->first();

        // tambah urutan produk bundle
        if($gameMaster['jGame'] == 2){
            for ($i = 1; $i <= $gameMaster['jmlBundle']; $i++){
                // cek unique urutan bundle, barangkali ada yang iseng inspect
                foreach ($gameProduk as $gp){
                    if ($gp->urutanBundle == $i){
                        return redirect("$this->url")->with('error', 'Urutan Game Sudah terdaftar');
                    }else{
                        $dataGameProduk['urutanBundle'] = $request->urutanBundle;
                    }
                }
            }
        }
        $this->mGameProduk->create($dataGameProduk);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Produk Game');
    }

    public function show($id)
    {
        $gameProduk         = $this->mGameProduk->where('idGMaster', $id)->get();
        $gameMaster         = $this->mGame->where('id', $id)->first();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'idGMaster'     => $id,
            'gameProduk'    => $gameProduk,
            'gameMaster'    => $gameMaster
        ];
        // View
        return view($this->views . "/show", $data);
    }

    public function edit($id)
    {
        $game           = $this->mGame->all();
        $gameProduk     = $this->mGameProduk->where('id', $id)->first();
        $gambarProduk   = $this->mGambarProduk->all();
        
        $data = [
            'title'         => 'Halaman Edit Produk Game',
            'url'           => $this->url,
            'game'          => $game,
            'gameProduk'    => $gameProduk,
            'gambarProduk'  => $gambarProduk
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {
        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/game/produk/", $fileName);

            $dataGambarProduk = [
                'idGMaster' => $request->idGMaster,
                'idUser'    => session()->get('users_id'),
                'img'       => $fileName
            ];
            $this->mGambarProduk->create($dataGambarProduk);
        }

        if($request->has('sebelum')){
            $fileName = $request->sebelum;
        }

        // echo json_encode($request->all()); die;

        $gameProduk     = $this->mGameProduk->where('id', $id)->first();

        // Table user
        $dataGameProduk = [
            'idUser'    => session()->get('users_id'),
            'nama'      => $request->nama,
            'harga'     => $request->harga,
            'img'       => $fileName ?? $gameProduk->img,
            'status'    => $request->status ?? 'off',
        ];
        $this->mGameProduk->where('id', $id)->update($dataGameProduk);

        return redirect("$this->url")->with('success', 'Berhasil Merubah Produk Game');
    }

    public function destroy($id)
    {
        $gameProduk = $this->mGameProduk->where('id', $id)->first();
        $this->mGameProduk->destroy($id);
        
        $data = [
            'message' => "Produk Game ".$gameProduk->nama." Berhasil di hapus"
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
