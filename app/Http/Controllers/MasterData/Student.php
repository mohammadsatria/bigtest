<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

// Controller
use App\Http\Controllers\Deposit\Deposit;

// Traits
use App\Traits\Helper;
class Student extends Controller
{
    use Helper;

    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function main ()
    {
        $data = [
                'importJs'            => [
                    'js/student',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'           => 'student-index',
                'title'               => 'Student',
                'ajaxUrl'             => [
                    'ajaxStore'       => route('student-store'),
                    'ajaxDestroy'     => route('student-destroy'),
                    'ajaxSave'        => route('student-save'),
                    'ajaxDuplicate'   => route('student-duplicate'),
                    'ajaxDetail'      => route('student-detail'),
                    'ajaxUploadImage' => route('student-upload-image')
                ],
                'breadCrumb'          => $this->breadCrumb(10, 2),
                'accessRight'         => [ 'id' => 10, 'level' => 2 ]
         ];
        return view('master-data.student.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Student',
            'data'        => []
        ];
        $view = view('master-data.student.index', $data)->render();
        return $view;
    }

}
