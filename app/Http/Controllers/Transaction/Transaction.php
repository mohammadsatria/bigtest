<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Model
use App\Http\Models\Transaction as mTransaction;
use App\Http\Models\Transaction_detail as mTransactionDetail;
use App\Http\Models\Deposit as mDeposit;
use App\Http\Models\Helper as mHelper;
use App\Http\Models\Item as mItem;

// Traits
use App\Traits\Helper;

class Transaction extends Controller
{
    use Helper;

    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function main ()
    {
        $data = [
                'importJs'          => [
                    'js/transaction',
                    'vendors/cleave.js/cleave.min',
                    'vendors/devbridge-autocomplete/dist/jquery.autocomplete'
                 ],
                'indexName'         => 'transaction-index',
                'title'             => 'Transaction',
                'ajaxUrl'           => [
                    'ajaxStore'             => route('transaction-store'),
                    'ajaxGetItem'           => route('item-getitem'),
                    'ajaxGetItemData'       => route('item-getitemdata'),
                    'ajaxGetStudentBarcode' => route('student-getallbarcode'),
                    'ajaxGetStudent'        => route('student-getstudent')
                ],
                'breadCrumb'        => $this->breadCrumb(6, 1),
                'accessRight'       => [ 'id' => 6, 'level' => 1 ]
         ];
        return view('transaction.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Transaction'
        ];
        $view = view('transaction.index', $data)->render();
        return $view;
    }

    public function payment () {
        $data = [
            'subTitle' => 'Payment Process',
        ];

        $view = view('transaction.payment', $data)->render();
        return $view;
    }

    public function store (Request $req)
    {
        if ($req->ajax()) {
            foreach ($req->input('itemList') as $key => $val) {
                $item = mItem::find($val['id']);

                if ($item->itm_stock < $val['quantity']) {
                    $result = [
                        'message' => 'Out of stock for item '. $item->itm_name . ' , please check item stock',
                        'result'  => false
                    ];
                    return response()->json($result);
                    die();
                }
            }

            // get all item

            // transaction perday maximal limit
            $transactionLimit = mHelper::find(2);
            $totalTransaction = $req->input('total');
            $condition = [
                'a.std_ctr'  => $req->input('studentCtr'),
                'a.trs_date' => date('Y-m-d')
            ];
            $totalCustomerTransaction = mTransaction::getCustomerTransaction($condition);
            $grandTotal = $totalTransaction + $totalCustomerTransaction;

            if ($transactionLimit->value > 0 && $grandTotal > $transactionLimit->value) {
                $remains = $transactionLimit->value - $totalCustomerTransaction;
                $result = [
                    'message' => $remains <= 0 ? 'The total transaction exceeds the limit transaction perday' : 'The remaining maximum transaction is Rp. '. numberFormat($remains),
                    'result'  => false
                ];
                return response()->json($result);
                die();
            }
            // Insert to table transaction
            $save = mTransaction::create([
                    'std_ctr'        => $req->input('studentCtr'),
                    'trs_created_by' => Auth::id(),
                    'trs_date'       => date('Y-m-d'),
                    'created_at'     => date('Y-m-d H:i:s')
                ]);

            $trsId = $save->trs_id;

            foreach ($req->input('itemList') as $key => $val) {
                // insert to table transaction_detail
                mTransactionDetail::create([
                    'trs_id'         => $trsId,
                    'itm_id'         => $val['id'],
                    'trd_quantity'   => $val['quantity'],
                    'trd_unit_price' => $val['itemPrice'],
                    'trd_created_by' => Auth::id(),
                    'created_at'     => date('Y-m-d H:i:s')
                ]);
            }

            // insert to table deposit
            mDeposit::create([
                'std_ctr'        => $req->input('studentCtr'),
                'dps_value'      => $req->input('total'),
                'dps_status'     => 0,
                'dps_date'       => date('Y-m-d'),
                'dps_remark'     => 'Transaction',
                'dps_created_by' => Auth::id()
            ]);

            $result = [ 'message' => 'The new transaction is successfully processed.', 'redirect' => route('transaction-index'), 'result' => true ];
            return response()->json($result);
        }
    }
}
