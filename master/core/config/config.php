<?php 

return [
  'upload_folder' => 'core',
	'menuExtends' => [
	'\Master\Core\Sidebar\ExtenderSidebar',
    '\Master\Customers\Sidebar\ExtenderSidebar',
    '\Master\Rooms\Sidebar\ExtenderSidebar',
    '\Master\Books\Sidebar\ExtenderSidebar',
    '\Master\Payments\Sidebar\ExtenderSidebar',
    '\Master\Reviews\Sidebar\ExtenderSidebar',
    '\Master\Articles\Sidebar\ExtenderSidebar',
    '\Master\Packages\Sidebar\ExtenderSidebar',
    '\Module\Site\Sidebar\ExtenderSidebar'
	]
];