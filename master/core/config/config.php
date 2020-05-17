<?php 

return [
  'upload_folder' => 'core',
	'menuExtends' => [
		'\Master\Core\Sidebar\ExtenderSidebar',
    '\Master\Customers\Sidebar\ExtenderSidebar',
    '\Master\Rooms\Sidebar\ExtenderSidebar',
    '\Master\Books\Sidebar\ExtenderSidebar',
    '\Master\Payments\Sidebar\ExtenderSidebar',
    '\Master\Articles\Sidebar\ExtenderSidebar',
    '\Module\Site\Sidebar\ExtenderSidebar'
	]
];