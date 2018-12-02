<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

// Model
use App\Http\Models\M_menulevel1 as menuLev1;
use App\Http\Models\M_menulevel2 as menuLev2;
use App\Http\Models\M_menulevel3 as menuLev3;
use App\Http\Models\User_access as mUserAccess;

// Helper
use Auth;
use App\Traits\Helper;

class MenuComposer
{
    use Helper;

    public function compose(View $view)
    {
        if (Auth::id()) {
            $menuAccess = mUserAccess::where('ust_id', Auth::user()->ust_id)
            ->where('usa_status', '<>', 'N')
            ->orderBy('usa_menu_level', 'asc')
            ->get();

            $userMenuAccess = [];
            $menuAccessable = [];
            foreach ($menuAccess as $key => $val) {
                $menuAccessable[$val->usa_menu_level][$val->usa_menu_id] = $val->usa_status;
                $menu = $this->getParentMenu($val->usa_menu_id, $val->usa_menu_level);
                foreach ($menu as $key => $val1) {
                    if ($val1['status'] == 1) {
                        $userMenuAccess[$val1['order']]['icon']  = $val1['icon'];
                        $userMenuAccess[$val1['order']]['name']  = $val1['name'];
                        $userMenuAccess[$val1['order']]['order'] = $val1['order'];

                        if (count($val1['child']) > 0) {
                            foreach ($val1['child'] as $idMenu => $child) {
                                if ($child['status'] == 1) {
                                    if ($val->usa_menu_level == 2) {
                                        $userMenuAccess[$val1['order']]['child'][$child['order']] = $child;
                                    }

                                    if (count($child['child']) > 0) {
                                        $userMenuAccess[$val1['order']]['child'][$child['order']]['name']   = $child['name'];
                                        $userMenuAccess[$val1['order']]['child'][$child['order']]['url']    = $child['url'];
                                        $userMenuAccess[$val1['order']]['child'][$child['order']]['status'] = $child['status'];

                                        foreach ($child['child'] as $field => $child3) {
                                            $userMenuAccess[$val1['order']]['child'][$child['order']]['child'][$child3['order']] = $child3;
                                        }
                                    }
                                }
                            }
                            ksort($userMenuAccess[$val1['order']]['child']);
                        } else {
                            $userMenuAccess[$val1['order']]['child'] = [];
                            $userMenuAccess[$val1['order']]['url']   = $val1['url'];
                        }
                    }
                }
                ksort($userMenuAccess);
            }

            $data = [
                'menu'           => $userMenuAccess,
                'menuAccessable' => $menuAccessable
            ];

            $view->with($data);
        }
    }
}
