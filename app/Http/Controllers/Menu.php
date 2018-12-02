<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Models\M_menulevel1 as menuLev1;
use App\Http\Models\M_menulevel2 as menuLev2;
use App\Http\Models\M_menulevel3 as menuLev3;
use App\Http\Models\User_access as mUserAccess;


use App\Traits\Helper;

class Menu extends Controller
{
    use Helper;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function main()
    {
        $data = [
                'importJs'  => [
                    'js/menu'
                 ],
                'indexName' => 'menu-index',
                'title'     => 'Menus',
                'ajaxUrl'   => [
                        'ajaxGetOrder'    => route('menu-getorder'),
                        'ajaxGetParent'   => route('menu-getparent'),
                        'ajaxStoreMenu'   => route('menu-store'),
                        'ajaxEdit'        => route('menu-edit'),
                        'ajaxGetRow'      => route('menu-getrow'),
                        'ajaxSaveMenu'    => route('menu-save'),
                        'ajaxDestroyMenu' => route('menu-destroy')
                ],
                'breadCrumb'  => $this->breadCrumb(6, 2),
                'accessRight' => [ 'id' => 6, 'level' => 2 ]
         ];
        return view('menu.main', $data);
    }

    public function index()
    {
        $data = [
                'title' => 'Menus',
                'data'  => $this->getAllMenu()
        ];
        $view = view('menu.index', $data)->render();
        return $view;
    }

    public function add()
    {
        $data = [
            'subTitle' => 'Add New Menu'
        ];
        $view = view('menu.add', $data)->render();
        return $view;
    }

    public function edit($id, $level) {
        $data = [
            'subTitle' => 'Edit Menu',
            'level'    => $level
        ];

        if ($level == 1) {
            $data['data']  = menuLev1::find($id);
            $data['count'] = menuLev1::all()->count();
        } elseif ($level == 2) {
            $data['data']   = menuLev2::find($id);
            $data['parent'] = menuLev1::all();

            $cond           = [ 'mlv2_parent_id' => $data['data']->mlv2_parent_id ];
            $data['count']  = menuLev2::getMenuLev2($cond)->count();
        } elseif ($level == 3) {
            $data['data']   = menuLev3::find($id);
            $data['parent'] = menuLev2::all();

            $cond           = [ 'mlv3_parent_id' => $data['data']->mlv3_parent_id ];
            $data['count']  = menuLev3::getMenuLev3($cond)->count();
        }

        $view = view('menu.edit', $data)->render();
        return $view;
    }

    public function getRow(Request $req)
    {
        if ($req->ajax()) {
            $data = [];
            $id = $req->input('id');
            if ($req->input('level') == 1) {
                $data          = menuLev1::find($id);
                $data['count'] = menuLev1::all()->count();
            } elseif ($req->input('level') == 2) {
                $data           = menuLev2::find($id);
                $data['parent'] = menuLev1::all();

                $cond           = [ 'mlv2_parent_id' => $data->mlv2_parent_id ];
                $data['count']  = menuLev2::getMenuLev2($cond)->count();
            } elseif ($req->input('level') == 3) {
                $data           = menuLev3::find($id);
                $data['parent'] = menuLev2::all();

                $cond           = [ 'mlv3_parent_id' => $data->mlv3_parent_id ];
                $data['count']  = menuLev3::getMenuLev3($cond)->count();
            }

            return response()->json($data);
        }
    }

