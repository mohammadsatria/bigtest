<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table      = 'item';
    protected $primaryKey = 'itm_id';
    protected $fillable   = [
        'itm_name',
        'itm_price',
        'itm_supplier_price',
        'itm_barcode_id',
        'itm_stock',
        'cat_id',
        'spl_id',
        'itm_created_by',
        'itm_updated_by'
    ];

    public function supplier ()
    {
        return $this->belongsTo('App\Http\Models\Supplier', 'spl_id');
    }

    public function category ()
    {
        return $this->belongsTo('App\Http\Models\Category', 'cat_id');
    }

    public function transactionDetail ()
    {
        return $this->hasMany('App\Http\Models\Transaction_detail', 'itm_id');
    }
}
