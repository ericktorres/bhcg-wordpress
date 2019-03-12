<?php
/*
 * Layout Section
*/

$this->sections[] = array(
	'title' => __('Footer', 'ivan_domain_redux'),
	'desc' => __('Change the footer section configuration.', 'ivan_domain_redux'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id'=>'footer-enable-switch',
			'type' => 'switch', 
			'title' => __('Disable this layout part?', 'ivan_domain_redux'),
			'subtitle'=> __('If on, this layout part will not be displayed.', 'ivan_domain_redux'),
			"default" => 0,
		),

		array(
			'id'=>'footer-layout',
			'type' => 'select',
			'title' => __('Footer Layout', 'ivan_domain_redux'), 
			'subtitle' => __('Select the footer layout to be used.', 'ivan_domain_redux'),
			'options' => apply_filters('ivan_footer_layouts', array( 
					'Ivan_Layout_Footer_Normal' => 'Customizable Columns',
					) ),
			'default' => 'Ivan_Layout_Footer_Normal',
			'validate' => 'not_empty',
		),

		array(
			'id' => 'footer-column-1',
			'type' => 'slider',
			'title' => __('#1 Column Width', 'ivan_domain_redux'),
			'desc' => __('Define column width, max is 12 parts, set as 0 to disable this area.', 'ivan_domain_redux'),
			'subtitle' => __('The four columns width combined should be equal to 12! Otherwise the layout will break.', 'ivan_domain_redux'),
			"default" => "3",
			"min" => "0",
			"step" => "1",
			"max" => "12",
		),

		array(
			'id' => 'footer-column-2',
			'type' => 'slider',
			'title' => __('#2 Column Width', 'ivan_domain_redux'),
			'desc' => __('Define column width, max is 12 parts, set as 0 to disable this area.', 'ivan_domain_redux'),
			'subtitle' => __('The four columns width combined should be equal to 12! Otherwise the layout will break.', 'ivan_domain_redux'),
			"default" => "3",
			"min" => "0",
			"step" => "1",
			"max" => "12",
		),

		array(
			'id' => 'footer-column-3',
			'type' => 'slider',
			'title' => __('#3 Column Width', 'ivan_domain_redux'),
			'desc' => __('Define column width, max is 12 parts, set as 0 to disable this area.', 'ivan_domain_redux'),
			'subtitle' => __('The four columns width combined should be equal to 12! Otherwise the layout will break.', 'ivan_domain_redux'),
			"default" => "3",
			"min" => "0",
			"step" => "1",
			"max" => "12",
		),

		array(
			'id' => 'footer-column-4',
			'type' => 'slider',
			'title' => __('#4 Column Width', 'ivan_domain_redux'),
			'desc' => __('Define column width, max is 12 parts, set as 0 to disable this area.', 'ivan_domain_redux'),
			'subtitle' => __('The four columns width combined should be equal to 12! Otherwise the layout will break.', 'ivan_domain_redux'),
			"default" => "3",
			"min" => "0",
			"step" => "1",
			"max" => "12",
		),

		array(
			'id' => 'random-footer',
			'type' => 'info',
			'desc' => __('Dynamic Areas', 'ivan_domain_redux')
		),

		array(
			'id'=>'footer-da-before-enable',
			'type' => 'switch', 
			'title' => __('Enable Dynamic Area Before Footer?', 'ivan_domain_redux'),
			'subtitle'=> __('If on, a dynamic area will be displayed above the layout.', 'ivan_domain_redux'),
			"default" => 0,
		),

		array(
			'id'=>'footer-da-before',
			'type' => 'select',
			'title' => __('Before Dynamic Content Page', 'ivan_domain_redux'), 
			'subtitle' => __('Select the page from where the content will be loaded and displayed.', 'ivan_domain_redux'),
			'data' => 'pages',
			'required' => array( 'footer-da-before-enable', '=', 1),
		),

		array(
			'id'=>'footer-da-after-enable',
			'type' => 'switch', 
			'title' => __('Enable Dynamic Area After Footer?', 'ivan_domain_redux'),
			'subtitle'=> __('If on, a dynamic area will be displayed below the layout.', 'ivan_domain_redux'),
			"default" => 0,
		),

		array(
			'id'=>'footer-da-after',
			'type' => 'select',
			'title' => __('After Dynamic Content Page', 'ivan_domain_redux'), 
			'subtitle' => __('Select the page from where the content will be loaded and displayed.', 'ivan_domain_redux'),
			'data' => 'pages',
			'required' => array( 'footer-da-after-enable', '=', 1),
		),
		
		array(
			'id' => 'random-floating',
			'type' => 'info',
			'desc' => __('Floating Contact Form', 'ivan_domain_redux')
		),

		array(
			'id'=>'footer-floating-contact-form',
			'type' => 'switch', 
			'title' => __('Enable Floating Contact Form', 'ivan_domain_redux'),
			'subtitle'=> __('If on, a floating contact form will be displayed in the right bottom corner.', 'ivan_domain_redux'),
			'desc' => sprintf(__('If you don\'t receive emails please check your email server settings. Most servers doesn\'t allow to send emails without smtp authentication. This little plugin can be helpful %s', 'ivan_domain_redux'), '<a href="https://wordpress.org/plugins/webriti-smtp-mail/">Easy SMTP Mail</a>'),
			"default" => 0,
		),
		
		array(
			'id' => 'footer-floating-contact-form-recaptcha',
			'type' => 'switch',
			'title' => __('Enable reCaptcha', 'ivan_domain_redux'),
			'subtitle' => __('If on, reCaptcha will be activated.', 'ivan_domain_redux'),
			'description' => sprintf(__('Register your site here %s and get you site and secret key.', 'ivan_domain_redux'),'<a href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a>'),
			"default" => 0,
			'required' => array( 'footer-floating-contact-form', '=', 1 ),
		),
		
		array(
			'id' => 'footer-floating-contact-form-recaptcha-site-key',
			'type' => 'text',
			'title' => __('reCaptcha Site Key', 'ivan_domain_redux'),
			'subtitle' => __('Site key', 'ivan_domain_redux'),
			'default' => '',
			'required' => array( 'footer-floating-contact-form-recaptcha', '=', 1 ),
		),
		
		array(
			'id' => 'footer-floating-contact-form-recaptcha-secret-key',
			'type' => 'text',
			'title' => __('reCaptcha Secret Key', 'ivan_domain_redux'),
			'subtitle' => __('Secret key', 'ivan_domain_redux'),
			'default' => '',
			'required' => array( 'footer-floating-contact-form-recaptcha', '=', 1 ),
		),
		
		array(
			'id'=>'footer-floating-contact-form-recaptcha-theme',
			'type' => 'select',
			'title' => __('reCaptcha Theme', 'ivan_domain_redux'), 
			'subtitle' => __('Select the theme to be used for reCaptcha.', 'ivan_domain_redux'),
			'options' => apply_filters('ivan_footer_layouts', array( 
				'light' => 'Light',
				'dark' => 'Dark',
			) ),
			'default' => 'light',
			'validate' => 'not_empty',
			'required' => array( 'footer-floating-contact-form-recaptcha', '=', 1 ),
		),
		
		
		
		array(
			'id' => 'footer-floating-contact-form-email',
			'type' => 'text',
			'title' => __('Email', 'ivan_domain_redux'),
			'subtitle' => __('Destination email address', 'ivan_domain_redux'),
			'default' => '',
			'required' => array( 'footer-floating-contact-form', '=', 1 ),
		),
		
		array(
			'id' => 'footer-floating-contact-form-header',
			'type' => 'text',
			'title' => __('Form Header', 'ivan_domain_redux'),
			'subtitle' => __('Header of the form', 'ivan_domain_redux'),
			'default' => '',
			'required' => array( 'footer-floating-contact-form', '=', 1 ),
			'validate' => false,
		),
		
		array(
			'id' => 'footer-floating-contact-form-description',
			'type' => 'textarea',
			'title' => __('Form Description', 'ivan_domain_redux'),
			'subtitle' => __('Short text displayed below the form header', 'ivan_domain_redux'),
			'default' => '',
			'required' => array( 'footer-floating-contact-form', '=', 1 ),
			'validate' => false,
		),
		

	), // #fields
);