<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
// Model
use App\Http\Models\Usertype as mUsertype;
use App\User as mUser;

// Traits
use App\Traits\Helper;

class User extends Controller
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
                    'js/user',
                 ],
                'indexName'         => 'user-index',
                'title'             => 'User',
                'ajaxUrl'           => [
                    'ajaxStore'           => route('user-store'),
                    'ajaxDestroy'         => route('user-destroy'),
                    'ajaxSave'            => route('user-save'),
                    'ajaxUploadImageUser' => route('user-upload-image')
                ],
                'breadCrumb'        => $this->breadCrumb(16, 2),
                'accessRight'       => [ 'id' => 16, 'level' => 2 ]
         ];
        return view('setting.user.main', $data);
    }

    public function index ()
    {
        $data = [
            'title' => 'User',
            'data'  => mUser::with('usertype')->get()
        ];

        $view = view('setting.user.index', $data)->render();
        return $view;
    }

    public function add ()
    {
        // $hashed_random_password = Hash::make(str_random(8));
        $data = [
            'subTitle' => 'Add New User',
            'usertype' => mUsertype::all(),
            'passGenerate' => str_random(8)

        ];
        $view = view('setting.user.add', $data)->render();
        return $view;
    }

    public function edit ($id)
    {
        $data = [
            'subTitle' => 'Edit User',
            'data'     => mUser::find($id),
            'usertype' => mUsertype::all(),
        ];
        $view = view('setting.user.edit', $data)->render();
        return $view;
    }


    public function userEditProfile ()
    {
        $data = [
            'subTitle' => 'Edit User',
            'data'     => mUser::find(Auth::id()),
            'usertype' => mUsertype::all(),
        ];
        $view = view('setting.user.edit-profile', $data)->render();
        return $view;
    }

    public function editProfile ()
    {
        $data = [
                'importJs'          => [
                    'js/user',
                 ],
                'indexName'         => 'edit-user-profile',
                'title'             => 'User',
                'ajaxUrl'           => [
                    'ajaxStore'           => route('user-store'),
                    'ajaxDestroy'         => route('user-destroy'),
                    'ajaxSave'            => route('user-save'),
                    'ajaxUploadImageUser' => route('user-upload-image')
                ],
                'breadCrumb'        => $this->breadCrumb(16, 2),
                'accessRight'       => [ 'id' => 16, 'level' => 2 ],
         ];
        return view('setting.user.main', $data);
    }

    public function profile ()
    {
        $data = [
            'subTitle' => 'Profile',
            'user'     => mUser::find(Auth::id())
        ];
        $view = view('setting.user.profile', $data)->render();
        return $view;
    }

    public function uploadImage (Request $req)
    {
        if ($req->ajax()) {
            $extension    = $req->file('file')->getClientOriginalExtension();
            $dir          = 'public/uploads/user/';
            $row          = mUser::find($req->input('id'));

            if (!empty($row->img)) {
                unlink($dir.$row->id . '.' . $row->img);
            }

            $row->img = $extension;

            $filename     = $row->id . '.' . $extension;
            $req->file('file')->move(base_path($dir), $filename);

            $row->save();

            $result = ['result' => true ];

            return response()->json($result);

        }
    }

    public function store (Request $req)
    {
        if ($req->ajax()) {
            $check = mUser::where('username', $req->input('username'))->count();
            if ($check > 0) {
                $result = [ 'message' => 'User is already exists.', 'result' => false ];
            } else {
                $user = mUser::create([
                    'username'   => $req->input('username'),
                    'password'   => Hash::make($req->input('password')),
                    'email'      => $req->input('email'),
                    'name'       => $req->input('name'),
                    'ust_id'     => $req->input('usertypeId'),
                    'created_by' => Auth::id()
                ]);

                $result = [
                    'message'  => 'The new user is successfully saved.',
                    'result'   => true,
                    'redirect' => route('user-index'),
                    'id'       => $user->id
                ];
            }

            return response()->json($result);
        }
    }

    public function destroy (Request $req)
    {
        if ($req->ajax()) {
            $row = mUser::find($req->input('id'));

            if (file_exists('public/uploads/user/'.$row->id . '.' . $row->img)) {
                unlink('public/uploads/user/'.$row->id . '.' . $row->img);
            }

            $row->delete();

            $result = [ 'message' => 'Successfully deleted user.', 'result' => true, 'redirect' => route('user-index') ];
            return response()->json($result);
        }
    }

    public function save (Request $req)
    {
        if ($req->ajax()) {
            $check = mUser::where('username', $req->input('username'))
            ->where('id', '<>', $req->input('id'))
            ->count();

            if ($check > 0) {
                $result = [ 'message' => 'User is already exists.', 'result' => false ];
            } else {
                $row             = mUser::find($req->input('id'));
                $row->username   = $req->input('username');
                $row->email      = $req->input('email');
                $row->name       = $req->input('name');
                $row->ust_id     = $req->input('usertypeId');
                $row->updated_by = Auth::id();

                if (!empty($req->input('password'))) {
                    $row->password   = Hash::make($req->input('password'));
                }

                $row->save();

                $result = [
                    'message'  => 'Successfully modified user.',
                    'result'   => true,
                    'redirect' => route('user-index'),
                    'id'       => $row->id
                ];

                if ($req->input('status') == 'editProfile') {
                    $result['redirect'] = route('user-profile');
                }
            }
            return response()->json($result);
        }
    }

}
