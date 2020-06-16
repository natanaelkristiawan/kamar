<?php

namespace Master\Reviews\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\SidebarExtender;
use Maatwebsite\Sidebar\Badge;
use Master\Reviews\Interfaces\ReviewsRepositoryInterface;

class ExtenderSidebar implements SidebarExtender 
{
	public function extendWith(Menu $menu)
	{
		$menu->group('ADMINISTRATOR', function(Group $group) {
			$group->item('Reviews', function(Item $item){
				$item->icon('mdi mdi-signal-variant');
				$item->url(route('admin.reviews'));
				$item->badge(function (Badge $badge, ReviewsRepositoryInterface $review) {
				  $badge->setValue($review->countAll());
				});
			});
		});
		return $menu;
	}
}