<?php
namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use DB;

// Traits
use App\Traits\Helper;

class CustomerReport extends Controller
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
                    'js/customerReport',
                    'vendors/cleave.js/cleave.min',
                 ],
                'indexName'         => 'customer-report-index',
                'title'             => 'Customer Report Transaction',
                'ajaxUrl'           => [
                    'ajaxGetListIncome' => route('customer-report-getlist'),
                    'ajaxGetIncome'     => route('customer-report-getdata')
                ],
                'breadCrumb'        => $this->breadCrumb(18, 2),
                'accessRight'       => [ 'id' => 18, 'level' => 2 ]
         ];
        return view('report.customer-report-transaction.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'   => 'Customer Report Transaction'
        ];
        $view = view('report.customer-report-transaction.index', $data)->render();
        return $view;
    }

}