    public function store(Request $req)
    {
        if ($req->ajax()) {
              if ($req->input('menuLevel') == 1) {
                  $isDuplicate = menuLev1::where('mlv1_name', '=', $req->input('menuName'))->get();
                  if ($isDuplicate->count() > 0) {
                      $result = [ 'message' => 'Menu Name already exists.', 'result' => false ];
                      return response()->json($result);
                      die();
                  }

                  menuLev1::where('mlv1_order', '>=', $req->input('menuOrder'))->increment('mlv1_order');
                  menuLev1::create([
                        'mlv1_name'       => $req->input('menuName'),
                        'mlv1_url'        => $req->input('menuUrl'),
                        'mlv1_icon'       => $req->input('menuIcon'),
                        'mlv1_active'     => $req->input('menuActive'),
                        'mlv1_order'      => $req->input('menuOrder'),
                        'mlv1_created_by' => Auth::id()
                  ]);

              } elseif ($req->input('menuLevel') == 2) {
                  $isDuplicate = menuLev2::where('mlv2_name', '=', $req->input('menuName'))->get();
                  if ($isDuplicate->count() > 0) {
                      $result = [ 'message' => 'Menu Name already exists.', 'result' => false ];
                      return response()->json($result);
                      die();
                  }

                  menuLev2::where('mlv2_order', '>=', $req->input('menuOrder'))->increment('mlv2_order');
                  menuLev2::create([
                        'mlv2_name'       => $req->input('menuName'),
                        'mlv2_url'        => $req->input('menuUrl'),
                        'mlv2_parent_id'  => $req->input('menuParent'),
                        'mlv2_active'     => $req->input('menuActive'),
                        'mlv2_order'      => $req->input('menuOrder'),
                        'mlv2_created_by' => Auth::id()
                  ]);
              } else {
                  $isDuplicate = menuLev3::where('mlv3_name', '=', $req->input('menuName'))->get();
                  if ($isDuplicate->count() > 0) {
                      $result = [ 'message' => 'Menu Name already exists.', 'result' => false ];
                      return response()->json($result);
                      die();
                  }

                  menuLev3::where('mlv3_order', '>=', $req->input('menuOrder'))->increment('mlv3_order');
                  menuLev3::create([
                        'mlv3_name'       => $req->input('menuName'),
                        'mlv3_url'        => $req->input('menuUrl'),
                        'mlv3_parent_id'  => $req->input('menuParent'),
                        'mlv3_active'     => $req->input('menuActive'),
                        'mlv3_order'      => $req->input('menuOrder'),
                        'mlv3_created_by' => Auth::id()
                  ]);
              }

              $result = [ 'message' => 'The new menu is successfully saved.', 'result' => true, 'redirect' => route('menu-index') ];

              return response()->json($result);
         }
    }

