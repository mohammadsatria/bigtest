<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use DB;
// Traits
use App\Traits\Helper;

class SupplierReport extends Controller
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
                    'js/supplierReport',
                    'vendors/cleave.js/cleave.min',
                 ],
                'indexName'         => 'supplier-report-index',
                'title'             => 'Supplier Report',
                'ajaxUrl'           => [
                    'ajaxGetListSupplier' => route('supplier-report-getlist'),
                    'ajaxGetSupplier'     => route('supplier-report-getdata')
                ],
                'breadCrumb'        => $this->breadCrumb(15, 2),
                'accessRight'       => [ 'id' => 15, 'level' => 2 ]
         ];
        return view('report.supplier-report.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'    => 'Supplier Report',
            'supplier' => mSupplier::all()
        ];
        $view = view('report.supplier-report.index', $data)->render();
        return $view;
    }

}
