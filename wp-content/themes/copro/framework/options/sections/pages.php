<?php
/*
 * Pages Section
*/

$this->sections[] = array(
	'title' => __('Pages', 'ivan_domain_redux'),
	'desc' => __('Change pages settings.', 'ivan_domain_redux'),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id' => 'random-404',
			'type' => 'info',
			'desc' => __('404', 'ivan_domain_redux')
		),

		/* Base Layouts */
		array(
			'id'=>'404-page',
			'type' => 'select',
			'title' => __('404 Page', 'ivan_domain_redux'), 
			'subtitle' => __('Override 404 page.', 'ivan_domain_redux'),
			'data' => 'pages',
			'default' => '',
			'validate' => '',
		),
	), // #fields
);