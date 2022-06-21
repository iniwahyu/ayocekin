<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentQrcode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payment_qrcode';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo(UserModel::class, 'idUser', 'id');
    }
}