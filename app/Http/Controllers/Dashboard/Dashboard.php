<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Http\Models\Student as mStudent;
use App\Http\Models\Transaction as mTransaction;
use App\Http\Models\Transaction_detail as mTransactionDetail;
use App\Http\Models\Item as mItem;
use App\Http\Models\Supplier as mSupplier;
use App\Http\Models\M_menulevel1 as mLev1;

// Controller
use App\Http\Controllers\Deposit\Deposit;

use App\Traits\Helper;
class Dashboard extends Controller
{
    use Helper;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
        $data = [
                'indexName'   => 'dashboard-index',
                'title'       => 'Dashboard',
                'breadCrumb'  => $this->breadCrumb(1, 1),
                'accessRight' => [ 'id' => 1, 'level' => 1 ]
         ];
        return view('dashboard.main', $data);
    }

    public function index()
    {
        $data = [
                'title'       => 'Dashboard',
                'breadCrumb'  => $this->breadCrumb(1, 1),
                'accessRight' => [ 'id' => 1, 'level' => 1 ]
         ];

        $view = view('dashboard.index', $data)->render();
        return $view;
    }
}
