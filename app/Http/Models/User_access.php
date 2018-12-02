<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class User_access extends Model
{
    protected $table      = 'user_access';
    protected $primaryKey = 'usa_id';
    protected $fillable   = [
        'ust_id',
        'usa_menu_level',
        'usa_menu_id',
        'usa_status',
        'usa_created_by',
        'usa_updated_by'
    ];

    public static function destroyUserAccess($condition)
    {
        $i = new static;
        DB::table($i->table)->where($condition)->delete();
        return true;
    }
}
