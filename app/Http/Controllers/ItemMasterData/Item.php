<?php

namespace App\Http\Controllers\ItemMasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Traits
use App\Traits\Helper;
class Item extends Controller
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
                    'js/item',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'         => 'item-index',
                'title'             => 'Item',
                'ajaxUrl'           => [
                    'ajaxStore'   => route('item-store'),
                    'ajaxDestroy' => route('item-destroy'),
                    'ajaxSave'    => route('item-save')
                ],
                'breadCrumb'        => $this->breadCrumb(13, 2),
                'accessRight'       => [ 'id' => 13, 'level' => 2 ]
         ];
        return view('item-master-data.item.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Item',
            'data'        => []
        ];
        $view = view('item-master-data.item.index', $data)->render();
        return $view;
    }

}
