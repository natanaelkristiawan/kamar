<?php

namespace Master\Reviews\Sidebar;

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
			$group->item('Reviews', function(Item $item){
				$item->icon('mdi mdi-signal-variant');
				$item->url(route('admin.reviews'));
			});
		});
		return $menu;
	}
}