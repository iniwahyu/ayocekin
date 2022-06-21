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

use App\Models\Banner;
use App\Models\QServer;

class BannerController extends Controller
{
    private $views      = '/superadmin/banner';
    private $url        = '/superadmin/banner';
    private $title      = 'Halaman Kelola Banner';

    public function __construct()
    {
        $this->mBanner = new Banner();
        $this->mQServer = new QServer();
    }

    public function index()
    {
        $banner = $this->mBanner->all();

        $data = [
            'title'         => $this->title,
            'url'           => $this->url,
            'banner'        => $banner,
        ];
        // View
        return view($this->views . "/index", $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Halaman Tambah Banner',
            'url'           => $this->url,
        ];

        // View
        return view($this->views . "/create", $data);
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/banner/", $fileName);
        }

        // Table user
        $dataBanner = [
            'idUser'    => session()->get('users_id'),
            'img'       => $fileName ?? null,
            'status'    => $request->status ?? 'off',
            // 'url'       => $request->url,
        ];
        $this->mBanner->create($dataBanner);

        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Banner');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $banner = $this->mBanner->where('id', $id)->first();
        
        $data = [
            'title'         => 'Halaman Edit Banner',
            'url'           => $this->url,
            'banner'        => $banner,
        ];
        return view($this->views . "/edit", $data);
    }

    public function update(Request $request, $id)
    {
        // Validate
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        
        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/banner/", $fileName);
        }

        $banner = $this->mBanner->where('id', $id)->first();
        
        // Table user
        $dataBanner = [
            'img'       => $fileName ?? $banner->img,
            'status'    => $request->status ?? 'off',
        ];
        $this->mBanner->where('id', $id)->update($dataBanner);

        return redirect("$this->url")->with('success', 'Banner Berhasil Di Perbarui');
    }

    public function destroy($id)
    {

        $banner = $this->mBanner->where('id', $id)->first();
        $this->mBanner->destroy($id);
        
        $data = [
            'message' => "Berhasil di hapus"
        ];

        return $data;
    }

    public function getData(Request $request)
    {
        $data = $this->mBanner->all();
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
                    return '<img class="img-preview img-fluid mb-3 col-sm-5 d-block" src="'.url("/upload/banner/$data->img").'">';
                })
                ->rawColumns(['actions','img'])
                ->make(true);
    }

}
