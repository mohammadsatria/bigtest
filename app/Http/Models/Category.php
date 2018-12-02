<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table      = 'category';
    protected $primaryKey = 'cat_id';
    protected $fillable   = [
        'cat_name',
        'cat_created_by',
        'cat_updated_by'
    ];

    public function item ()
    {
        return $this->hasMany('App\Http\Models\Item', 'cat_id');
    }
}
