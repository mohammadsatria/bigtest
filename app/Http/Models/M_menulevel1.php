<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class M_menulevel1 extends Model
{
    protected $table = 'menu_lev1';
    protected $primaryKey = 'mlv1_id';
    protected $fillable = [ 'mlv1_name',
                            'mlv1_url',
                            'mlv1_icon',
                            'mlv1_active',
                            'mlv1_order',
                            'mlv1_updated_by',
                            'mlv1_created_by'
                        ];

    const CREATED_AT = 'mlv1_created_at';
    const UPDATED_AT = 'mlv1_updated_at';

    public static function getMenuLev1($cond)
    {
        $obj = new Static;
        return self::where($cond)
                    ->orderBy('mlv1_order', 'asc')
                    ->get();
    }

    public function menuLevel2()
    {
        return $this->hasMany('App\Http\Models\M_menulevel2', 'mlv2_parent_id');
    }
}
