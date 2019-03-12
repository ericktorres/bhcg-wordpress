<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ivan_framework
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '-', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php get_template_part('part', 'loader'); ?>

<?php flush(); ?>

<?php if (ivan_get_option('header-layout') == 'Ivan_Layout_Header_Horizontal_With_Sidebar'): ?>
	<?php get_sidebar('side-header'); ?>
<?php endif; ?>
	
<div id="all-site-wrapper" class="hfeed site">

	<a href="#" id="back-top">
		<i class="fa fa-angle-up " style=""></i>
	</a>
	<?php if (ivan_get_option('footer-floating-contact-form')): ?>
		<div class="floated-contact-form">
			<a href="#" class="form-trigger"><i class="fa fa-envelope"></i></a>
			<div class="form-container">
				<h6><?php
				if (ivan_get_option('footer-floating-contact-form-header')):
					echo esc_html(ivan_get_option('footer-floating-contact-form-header'));
				else:
					_e('Contact Us', 'ivan_domain');
				endif;
				
				?></h6>
				<?php if (ivan_get_option('footer-floating-contact-form-description')): ?>
					<p><?php echo ivan_get_option('footer-floating-contact-form-description'); ?></p>
				<?php endif; ?>
				<form action="#" id="floating-contact-form">
					<?php wp_nonce_field( 'ff-form-ivan', 'ff-nonce' ); ?>
					<input type="text" name="ff-name" id="ff-name" placeholder="<?php esc_attr_e('Name', 'ivan_domain'); ?>">
					<input type="text" name="ff-email" id="ff-email" placeholder="<?php esc_attr_e('Email', 'ivan_domain'); ?>">
					<textarea name="ff-message" id="ff-message" rows="5" placeholder="<?php esc_attr_e('Message', 'ivan_domain'); ?>"></textarea>
					
					<?php if (ivan_get_option('footer-floating-contact-form-recaptcha') && ivan_get_option('footer-floating-contact-form-recaptcha-site-key')): ?>
						<div class="g-recaptcha" data-theme="<?php echo esc_attr(ivan_get_option('footer-floating-contact-form-recaptcha-theme')); ?>" data-sitekey="<?php echo esc_attr(ivan_get_option('footer-floating-contact-form-recaptcha-site-key')); ?>"></div>
					<?php endif; ?>
					<a id="ff-submit" href="#"><?php esc_attr_e('Send', 'ivan_domain'); ?></a>
					<div id="ff-notice"></div>
				</form>
			</div>
		</div>
	<?php endif; ?>
	<?php
	/* @todo: adds who is being hooked */
	do_action( 'ivan_before' ); 
	?>

		<?php 
		/* @todo: adds who is being hooked */
		do_action( 'ivan_header_section' ); 
		?>

		<?php 
		// Dynamic Area displayed here...
		if( true == ivan_get_option('header-da-after-enable') ) : ?>
		<div class="<?php echo apply_filters('iv_dynamic_header_classes', 'iv-layout dynamic-header dynamic-header-after'); ?>">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
					<?php
						$_id = ivan_get_option('header-da-after');
						ivan_display_dynamic_area( $_id, true );
					?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>