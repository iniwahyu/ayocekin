<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class GameMaster extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'game_master';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function getGameProdukDetail($productGameId = null)
    {
        // SELECT
        // gm.id AS game_id, gm.`img`, gm.`nama` AS game_name, gm.`qserver`, gp.id AS product_id, gp.`nama` AS product_name, gp.harga
        // FROM game_master AS gm
        // JOIN game_produk AS gp ON gp.`idGMaster` = gm.`id`
        // WHERE gp.`id` = '1'
        $query = DB::table('game_master AS gm');
        $query->selectRaw('gm.id AS game_id, gm.`img`, gm.`nama` AS game_name, gm.`qserver`, gp.id AS product_id, gp.`nama` AS product_name, gp.harga');
        $query->join('game_produk AS gp', 'gp.idGMaster', '=', 'gm.id');
        $query->where('gp.id', $productGameId);
        return $query;
    }

    public function gameProduk()
    {
        return $this->hasMany(GameProduk::class, 'idGMaster', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($GameMaster) {

            $GameMaster->slug = $GameMaster->createSlug($GameMaster->nama);

            $GameMaster->save();
        });
    }

    private function createSlug($nama)
    {
        if (static::whereSlug($slug = Str::slug($nama))->exists()) {

            $max = static::whereNama($nama)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}