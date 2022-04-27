<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library
use DB;
use Illuminate\Support\Facades\Hash;
use Str;
use File;
use DataTables;

// Load Model
use App\Models\UserModel;

class UserController extends Controller
{
    private $views      = '/superadmin/user';
    private $url        = "/superadmin/user";

    public function __construct()
    {
        $this->mUser = new UserModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Variable
        $data = [
            'title' => 'Daftar User',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Variable
        $data = [
            'title' => 'Add User',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate

        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/user/", $fileName);
        }

        // Table user
        $dataUser = [
            'idURole' => $request->idURole,
            'photo' => $fileName ?? null,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'sandi' => $request->password,
            'status' => $request->status,
        ];
        $this->mUser->create($dataUser);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Menambahkan User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get Data
        $users = $this->mUser->where('id', $id)->first();

        // Variable
        $data = [
            'title' => 'Detail User',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'userId' => $id,
            'users' => $users,
        ];

        // View
        return view("$this->views/show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get Data
        $users = $this->mUser->where('id', $id)->first();

        // Variable
        $data = [
            'title' => 'Edit User',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'userId' => $id,
            'users' => $users,
        ];

        // View
        return view("$this->views/edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get Data
        $users = $this->mUser->where('id', $id)->first();

        // Validate

        // Photo
        if ($request->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName   = Str::uuid()."-".time().".".$file->extension();
            $file->move(public_path(). "/upload/user/", $fileName);
        }
        
        $password = $users->password;
        if ($request->password != null) {
            $password = Hash::make($request->password);
        }

        // Table user
        $dataUser = [
            'photo' => $fileName ?? $users->photo,
            'password' => $password,
            'sandi' => $request->password ?? $users->sandi,
            'status' => $request->status,
        ];
        $this->mUser->where('id', $id)->update($dataUser);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Menambahkan User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mUser->where('id', $id)->delete();

        // Response
        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'Berhasil Menghapus',
            'data' => ''
        ];
        return response()->json($response);
    }

    public function getData(Request $request)
    {
        $data = $this->mUser->getUser();
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($data) {
                    switch ($data->status) {
                        case '0':
                            return 'Tidak Aktif';
                            break;
                        case '1':
                            return 'Aktif';
                            break;
                        case '2':
                            return 'Diblokir';
                            break;
                        default:
                            # code...
                            break;
                    }
                })
                ->addColumn('actions', function($data){
                    $html = '<div class="btn-group">
                                <a href="'.url("$this->url/$data->id").'" class="btn btn-primary btn-sm"><i class="material-icons">info</i></a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="'.$data->id.'"><i class="material-icons">delete</i></a>
                            </div>';
                    return $html;
                })
                ->rawColumns(['actions'])
                ->make(true);
    }
}