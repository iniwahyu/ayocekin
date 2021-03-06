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
use App\Models\QServer;
use App\Models\JenisGame;

class GameMasterController extends Controller
{
    private $views      = '/superadmin/game';
    private $url        = '/superadmin/game';
    private $title      = 'Halaman Kelola Game';

    public function __construct()
    {
        $this->mGame    = new GameMaster();
        $this->mQServer = new QServer();
        $this->mJGame   = new JenisGame();
    }

    public function index()
    {
        $game = $this->mGame->all();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'game'          => $game,
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create()
    {
        $qserver = $this->mQServer->all();
        $jGame = $this->mJGame->all();

        $data = [
            'title'         => 'Halaman Tambah Game',
            'url'           => $this->url,
            'qserver'       => $qserver,
            'jGame'       => $jGame,
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
            $file->move(public_path(). "/upload/game/", $fileName);
        }

         // Photo panduan
         if ($request->hasFile('photo1')) {
            $file       = $request->file('photo1');
            $fileName1   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/game/panduan/", $fileName1);
        }

        // $slug = $this->createSlug($request->nama);
        // $slug = Str::slug('Laravel 5 Framework', '-');
        // echo $slug; die;

        // Table user
        $dataGame = [
            'idUser'    => session()->get('users_id'),
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'qserver'   => $request->qserver,
            'img'       => $fileName ?? null,
            'panduan'   => $fileName1 ?? null,
            'jGame'     => $request->jGame,

            'waktuClose'    => $request->waktuClose,
            'jamReset'      => $request->jamReset,
            'jamOpen'       => $request->jamOpen,
            'jamClose'      => $request->jamClose,
        ];
        $this->mGame->create($dataGame);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Game');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $game = $this->mGame->where('id', $id)->first();
        $qserver = $this->mQServer->all();
        
        $data = [
            'title'         => 'Halaman Edit Game',
            'url'           => $this->url,
            'game'          => $game,
            'qserver'          => $qserver
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {
        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/game/", $fileName);
        }

        // Photo panduan
        if ($request->hasFile('photo1')) {
           $file       = $request->file('photo1');
           $fileName1   = Str::uuid()."-".time().".".$file->extension();
           $file->move(public_path(). "/upload/game/panduan/", $fileName1);
       }

        $game = $this->mGame->where('id', $id)->first();
        // Table user
        $dataGame = [
            'idUser'    => session()->get('users_id'),
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'qserver'   => $request->qserver,
            'img'       => $fileName ?? $game->img,
            'panduan'   => $fileName1 ?? $game->panduan,
        ];
        $this->mGame->where('id', $request->idGame)->update($dataGame);

        return redirect("$this->url")->with('sukses', 'Game Berhasil Di Perbarui');
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
        $data = $this->mGame->all();
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
                ->editColumn('jGame', function($data){
                    return $data->jg->nama;
                })
                ->editColumn('img', function($data){
                    return '<img class="avatar" src="'.url("/upload/game/$data->img").'">';
                })
                ->editColumn('panduan', function($data){
                    return '<img class="avatar" src="'.url("/upload/game/panduan/$data->panduan").'">';
                })
                ->rawColumns(['actions','img', 'panduan', 'jGame'])
                ->make(true);
    }

}