    public function save(Request $req)
    {
        if ($req->ajax()) {
            $menuLevel = $req->input('menuLevel');
            $prevLevel = $req->input('prevLevel');
            $menuName  = $req->input('menuName');
            $menuIcon  = $req->input('menuIcon');
            $menuParent= $req->input('menuParent');
            $menuId    = $req->input('menuId');
            $menuOrder = $req->input('menuOrder');
            $menuActive= $req->input('menuActive');
            $menuUrl   = $req->input('menuUrl');
            $prevOrder = $req->input('prevOrder');

            $check = 0;
            if ($menuLevel != $prevLevel) {
                if ($prevLevel == 1) {
                    $check = menuLev1::find($menuId)->menuLevel2()->count();
                } elseif ($prevLevel == 2) {
                    $check = menuLev2::find($menuId)->menuLevel3()->count();
                }
            }

            $result = [];
            if ($check > 0) {
                $result['result'] = false;
                $result['message'] = 'Cannot switch level because this is parent menu.';

                return response()->json($result);
                die();
            } else {
                if ($menuLevel == 1) {
                    if ($prevLevel == 1) {
                        if ($menuOrder != $prevOrder) {
                            $row = menuLev1::where([ 'mlv1_order' => $menuOrder ])->get();
                            $row = $row->first();

                            $row->mlv1_order = $prevOrder;
                            $row->save();
                        }

                        $row                  = menuLev1::find($menuId);
                        $row->mlv1_name       = $menuName;
                        $row->mlv1_url        = $menuUrl;
                        $row->mlv1_icon       = $menuIcon;
                        $row->mlv1_active     = $menuActive;
                        $row->mlv1_order      = $menuOrder;
                        $row->mlv1_updated_by = Auth::id();

                        $row->save();

                    } else {
                        menuLev1::where('mlv1_order', '>=', $req->input('menuOrder'))->increment('mlv1_order');
                        menuLev1::create([
                              'mlv1_name'       => $menuName,
                              'mlv1_url'        => $menuUrl,
                              'mlv1_icon'       => $menuIcon,
                              'mlv1_active'     => $menuActive,
                              'mlv1_order'      => $menuOrder,
                              'mlv1_created_by' => Auth::id()
                        ]);

                        if ($prevLevel == 2) {
                            $row = menuLev2::find($menuId);
                            menuLev2::where('mlv2_order', '>=', $row->mlv2_order)
                            ->where('mlv2_parent_id', $row->mlv2_parent_id)
                            ->decrement('mlv2_order');

                            $row->delete();
                        } elseif ($prevLevel == 3) {
                            $row = menuLev3::find($menuId);
                            menuLev3::where('mlv3_order', '>=', $row->mlv3_order)
                            ->where('mlv3_parent_id', $row->mlv3_parent_id)
                            ->decrement('mlv3_order');

                            $row->delete();
                        }

                    }
                } elseif ($menuLevel == 2) {
                    if ($prevLevel == 2) {
                        if ($menuOrder != $prevOrder) {
                            $row = menuLev2::where([
                                'mlv2_order'     => $menuOrder,
                                'mlv2_parent_id' => $menuParent
                            ])->get();

                            $row = $row->first();

                            $row->mlv2_order = $prevOrder;
                            $row->save();
                        }

                        $row                    = menuLev2::find($menuId);
                        $row->mlv2_name         = $menuName;
                        $row->mlv2_parent_id    = $menuParent;
                        $row->mlv2_url          = $menuUrl;
                        $row->mlv2_active       = $menuActive;
                        $row->mlv2_order        = $menuOrder;
                        $row->mlv2_updated_by   = Auth::id();

                        $row->save();
                    } else {
                        menuLev2::where('mlv2_order', '>=', $req->input('menuOrder'))
                        ->where('mlv2_parent_id', $menuParent)
                        ->increment('mlv2_order');

                        menuLev2::create([
                              'mlv2_name'         => $menuName,
                              'mlv2_url'          => $menuUrl,
                              'mlv2_parent_id'    => $menuParent,
                              'mlv2_active'       => $menuActive,
                              'mlv2_order'        => $menuOrder,
                              'mlv2_created_by'   => Auth::id()
                        ]);

                        if ($prevLevel == 1) {
                            $row = menuLev1::find($menuId);
                            menuLev1::where('mlv1_order', '>=', $row->mlv1_order)
                            ->decrement('mlv1_order');

                            $row->delete();
                        } elseif ($prevLevel == 3) {
                            $row = menuLev3::find($menuId);
                            menuLev3::where('mlv3_order', '>=', $row->mlv3_order)
                            ->where('mlv3_parent_id', $row->mlv3_parent_id)
                            ->decrement('mlv3_order');

                            $row->delete();
                        }
                    }
                } elseif ($menuLevel == 3) {
                    if ($prevLevel == 3) {

                        if ($menuOrder != $prevOrder) {
                            $row = menuLev3::where([
                                'mlv3_order'     => $menuOrder,
                                'mlv3_parent_id' => $menuParent
                            ])->get();

                            $row = $row->first();

                            $row->mlv3_order = $prevOrder;
                            $row->save();
                        }

                        $row                    = menuLev3::find($menuId);
                        $row->mlv3_name         = $menuName;
                        $row->mlv3_parent_id    = $menuParent;
                        $row->mlv3_url          = $menuUrl;
                        $row->mlv3_active       = $menuActive;
                        $row->mlv3_order        = $menuOrder;
                        $row->mlv3_updated_by   = Auth::id();

                        $row->save();
                    } else {
                        menuLev3::where('mlv3_order', '>=', $req->input('menuOrder'))
                        ->where('mlv3_parent_id', $menuParent)
                        ->increment('mlv3_order');

                        menuLev3::create([
                              'mlv3_name'         => $menuName,
                              'mlv3_url'          => $menuUrl,
                              'mlv3_parent_id'    => $menuParent,
                              'mlv3_active'       => $menuActive,
                              'mlv3_order'        => $menuOrder,
                              'mlv3_created_by'   => Auth::id()
                        ]);

                        if ($prevLevel == 1) {
                            $row = menuLev1::find($menuId);
                            menuLev1::where('mlv1_order', '>=', $row->mlv1_order)->decrement('mlv1_order');

                            $row->delete();
                        } elseif ($prevLevel == 2) {
                            $row = menuLev2::find($menuId);
                            menuLev2::where('mlv2_order', '>=', $row->mlv2_order)
                            ->where('mlv2_parent_id', $row->mlv2_parent_id)
                            ->decrement('mlv2_order');

                            $row->delete();
                        }
                    }
                }
                $result = [ 'message' => 'Successfully modified menu.', 'result' => true, 'redirect' => route('menu-index') ];
                return response()->json($result);
                die();
            }
        }
    }

