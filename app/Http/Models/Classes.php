<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table      = 'class';
    protected $primaryKey = 'cls_id';
    protected $fillable   = [ 'cls_name', 'cls_created_by', 'cls_updated_by' ];


    public function student ()
    {
        return $this->hasMany('App\Http\Models\Student', 'cls_id');
    }
}
