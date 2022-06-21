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
        // o.`id`, o.`create_time`, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`, o.`status`, o.`payment_status`
        // FROM `order` AS o
        // JOIN game_master AS gm ON gm.`id` = o.`idGMaster`
        // JOIN game_produk AS gp ON gp.`id` = o.`idGProduk`
        // WHERE o.`idUser` = '4'
        $query = DB::table('order AS o');
        $query->selectRaw('o.`id`, o.`create_time`, gm.img AS game_image, gm.`nama` AS game_name, gp.`nama` AS product_name, o.`kode_invoice`, o.`harga`, o.`status`, o.`payment_status`');
        $query->join('game_master AS gm', 'gm.id', '=', 'o.idGMaster');
        $query->join('game_produk AS gp', 'gp.id', '=', 'o.idGProduk');
        $query->where('o.idUser', $usersId);
        $query->orderBy('o.id', 'desc');
        return $query;
    }

    public function getOrderUserDetail($invoiceCode)
    {
        // SELECT
        // o.`id`, o.`kode_invoice`, o.`create_time`, u.`username`, p.`nama`, p.`phone`, p.`email`,
        // gm.`nama` AS game_name, gp.`nama` AS product_name, o.`harga`, o.`payment`
        // FROM `order` AS o
        // JOIN `user` AS u ON u.`id` = o.`idUser`
        // JOIN `profile` AS p ON p.`idUser` = u.`id`
        // JOIN game_master AS gm ON gm.`id` = o.`idGMaster`
        // JOIN game_produk AS gp ON gp.`id` = o.`idGProduk`
        // WHERE o.`kode_invoice` = '06062022-86BD641EE3'
        $query = DB::table('order AS o');
        $query->selectRaw('o.`id`, o.`kode_invoice`, o.`create_time`, u.`username`, p.`nama`, p.`phone`, p.`email`,
        gm.`nama` AS game_name, gp.`id` AS product_id, gp.`nama` AS product_name, o.`harga`, o.`bayar`, o.`payment`, o.`status`, o.`payment_status`');
        $query->join('user AS u', 'u.id', '=', 'o.idUser');
        $query->join('profile AS p', 'p.idUser', '=', 'u.id');
        $query->join('game_master AS gm', 'gm.id', '=', 'o.idGMaster');
        $query->join('game_produk AS gp', 'gp.id', '=', 'o.idGProduk');
        $query->where('o.kode_invoice', $invoiceCode);
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