<?php

namespace Master\Payments\Sidebar;

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
			$group->item('Payments', function(Item $item){
				$item->icon('mdi mdi-qrcode-scan');
				$item->url('payments');
				$item->item('Pending', function(Item $item){
          $item->url('#');
        });
        
        $item->item('Success', function(Item $item){
          $item->url('#');
        });
			});
		});
		return $menu;
	}
}