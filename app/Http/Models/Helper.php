<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    protected $table      = 'helper';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'info',
        'value'
    ];

    public $timestamps     = false;
}
