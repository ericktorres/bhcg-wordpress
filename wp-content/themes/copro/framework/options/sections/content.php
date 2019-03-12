<?php
/*
 * Content Section
*/

$this->sections[] = array(
	'title' => __('Content', 'ivan_domain_redux'),
	'desc' => __('Change the content configurations.', 'ivan_domain_redux'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id'=>'page-boxed-page',
			'type' => 'switch', 
			'title' => __('Display Pages/Projects Boxed?', 'ivan_domain_redux'),
			'subtitle'=> __('If on, the pages will be displayed in a boxed layout. Can be overloaded per page.', 'ivan_domain_redux'),
			"default" => 0,
		),
	),
);