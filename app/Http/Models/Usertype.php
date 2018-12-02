<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
    protected $table      = 'usertype';
    protected $primaryKey = 'ust_id';
    protected $fillable   = [
        'ust_name',
        'ust_created_by',
        'ust_updated_by'
    ];

    public function user ()
    {
        return $this->hasMany('App\User', 'ust_id');
    }
}
