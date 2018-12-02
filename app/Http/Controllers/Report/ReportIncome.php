<?php
namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use DB;
// Traits
use App\Traits\Helper;

class ReportIncome extends Controller
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
                    'js/reportIncome',
                    'vendors/cleave.js/cleave.min',
                 ],
                'indexName'         => 'report-income-index',
                'title'             => 'Report Of Income',
                'ajaxUrl'           => [
                    'ajaxGetListIncome' => route('report-income-getlist'),
                    'ajaxGetIncome'     => route('report-income-getdata')
                ],
                'breadCrumb'        => $this->breadCrumb(14, 2),
                'accessRight'       => [ 'id' => 14, 'level' => 2 ]
         ];
        return view('report.report-income.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Report Of Income'
        ];
        $view = view('report.report-income.index', $data)->render();
        return $view;
    }

}
