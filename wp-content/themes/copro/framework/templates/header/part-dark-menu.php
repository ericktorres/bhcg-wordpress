<?php
/**
 *
 * Template Part called at class Ivan_Layout_Dark_Menu
 *
 * @package   IvanFramework
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 * @version 1.0
 * @since 1.0
 */
?>

<?php

	// Variable used to display additional classes in the layout.
	$_classes = '';

	// Check if Fixed Header option is enabled and output the respective class.
	$_classes .= ivan_get_option_display( 'header-fixed-switch', ' header-fixed', '' );

	// Check if Lateral Lines in modules is enabled and output the respective class.
	$_classes .= ivan_get_option_display( 'header-lateral-lines-switch', ' lateral-lines', '' );

	// Check if Negative Height is enabled and output the respective class.
	$_classes .= ivan_get_option_display( 'header-negative-height', ' negative-height', '' );

	// If header has negative height
	if( true == ivan_get_option( 'header-negative-height' ) ) :

		// Display After Fold
		$_classes .= ivan_get_option_display( 'header-after-fold', ' show-after-fold display-after-fold', '' );

		// Used to keep showing the logo even before the page fold
		$_classes .= ivan_get_option_display( 'header-after-fold-logo', ' keep-logo-before-fold', '' );

		// Apply background type to header
		$_classes .= ' ' . ivan_get_option( 'header-bg-type' );

		// Apply color scheme to header
		$_classes .= ' ' . ivan_get_option( 'header-color-scheme' );

		// Apply boxed layout to header
		$_classes .= ivan_get_option_display( 'header-boxed-layout', ' simple-boxed-menu', '' );

	endif;

	// Locally Disabled Modules
	$disabled_items = ivan_get_post_option( 'header-local-disabled-modules' );
	if( $disabled_items == null )
		$disabled_items = array();

	$enabled_items = ivan_get_post_option( 'header-local-enabled-modules' );
	if( $enabled_items == null )
		$enabled_items = array();

	$_classes = esc_attr( $_classes ); // escape classes to attribute

?>

<div class="<?php echo apply_filters( 'iv_header_classes', 'iv-layout header style5 style2-right-menu classic-logo-centered '. $_classes ); ?>">
	<div class="mid-header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 header-left-area">
					<?php Ivan_Module_Logo::display(); ?>
				</div><!-- /col-md-3 -->
				<div class="col-md-8 col-md-offset-1 header-right-area">
					<div class="contact-info-container">
						<div class="row">
							<div class="contact-info col-md-4">
								<?php echo do_shortcode(ivan_get_option('header-text-area-1')); ?>
								
<!--								<span class="icon-container">
									<i class="fa fa-phone"></i>
								</span>
								<div class="contact-details">
									<h4>(+72) 987 654 123</h4>
									<p>Call Us everyday 24/7</p>
								</div>-->
							</div><!-- /contact-info -->
							<div class="contact-info col-md-4">
								<?php echo do_shortcode(ivan_get_option('header-text-area-2')); ?>
								
<!--								<span class="icon-container">
									<i class="fa fa-envelope-o"></i>
								</span>
								<div class="contact-details">
									<h4>info@builde.com</h4>
									<p>We will reply to all questions</p>
								</div>-->
							</div><!-- /contact-info -->
							<div class="contact-info col-md-4">
								<?php echo do_shortcode(ivan_get_option('header-text-area-3')); ?>
								
<!--								<span class="icon-container">
									<i class="fa fa-map-marker"></i>
								</span>
								<div class="contact-details">
									<h4>45 Park Avenue</h4>
									<p>Apt 1009, New York, NY 10016</p>
								</div>-->
							</div><!-- /contact-info -->
						</div><!-- /contact-info-container -->
					</div><!-- /row -->
					<?php
						// Check the responsive menu type to be used...
						if( true != ivan_get_option('header-select-menu-switch') ) :
							Ivan_Module_Responsive_Menu::display('.header .primary', 'header-menu-wrap');
						else:
							// Display responsive menu in a select
							Ivan_Module_Responsive_Menu_Select::display('.header .primary .menu');
						endif;
					?>
				</div><!-- /col-md-8 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /mid-header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="bottom-header menu-area-wrapper">
					<?php 
					$menu_args = array(
						'theme_location' => 'primary',
						'container' => 'nav',
						'container_class' => 'main-nav mega_main_menu nav_menu primary icons-right first-lvl-align-left first-lvl-separator-none direction-horizontal responsive-disable mobile_minimized-disable dropdowns_animation-anim_4 version-1-1-0 dark-submenu hidden-xs hidden-sm iv-module-menu menu-wrapper no-search',
						'menu_class' => ivan_get_option_display( 'header-v-sign-switch', ' with-arrow', '' ) . ' menu' . '',
						//'menu_holder' => 'centered'
						);

					Ivan_Module_Menu::display( $menu_args ); 
					?>
						
				</div><!-- /bottom-header -->
			</div><!-- /col-md-12 -->
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /header -->

