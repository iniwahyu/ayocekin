<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// load Library
use DB;
use Str;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;

// Load Model
use App\Models\GameMaster;
use App\Models\UserModel;
use App\Models\Profile;
use App\Models\Banner;

class HomeController extends Controller
{
    private $views      = '/landing/home';
    private $url        = "/landing/home";

    public function __construct()
    {
        $this->mGame    = new GameMaster();
        $this->mUser    = new UserModel();
        $this->mProfile = new Profile();
        $this->mBanner  = new Banner();
    }

    public function index()
    {

        // echo date('h-m-s'); die;

        // Get Data
        $games = $this->mGame->selectRaw('id, nama, slug, img')->get();
        $banner = $this->mBanner->all();

        // Variable
        $data = [
            'title' => 'Jual Beli Voucher Game',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
            'games' => $games,
            'banner' => $banner,
        ];

        // View
        return view("$this->views/index", $data);
    }

    public function thanks()
    {
        // Variable
        $data = [
            'title' => 'Halaman Terima Kasih',
            'url' => $this->url,
            'breadcrumb' => [
                'Dashboard',
                '-'
            ],
        ];

        // View
        return view("$this->views/thanks", $data);
    }
}