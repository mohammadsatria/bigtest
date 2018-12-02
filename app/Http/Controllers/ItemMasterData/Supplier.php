<?php

namespace App\Http\Controllers\ItemMasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Traits
use App\Traits\Helper;
class Supplier extends Controller
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
                    'js/supplier',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'         => 'supplier-index',
                'title'             => 'Supplier',
                'ajaxUrl'           => [
                    'ajaxStore'     => route('supplier-store'),
                    'ajaxDestroy'   => route('supplier-destroy'),
                    'ajaxSave'      => route('supplier-save'),
                ],
                'breadCrumb'        => $this->breadCrumb(11, 2),
                'accessRight'       => [ 'id' => 11, 'level' => 2 ]
         ];
        return view('item-master-data.supplier.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Supplier',
            'data'        => []
        ];
        $view = view('item-master-data.supplier.index', $data)->render();
        return $view;
    }

}