<?php return; ?>

<!--<div class="<?php echo apply_filters( 'iv_header_classes', 'iv-layout header simple-right-menu apply-height '. $_classes ); ?>">
	<div class="container">
		<div class="row">

			<div class="<?php ivan_header_dimensions('logo', 2); ?> header-left-area">
				<?php Ivan_Module_Logo::display(); ?>
			</div>
			
			<div class="<?php ivan_header_dimensions('modules', 2); ?>  header-right-area">

				<?php
					if( ivan_get_option( 'header-woo-cart-switch' ) || in_array('woo_cart', $enabled_items) == true ) :
						if( in_array('woo_cart', $disabled_items) == false )
							Ivan_Module_Woo_Cart::display();
					endif;
				?>
				
				<?php
					if( ivan_get_option( 'header-woo-cart-total-switch' ) || in_array('woo_cart_total', $enabled_items) == true ) :
						if( in_array('woo_cart_total', $disabled_items) == false )
							Ivan_Module_Woo_Cart_Total::display();
					endif;
				?>
				
				<?php
				if( ivan_get_option( 'header-search-switch' ) || in_array('live_search', $enabled_items) == true ) :
					if( in_array('live_search', $disabled_items) == false ):	
						$style = Ivan_Module_Live_Search::get_style_class('header-search-style');
						Ivan_Module_Live_Search::display($style);
					endif;
				endif; ?>

				<?php
					if( ivan_get_option( 'header-login-ajax-switch' ) || in_array('login_ajax', $enabled_items) == true ) :
						if( in_array('login_ajax', $disabled_items) == false )	
							Ivan_Module_Login_Ajax::display();
					endif;
				?>

				<?php
				if( ivan_get_option( 'header-social-switch' ) || in_array('social_icons', $enabled_items) == true ) :
					if( in_array('social_icons', $disabled_items) == false )
						Ivan_Module_Social_Icons::display( 'header-social-icons', 'hidden-xs hidden-sm' ); // @todo: replace 'option_id' by the correct option ID
				endif;
				?>

				<?php
				if( ivan_get_option( 'header-text-switch' ) || in_array('text_module', $enabled_items) == true ) :
					if( in_array('text_module', $disabled_items) == false )	
						Ivan_Module_Custom_Text::display( 'header-text-content', 'hidden-xs hidden-sm' );
				endif;
				?>

				<?php
				if( true == ivan_get_option('header-menu-module-switch') || in_array('menu_module', $enabled_items) == true ) :

					if( in_array('menu_module', $disabled_items) == false ) {
						$menu_args = array(
							'theme_location' => 'primary_module',
							'container' => 'div',
							'container_class' => 'hidden-xs hidden-sm iv-module-menu menu-wrapper',
							'menu_class' => ivan_get_option_display( 'header-v-sign-switch', ' with-arrow', '' ) . ' menu',
							'menu_holder' => 'centered'
							);

						Ivan_Module_Menu::display( $menu_args );

						// Check the responsive menu type to be used...
						if( true != ivan_get_option('header-select-menu-switch') ) :
							Ivan_Module_Responsive_Menu::display('.header .primary_module', 'header-menu-module-wrap');
						else:
							// Display responsive menu in a select
							Ivan_Module_Responsive_Menu_Select::display('.header .primary_module .menu');
						endif;
					}

				endif;
				?>

				<?php
					// Check the responsive menu type to be used...
					if( true != ivan_get_option('header-select-menu-switch') ) :
						Ivan_Module_Responsive_Menu::display('.header .primary', 'header-menu-wrap');
					else:
						// Display responsive menu in a select
						Ivan_Module_Responsive_Menu_Select::display('.header .primary .menu');
					endif;
				?>

				<?php 
				$menu_args = array(
					'theme_location' => 'primary',
					'container' => 'div',
					'container_class' => 'hidden-xs hidden-sm iv-module-menu menu-wrapper' . ivan_get_option_display( 'header-menu-pull-left-switch', ' pull-left', '' ),
					'menu_class' => ivan_get_option_display( 'header-v-sign-switch', ' with-arrow', '' ) . ' menu' . '',
					'menu_holder' => 'centered'
					);

				Ivan_Module_Menu::display( $menu_args ); 
				?>
			</div>

		</div>					
	</div>
</div>-->