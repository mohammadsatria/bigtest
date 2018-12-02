<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table      = 'deposit';
    protected $primaryKey = 'dps_id';
    protected $fillable   = [
        'std_ctr',
        'dps_value',
        'dps_status', # add and deduct
        'dps_date',
        'dps_remark',
        'dps_created_by',
        'dps_updated_by'
    ];

    public function student ()
    {
        return $this->belongsTo('App\Http\Models\Student', 'std_ctr');
    }
}
