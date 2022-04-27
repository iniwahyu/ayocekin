<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Load Library
use DB;
use DataTables;

// Load Model
use App\Models\UserRole;

class UserRoleController extends Controller
{
    private $views      = '/superadmin/userrole';
    private $url        = "/superadmin/userrole";

    public function __construct()
    {
        $this->mUserRole = new UserRole();
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
            'title' => 'Daftar Role',
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
            'title' => 'Add Role',
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

        // Table Role
        $dataUserRole = [
            'nama' => $request->nama,
        ];
        $this->mUserRole->create($dataUserRole);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Menambahkan Role');
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
        $roles = $this->mUserRole->where('id', $id)->first();

        // Variable
        $data = [
            'title' => 'Detail Role',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'userId' => $id,
            'roles' => $roles,
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
        $roles = $this->mUserRole->where('id', $id)->first();

        // Variable
        $data = [
            'title' => 'Edit Role',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'userId' => $id,
            'roles' => $roles,
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
        $roles = $this->mUserRole->where('id', $id)->first();

        // Validate

        // Table Role
        $dataUserRole = [
            'nama' => $request->nama
        ];
        $this->mUserRole->where('id', $id)->update($dataUserRole);

        // Response
        return redirect("$this->url")->with('success', 'Berhasil Mengubah Role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mUserRole->where('id', $id)->delete();

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
        $data = $this->mUserRole->all();
        return Datatables::of($data)
                ->addIndexColumn()
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