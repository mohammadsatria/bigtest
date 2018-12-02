<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class M_menulevel2 extends Model
{
    protected $table = 'menu_lev2';
    protected $primaryKey = 'mlv2_id';
    protected $fillable = [ 'mlv2_name',
                            'mlv2_url',
                            'mlv2_icon',
                            'mlv2_parent_id',
                            'mlv2_active',
                            'mlv2_order',
                            'mvl2_updated_by',
                            'mlv2_created_by'
                        ];

    const CREATED_AT = 'mlv2_created_at';
    const UPDATED_AT = 'mlv2_updated_at';


    public static function getMenuLev2($cond)
    {
        $obj = new Static;
        return self::where($cond)->orderBy('mlv2_order', 'asc')->get();
    }

    public function menuLevel3()
    {
        return $this->hasMany('App\Http\Models\M_menulevel3', 'mlv3_parent_id');
    }

    public function menuLevel1()
    {
        return $this->belongsTo('App\Http\Models\M_menulevel1', 'mlv2_parent_id');
    }
}
