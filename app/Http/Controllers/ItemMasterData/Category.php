<?php

namespace App\Http\Controllers\ItemMasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Traits
use App\Traits\Helper;

class Category extends Controller
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
                    'js/category',
                    'vendors/cleave.js/cleave.min'
                 ],
                'indexName'         => 'category-index',
                'title'             => 'Category',
                'ajaxUrl'           => [
                    'ajaxStore'     => route('category-store'),
                    'ajaxDestroy'   => route('category-destroy'),
                    'ajaxSave'      => route('category-save'),
                ],
                'breadCrumb'        => $this->breadCrumb(12, 2),
                'accessRight'       => [ 'id' => 12, 'level' => 2 ]
         ];
        return view('item-master-data.category.main', $data);
    }

    public function index ()
    {
        $data = [
            'title'       => 'Category',
            'data'        => []
        ];
        $view = view('item-master-data.category.index', $data)->render();
        return $view;
    }

    public function add ()
    {
        $data = [
            'subTitle'  => 'Add New Category',
        ];

        $view = view('item-master-data.category.add', $data)->render();
        return $view;
    }

    public function edit ($id)
    {
        $data = [
            'subTitle' => 'Edit Category',
            'row'      => mCategory::find($id)
        ];

        $view = view('item-master-data.category.edit', $data)->render();
        return $view;
    }

    public function store (Request $req)
    {
        if ($req->ajax()) {
            $check = mCategory::where([
                    'cat_name'  => $req->input('cat_name'),
            ])->count();

            if ($check > 0) {
                $result = [ 'message' => 'Category Name is already exists.', 'result' => false ];
            } else {
                mCategory::create([
                    'cat_name'       => $req->input('cat_name'),
                    'spl_created_by' => Auth::id()
                ]);

                $result = [ 'message' => 'The new category is successfully saved.', 'redirect' => route('category-index'), 'result' => true ];
            }

            return response()->json($result);
        }
    }

    public function destroy (Request $req)
    {
        if ($req->ajax()) {
            $row = mCategory::find($req->input('cat_id'));

            if ($row->item()->count() > 0) {
                $result = [ 'message' => 'Can not delete this category.', 'result' => false ];
            } else {
                $row->delete();
                $result = [ 'message' => 'Successfully deleted category.', 'redirect' => route('category-index'), 'result' => true ];
            }

            return response()->json($result);
        }
    }

    public function save (Request $req)
    {
        if ($req->ajax()) {
            $check = mCategory::where([
                'cat_name'  => $req->input('cat_name'),
            ])
            ->where('cat_id', '<>', $req->input('cat_id'))
            ->count();

            if ($check > 0) {
                $result = [ 'message' => 'Category Name ID is already exists.', 'result' => false ];
            } else {
                $row                 = mCategory::find($req->input('cat_id'));
                $row->cat_name       = $req->input('cat_name');
                $row->spl_updated_by = Auth::id();

                $row->save();

                $result = [ 'message' => 'Successfully modified category.', 'redirect' => route('category-index'), 'result' => true ];
            }

            return response()->json($result);
        }
    }
}
