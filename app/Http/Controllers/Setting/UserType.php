<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Controller
use App\Http\Controllers\Menu;

// Model
use App\Http\Models\Usertype as mUsertype;
use App\Http\Models\User_access as mUserAccess;

// Traits
use App\Traits\Helper;

class UserType extends Controller
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
                    'js/usertype'
                 ],
                'indexName'         => 'usertype-index',
                'title'             => 'User Type',
                'ajaxUrl'           => [
                    'ajaxStore'           => route('usertype-store'),
                    'ajaxDestroy'         => route('usertype-destroy'),
                    'ajaxSave'            => route('usertype-save')
                ],
                'breadCrumb'        => $this->breadCrumb(8, 2),
                'accessRight'       => [ 'id' => 8, 'level' => 2 ]
         ];
        return view('setting.usertype.main', $data);
    }

    public function index ()
    {
        $data = [
            'title' => 'User Type',
            'data'  => mUsertype::all(),
        ];
        $view = view('setting.usertype.index', $data)->render();
        return $view;
    }

    public function add ()
    {
        $data = [
            'subTitle' => 'Add New User Type'
        ];
        $view = view('setting.usertype.add', $data)->render();
        return $view;
    }

    public function userAccess ($id)
    {
        $getUserAccess = mUserAccess::where('ust_id', $id)->get();
        $userAccess = [];
        foreach ($getUserAccess as $key => $val) {
            $userAccess[] = 'lev-'.$val->usa_menu_level.'-'.$val->usa_menu_id;
        }

        $data = [
            'subTitle'                 => 'User Access',
            'data'                     => (new Menu)->getAllMenu(),
            'userAccess'               => $userAccess,
            'importJs'                 => [
                'js/usertype',
             ],
             'ajaxUrl'                 => [
                 'ajaxStoreUserAccess' => route('usertype-store-user-access')
             ],
            'usertypeId'               => $id,
            'accessRight'              => [ 'id' => 8, 'level' => 2 ]

        ];

        $view = view('setting.usertype.user-access', $data)->render();
        return $view;
    }

    public function edit ($id)
    {
        $data = [
            'subTitle' => 'Edit User Type',
            'data'     => mUsertype::find($id)
        ];
        $view = view('setting.usertype.edit', $data)->render();
        return $view;
    }

    public function store (Request $req)
    {
        if ($req->ajax()) {
            $check = mUsertype::where('ust_name', $req->input('ust_name'))->count();
            if ($check > 0) {
                $result = [ 'message' => 'User Type is already exists.', 'result' => false ];
            } else {
                mUsertype::create([
                    'ust_name'       => $req->input('ust_name'),
                    'ust_created_by' => Auth::id()
                ]);

                $result = [ 'message' => 'The new user type is successfully saved.', 'result' => true, 'redirect' => route('usertype-index') ];
            }

            return response()->json($result);
        }
    }

    public function StoreUserAccess(Request $req)
    {
        if ($req->ajax()) {
            $data = json_decode($req->input('userAccess'), true);
            $condition = [ 'ust_id' => $req->input('usertypeId') ];
            $deletes = mUserAccess::destroyUserAccess($condition);
            foreach ($data as $key => $val) {
                mUserAccess::create([
                    'ust_id'         => $req->input('usertypeId'),
                    'usa_menu_level' => $val['level'],
                    'usa_menu_id'    => $val['id'],
                    'usa_status'     => $val['status'],
                    'usa_created_by' => Auth::id()
                ]);
            }

            $result = [
                'message' => 'Successfully modified user access.',
                'result' => true,
                'redirect' => route('usertype-index')
            ];

            return response()->json($result);
        }
    }

    public function destroy (Request $req)
    {
        if ($req->ajax()) {
            $row = mUsertype::find($req->input('ust_id'));

            if ($row->user()->count() > 0) {
                $result = [ 'message' => 'Can not delete this usertype.', 'result' => false ];
            } else {
                $condition        = [ 'ust_id'  => $req->input('ust_id') ];
                $deleteUserAccess = mUserAccess::destroyUserAccess($condition);
                $row->delete();
                $result           = [ 'message' => 'Successfully deleted user type.', 'result' => true, 'redirect' => route('usertype-index') ];
            }
            return response()->json($result);
        }
    }

    public function save (Request $req)
    {
        if ($req->ajax()) {
            $check = mUsertype::where('ust_name', $req->input('ust_name'))
            ->where('ust_id', '<>', $req->input('ust_id'))
            ->count();

            if ($check > 0) {
                $result = [ 'message' => 'User Type is already exists.', 'result' => false ];
            } else {
                $row                 = mUsertype::find($req->input('ust_id'));
                $row->ust_name       = $req->input('ust_name');
                $row->ust_updated_by = Auth::id();

                $row->save();

                $result = [ 'message' => 'Successfully modified user type.', 'result' => true, 'redirect' => route('usertype-index') ];
            }
            return response()->json($result);
        }
    }

}
