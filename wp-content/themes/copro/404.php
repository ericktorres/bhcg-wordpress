<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ivan_framework
 */

global $wp_query, $post;

//override 404 page with page
//$page_id = ivan_get_option('404-page');
//if (!empty($page_id)) {
//
//	$args = array(
//		'page_id' => $page_id
//	);
//	query_posts( $args );
//	the_post();
//	
//	if (is_page()) {
//		
//		global $iv_aries;
//		global $iv_local_opts;
//		$iv_local_opts = $iv_aries;
//		
//		echo '<pre>';
//		print_r($iv_local_opts);
//		echo '</pre>';
//		
//		rewind_posts();
//		get_template_part('page');
//		die();
//	}
//}

get_header(); ?>

	<?php

	// Removes title wrapper if negative header is enabled
	if( true != ivan_get_option( 'header-negative-height' ) ) :
		echo '<div class="title-wrapper-divider"></div>';
	endif;

	/* @todo: adds who is being hooked */
	do_action( 'ivan_content_before' ); 
	?>

	<div class="<?php echo apply_filters( 'iv_content_wrapper_classes', 'iv-layout content-wrapper not-found ' ); ?>">
		<div class="container">
			<div class="row">

				<div class="col-md-12">

					<h2 class="not-found-number"><?php _e('404', 'ivan_domain'); ?></h2>
					<h4 class="not-found-text"><?php _e( 'Ooops! That Page Can\'t Be Found', 'ivan_domain' ); ?></h4>
					<div class="not-found-small-text"><?php _e( 'It looks like nothing was found at this location. Try use the search.', 'ivan_domain' ); ?></div>

				</div>

			</div>	
		</div>
	</div>

	<?php
	/* @todo: adds who is being hooked */
	do_action( 'ivan_content_after' ); 
	?>

<?php get_footer(); ?>