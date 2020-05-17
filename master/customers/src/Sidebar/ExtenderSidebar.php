<?php

namespace Master\Customers\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('ADMINISTRATOR', function(Group $group) {
			$group->item('Customers', function(Item $item){
				$item->icon('mdi mdi-account-box');
				$item->url(route('admin.customers'));
			});
		});
		return $menu;
	}
}