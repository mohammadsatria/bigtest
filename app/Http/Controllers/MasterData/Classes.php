<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Traits
use App\Traits\Helper;

class Classes extends Controller
{
    use Helper;

    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function main ()
    {
        $data = [
                'importJs'        => [
                    'js/class'
                 ],
                'indexName'       => 'class-index',
                'title'           => 'Class',
                'ajaxUrl'         => [
                    'ajaxStore'   => route('class-store'),
                    'ajaxDestroy' => route('class-destroy'),
                    'ajaxSave'    => route('class-save')
                ],
                'breadCrumb'      => $this->breadCrumb(9, 2),
                'accessRight'     => [ 'id' => 9, 'level' => 2 ]
         ];
        return view('master-data.class.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'     => 'Class',
            'data'      => []
        ];
        $view = view('master-data.class.index', $data)->render();
        return $view;
    }

}
