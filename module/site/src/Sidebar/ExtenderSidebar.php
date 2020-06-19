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

			$group->item('Media Social', function(Item $item){
				$item->icon('mdi mdi-share-variant');
				$item->url(route('admin.mediasocial'));
			});

			$group->item('FAQs', function(Item $item){
				$item->icon('mdi mdi-comment-question-outline');
				$item->item('Categories', function(Item $item){
          $item->url(route('admin.faqcategories'));
        });
        
        $item->item('FAQ', function(Item $item){
          $item->url(route('admin.faq'));
        });
			});
		});
		return $menu;
	}
}