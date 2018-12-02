<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table      = 'student';
    protected $primaryKey = 'std_ctr';
    protected $fillable   = [
        'std_id',
        'std_name',
        'cls_id',
        'std_gender',
        'std_barcode_id',
        'std_address',
        'std_img',
        'std_birthplace',
        'std_birthdate',
        'std_created_by',
        'std_updated_by'
    ];


    public function classes ()
    {
        return $this->belongsTo('App\Http\Models\Classes', 'cls_id');
    }

    public function deposit ()
    {
        return $this->hasMany('App\Http\Models\Deposit', 'std_ctr');
    }

    public function transaction ()
    {
        return $this->belongsTo('App\Http\Models\Transaction', 'std_ctr');
    }
}
