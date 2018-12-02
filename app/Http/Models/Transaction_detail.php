<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    protected $table      = 'transaction_detail';
    protected $primaryKey = 'trd_id';
    protected $fillable   = [
        'trs_id',
        'itm_id',
        'trd_quantity',
        'trd_unit_price',
        'trd_created_by',
        'created_at'
    ];

    public $timestamps = false;

    public function transaction ()
    {
        return $this->belongsTo('App\Http\Models\Transaction', 'trs_id');
    }

    public function item ()
    {
        return $this->belongsTo('App\Http\Models\Item', 'itm_id');
    }
}
