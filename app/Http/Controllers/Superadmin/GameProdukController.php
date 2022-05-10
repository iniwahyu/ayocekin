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

class GameProdukController extends Controller
{
    private $views      = '/superadmin/game_produk';
    private $url        = '/superadmin/game_produk';
    private $title      = 'Halaman Kelola Produk Game';

    public function __construct()
    {
        $this->mGame        = new GameMaster();
        $this->mGameProduk  = new GameProduk();
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

    public function create()
    {
        $data = [
            'title'         => 'Halaman Tambah Produk Game',
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
            $file->move(public_path(). "/upload/game/", $fileName);
        }

        // Table user
        $dataGame = [
            'idUser'    => session()->get('users_id'),
            'nama'      => $request->nama,
            'img'       => $fileName ?? null,
        ];
        $this->mGame->create($dataGame);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Game');
    }

    public function show($id)
    {
        $gameProduk         = $this->mGameProduk->where('idGMaster', $id)->get();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'gameProduk'    => $gameProduk
        ];
        // View
        return view($this->views . "/show", $data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
