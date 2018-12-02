<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Http\Models\Helper as mHelper;

// Traits
use App\Traits\Helper;
class Apps extends Controller
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
                    'js/apps',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'         => 'apps-index',
                'title'             => 'Apps',
                'ajaxUrl'           => [
                    'ajaxSave'            => route('apps-save'),
                ],
                'breadCrumb'        => $this->breadCrumb(17, 2),
                'accessRight'       => [ 'id' => 17, 'level' => 2 ]
         ];
        return view('setting.user.main', $data);
    }

    public function index ()
    {
        $data = [
            'title' => 'Apps',
            'data'  => []
        ];

        $view = view('setting.apps.index', $data)->render();
        return $view;
    }

}
