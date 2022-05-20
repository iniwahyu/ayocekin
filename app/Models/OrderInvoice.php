<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderInvoice extends Model
{
    use HasFactory;

    protected $table = 'order_invoice';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function pembeli()
    {
        return $this->belongsTo(UserModel::class, 'idUser', 'id');
    }

}