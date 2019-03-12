<?php
/*
 * Sidebars Section
*/

$this->sections[] = array(
	'title' => __('Sidebars', 'ivan_domain_redux'),
	'desc' => __('Define custom sidebars.', 'ivan_domain_redux'),
	'icon' => 'el-icon-magic',
	'fields' => array(

		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => __( 'Custom Sidebars', 'ivan_domain_redux' ),
			'subtitle' => __( 'Custom sidebars can be assigned to any page or post.', 'ivan_domain_redux' ),
			'desc'     => __( 'You can add as many custom sidebars as you need.', 'ivan_domain_redux' )
		),

	),
);