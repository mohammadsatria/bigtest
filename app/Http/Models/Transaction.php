<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Transaction extends Model
{
    protected $table      = 'transaction';
    protected $primaryKey = 'trs_id';
    protected $fillable   = [
        'std_ctr',
        'trs_created_by',
        'trs_date',
        'created_at'
    ];

    public $timestamps     = false;

    public function transactionDetail ()
    {
        return $this->hasMany('App\Http\Models\Transaction_detail', 'trs_id');
    }

    public function student ()
    {
        return $this->hasMany('App\Http\Models\Student', 'std_ctr');
    }

    public static function getIncomeRange($dateFrom, $dateTo)
    {
        $obj = new Static;
        $data = DB::table($obj->table.' as a')
                ->join('transaction_detail as b', 'a.trs_id', '=', 'b.trs_id')
                ->join('item as c', 'b.itm_id', '=', 'c.itm_id')
                ->select(DB::raw('SUM(b.trd_quantity * b.trd_unit_price) as total'))
                ->whereBetween('a.trs_date', ["$dateFrom", "$dateTo"])
                ->get();

        return $data->first()->total;
    }

    public static function getCustomerTransaction($condition)
    {
        $obj = new Static;
        $data = DB::table($obj->table.' as a')
                ->join('transaction_detail as b', 'a.trs_id', '=', 'b.trs_id')
                ->select(DB::raw('SUM(b.trd_quantity * b.trd_unit_price) as total'))
                ->where($condition)
                ->get();

        return $data->first()->total;
    }

}
