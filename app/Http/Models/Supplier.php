<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'spl_id';
    protected $fillable   = [
        'spl_name',
        'spl_no_hp',
        'spl_created_by',
        'spl_updated_by'
    ];

    public function item ()
    {
        return $this->hasMany('App\Http\Models\Item', 'spl_id');
    }
}
