<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankManual extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payment_bank';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];
}