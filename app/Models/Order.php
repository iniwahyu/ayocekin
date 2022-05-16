<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'idGMaster',
        'idGProduk',
        'idUser',
        'log_akun',
        'log_server',
        'status',
        'img',
        'log_payment',
        'idPayment'
    ];

    protected $guarded = ['id'];
}