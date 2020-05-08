<?php

namespace Master\Rooms\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;


class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('Main Navigator', function(Group $group) {
			$group->item('Rooms', function(Item $item){
				$item->icon('mdi mdi-sofa');
				$item->url('rooms');
				$item->item('Ameneties', function(Item $item){
          $item->url(route('admin.ameneties'));
        });

        $item->item('Types', function(Item $item){
          $item->url(route('admin.types'));
        });
        
        $item->item('Locations', function(Item $item){
          $item->url(route('admin.locations'));
        });

        $item->item('Rooms', function(Item $item){
          $item->url('#');
        });
			});
		});
		return $menu;
	}
}