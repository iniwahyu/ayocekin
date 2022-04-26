<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Load library
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'idURole',
        'photo',
        'username',
        'password',
        'role',
        'sandi',
        'status',
    ];

    public function getUser()
    {
        $query = DB::table('user AS u');
        $query->selectRaw('u.id, u.username, u.idURole, ur.nama AS role_name, u.status');
        $query->join('user_role AS ur', 'ur.id', '=', 'u.idURole');
        return $query;
    }
}