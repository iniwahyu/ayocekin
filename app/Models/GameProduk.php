<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameProduk extends Model
{
    use HasFactory;

    protected $table = 'game_produk';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function game()
    {
        return $this->belongsTo(GameMaster::class, 'idGMaster', 'id');
    }
}