    public function destroy(Request $req)
    {
        $id = $req->input('id');

        $checkUserAccess = mUserAccess::where([
            'usa_menu_level' => $req->input('level'),
            'usa_menu_id'    => $id
        ])->get()->count();

        if ($checkUserAccess > 0) {
            $result['result']  = false;
            $result['message'] = 'The menu cannot be deleted because it is being used in user access';

            return response()->json($result);
            die();
        }

        if ($req->input('level') == 1) {
            $check = menuLev1::find($id)->menuLevel2()->count();
            if ($check > 0) {
                $result['result'] = false;
                $result['message'] = 'Can not delete this menu. This is menu parent.';

                return response()->json($result);
                die();
            }

            $exec = menuLev1::find($id);
            menuLev1::where('mlv1_order', '>=', $exec->mlv1_order)->decrement('mlv1_order');

            $exec->delete();
        } elseif ($req->input('level') == 2) {
            $check = menuLev2::find($id)->menuLevel3()->count();
            if ($check > 0) {
                $result['result'] = false;
                $result['message'] = 'Can not delete this menu. This is menu parent.';

                return response()->json($result);
                die();
            }
            $exec = menuLev2::find($id);
            menuLev2::where('mlv2_order', '>=', $exec->mlv2_order)->decrement('mlv2_order');

            $exec->delete();
        } else {
            $exec = menuLev3::find($id);
            menuLev3::where('mlv3_order', '>=', $exec->mlv3_order)->decrement('mlv3_order');

            $exec->delete();
        }

        $result = [ 'message' => 'successfully deleted menu.', 'result' => true, 'redirect' => route('menu-index') ];
        return $result;
    }

    public function getMenu(Request $req)
    {
        $level = $req->input('level');
        $data = [];
        if ($level == 3) {
            $data = menuLev2::all();
        } elseif ($level == 2) {
            $data = menuLev1::all();
        }
        return response()->json($data);
    }

    public function getOrder(Request $req)
    {
        $level   = $req->input('level');
        $parent  = $req->input('parent');
        $prevLev = $req->input('prevLevel');
        $cond    = [ 'mlv'.$level. '_parent_id' => $parent ];

        if ($level == 3) {
            $countData = menuLev3::getMenuLev3($cond)->count();
        } elseif ($level == 2) {
            $countData = menuLev2::getMenuLev2($cond)->count();
        } else {
            $countData = menuLev1::all()->count();
        }

        return response()->json([ 'count' => $countData ]);
    }

    public function getAllMenu()
    {
        $dataMenuLev1 = menuLev1::orderBy('mlv1_order', 'asc')->get();
        $menus = array();
        foreach ($dataMenuLev1 as $key => $val) {
            $menus[$val->mlv1_name] = [
                            'id'     => $val->mlv1_id,
                            'url'    => $val->mlv1_url,
                            'icon'   => $val->mlv1_icon,
                            'active' => $val->mlv1_active,
                            'child'  => []
                        ];

            // get menu level2
            $cond = [ 'mlv2_parent_id' => $val->mlv1_id ];
            $dataMenuLev2 = menuLev2::getMenuLev2($cond);
            if($dataMenuLev2->count() > 0){
                $menus[$val->mlv1_name] = [
                            'id'     => $val->mlv1_id,
                            'url'    => $val->mlv1_url,
                            'icon'   => $val->mlv1_icon,
                            'active' => $val->mlv1_active,
                            'child'  => []
                            ];
                foreach ($dataMenuLev2 as $key2 => $lev2) {
                    $menus[$val->mlv1_name]['child'][$lev2->mlv2_name] = [
                            'id'     => $lev2->mlv2_id,
                            'url'    => $lev2->mlv2_url,
                            'active' => $lev2->mlv2_active,
                            'child'  => []
                        ];

                    // get menu level3
                    $cond = [ 'mlv3_parent_id' => $lev2->mlv2_id ];
                    $dataMenuLev3 = menuLev3::getMenuLev3($cond);
                    if($dataMenuLev3->count() > 0){
                        foreach ($dataMenuLev3 as $key3 => $lev3) {
                            $menus[$val->mlv1_name]['child'][$lev2->mlv2_name]['child'][$lev3->mlv3_name] = [
                                'id'     => $lev3->mlv3_id,
                                'url'    => $lev3->mlv3_url,
                                'active' => $lev3->mlv3_active
                            ];
                        }
                    }
                }
            }
        }
        return $menus;
    }
}
