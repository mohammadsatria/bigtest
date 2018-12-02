<?php

namespace App\Http\Controllers\Deposit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Models\Helper as mHelper;
// Traits
use App\Traits\Helper;
class Deposit extends Controller
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
                    'js/deposit',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'         => 'deposit-index',
                'title'             => 'Deposit',
                'ajaxUrl'           => [
                    'ajaxStore'   => route('deposit-store'),
                    'ajaxDestroy' => route('deposit-destroy'),
                    'ajaxSave'    => route('deposit-save')
                ],
                'breadCrumb'        => $this->breadCrumb(5, 1),
                'accessRight'       => [ 'id' => 5, 'level' => 1 ]
         ];
        return view('deposit.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Detail Of Deposit',
            'data'        => []
        ];


        $view = view('deposit.index', $data)->render();
        return $view;
    }


}
