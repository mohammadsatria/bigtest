<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class M_menulevel3 extends Model
{
    protected $table = 'menu_lev3';
    protected $primaryKey = 'mlv3_id';
    protected $fillable = [ 'mlv3_name',
                            'mlv3_url',
                            'mlv3_parent_id',
                            'mlv3_icon',
                            'mlv3_active',
                            'mlv3_order',
                            'mvl3_updated_by',
                            'mlv3_created_by'
                        ];

    const CREATED_AT = 'mlv3_created_at';
    const UPDATED_AT = 'mlv3_updated_at';


    public static function getMenuLev3($cond)
    {
        $obj = new Static;
        return self::where($cond)->orderBy('mlv3_order', 'asc')->get();
    }

    public function menuLevel2()
    {
        return $this->belongsTo('App\Http\Models\M_menulevel2', 'mlv3_parent_id');
    }
}
