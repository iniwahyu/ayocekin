<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    // protected $fillable = [
    //     'idGMaster',
    //     'idGProduk',
    //     'idUser',
    //     'log_akun',
    //     'log_server',
    //     'status',
    //     'img',
    //     'log_payment',
    //     'idPayment'
    // ];

    public function game()
    {
        return $this->belongsTo(GameMaster::class, 'idGMaster', 'id');
    }

    public function gameProduk()
    {
        return $this->belongsTo(GameProduk::class, 'idGProduk', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'idUser', 'id');
    }

    protected $guarded = ['id'];

    public function getOrderUser($usersId)
    {
        // SELECT
        // o.`id`, o.`create_time`, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`
        // FROM `order` AS o
        // JOIN game_master AS gm ON gm.`id` = o.`idGMaster`
        // JOIN game_produk AS gp ON gp.`id` = o.`idGProduk`
        // WHERE o.`idUser` = '4'
        $query = DB::table('order AS o');
        $query->selectRaw('o.`id`, o.`create_time`, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`');
        $query->join('game_master AS gm', 'gm.id', '=', 'o.idGMaster');
        $query->join('game_produk AS gp', 'gp.id', '=', 'o.idGProduk');
        $query->where('o.idUser', $usersId);
        return $query;
    }

    // Percobaan buat unique code invoice
    // Stuck karena kalo di input ke beda tabel gag bisa sama
    
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($Order) {

    //         $Order->kode_invoice = $Order->createSlug($Order->kode_invoice);

    //         $Order->save();
    //     });
    // }

    // private function createSlug($nama)
    // {
    //     if (static::whereKode_invoice($slug = Str::slug($nama))->exists()) {

    //         $max = static::whereKode_invoice($nama)->latest('id')->skip(1)->value('kode_invoice');

    //         if (isset($max[-1]) && is_numeric($max[-1])) {

    //             return preg_replace_callback('/(\d+)$/', function ($mathces) {

    //                 return $mathces[1] + 1;
    //             }, $max);
    //         }
    //         return "{$slug}2";
    //     }
    //     return $slug;
    // }
}