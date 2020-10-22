<?php

namespace Master\Packages\Sidebar;

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
			$group->item('Packages', function(Item $item){
				$item->icon('fa fa-fw fa-rss');
				$item->url('package');

				$item->item('Packages', function(Item $item){
					$item->url(route('admin.packages'));
				});

				$item->item('Counter Report', function(Item $item){
					$item->url(route('admin.counter'));
				});

			});

			
		});
		return $menu;
	}
}