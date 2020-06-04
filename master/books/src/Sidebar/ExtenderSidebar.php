<?php

namespace Master\Books\Sidebar;

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
			$group->item('Books', function(Item $item){
				$item->icon('mdi mdi-calendar-clock');
				$item->url('books');
				$item->item('Pending', function(Item $item){
          $item->url(route('admin.bookPending'));
        });
        
        $item->item('Success', function(Item $item){
          $item->url(route('admin.bookSuccess'));
        });
			});
		});
		return $menu;
	}
}