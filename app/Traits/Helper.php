<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

use App\Http\Models\M_menulevel1 as menuLev1;
use App\Http\Models\M_menulevel2 as menuLev2;
use App\Http\Models\M_menulevel3 as menuLev3;

trait Helper
{

	public function breadCrumb($idMenu, $level)
	{
		$menuLevel = [ 1, 2, 3 ];
		$menuStructure = [];
		if (in_array($level, $menuLevel)) {
			// jika level 1
			if ($level - 1 == 0) {
				$row = menuLev1::find($idMenu);
				$menuStructure = [ $row->mlv1_name => $row->mlv1_url  ];
			}else{
			// jika bukan level 1
				if ($level == 3) {
					$lev3 = menuLev3::find($idMenu);
					$lev2 = $lev3->menuLevel2()->first();
					$lev1 = menuLev2::find($lev2->mlv2_id)->menuLevel1()->first();
					$menuStructure = [ $lev3->mlv3_name => $lev3->mlv3_url, $lev2->mlv2_name => $lev2->mlv2_url, $lev1->mlv1_name => $lev2->mlv1_url ];
				} elseif ($level == 2) {
					$lev2 = menuLev2::find($idMenu);
					$lev1 = $lev2->menuLevel1()->first();
					$menuStructure = [ $lev2->mlv2_name => $lev2->mlv2_url, $lev1->mlv1_name => $lev1->mlv1_url ];
				} else {
					$lev1 = menuLev1::find($idMenu);
					$menuStructure = [ $lev1->mlv1_name => $lev1->mlv1_url ];
				}
			}
		}
		return array_reverse($menuStructure);
	}

	public function getParentMenu($idMenu, $level)
	{
		$menuLevel = [ 1, 2, 3 ];
		$menuStructure = [];
		if (in_array($level, $menuLevel)) {
			// jika level 1
			if ($level - 1 == 0) {
				$row           = menuLev1::find($idMenu);
				if ($row->mlv1_active == 1) {
					$menuStructure[$row->mlv1_id] = [
						'icon'  => $row->mlv1_icon,
						'url'   => $row->mlv1_url,
						'order' => $row->mlv1_order,
						'name'  => $row->mlv1_name,
						'status' => $row->mlv1_active,
						'child' => []
					];
				}
			}else{
			// jika bukan level 1
				if ($level == 3) {
					$lev3          = menuLev3::find($idMenu);
					$lev2          = $lev3->menuLevel2()->first();
					$lev1          = menuLev2::find($lev2->mlv2_id)->menuLevel1()->first();
					if ($lev3->mlv3_active == 1) {
						$menuStructure = [
							$lev1->mlv1_id => [
								'icon'   => $lev1->mlv1_icon,
								'name'   => $lev1->mlv1_name,
								'order'  => $lev1->mlv1_order,
								'status' => $lev1->mlv1_active,
								'child'  => [
									$lev2->mlv2_id => [
										'name'   => $lev2->mlv2_name,
										'url'    => $lev2->mlv2_url,
										'order'  => $lev2->mlv2_order,
										'status' => $lev2->mlv2_active,
										'child'  => [
											$lev3->mlv3_id => [
												'name'   => $lev3->mlv3_name,
												'url'    => $lev3->mlv3_url,
												'order'  => $lev3->mlv3_order,
												'status' => $lev3->mlv3_active,
											]
										]
									]
								]
							]
						];
					}
				} elseif ($level == 2) {
					$lev2          = menuLev2::find($idMenu);
					$lev1          = $lev2->menuLevel1()->first();

					if ($lev2->mlv2_active == 1) {
						$menuStructure = [
							$lev1->mlv1_id => [
								'icon'   => $lev1->mlv1_icon,
								'name'   => $lev1->mlv1_name,
								'order'  => $lev1->mlv1_order,
								'status' => $lev1->mlv1_active,
								'child'  => [
									$lev2->mlv2_id => [
										'name'  => $lev2->mlv2_name,
										'url'   => $lev2->mlv2_url,
										'order' => $lev2->mlv2_order,
										'status' => $lev2->mlv2_active,
										'child' => []
									]
								]
							]
						];

					}
				}
			}
		}
		return $menuStructure;
	}
}
