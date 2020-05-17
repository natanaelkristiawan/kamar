<?php

namespace Module\Site\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('WEBSITE', function(Group $group) {
			$group->item('Site', function(Item $item){
				$item->icon('mdi mdi-cloud-sync');
				$item->url(route('admin.site'));
			});
		});
		return $menu;
	}
}