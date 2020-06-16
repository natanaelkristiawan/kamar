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
		$menu->group('ADMINISTRATOR', function(Group $group) {
			$group->item('Rooms', function(Item $item){
				$item->icon('mdi mdi-sofa');
				$item->url('rooms');
        $item->item('Owners', function(Item $item){
          $item->url(route('admin.owners'));
        });

        $item->item('Rooms', function(Item $item){
          $item->url(route('admin.rooms'));
        });

        $item->item('Locations', function(Item $item){
          $item->url(route('admin.locations'));
        });

        $item->item('Types', function(Item $item){
          $item->url(route('admin.types'));
        });
				
        $item->item('Ameneties', function(Item $item){
          $item->url(route('admin.ameneties'));
        });
			});
		});
		return $menu;
	}
}