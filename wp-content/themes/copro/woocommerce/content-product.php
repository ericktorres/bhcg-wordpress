<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

$attachment_ids = $product->get_gallery_attachment_ids();

// Bootstrap Column
$bootstrapColumn = round( 12 / $woocommerce_loop['columns'] );
$classes[] = 'col-xs-12 col-sm-'. $bootstrapColumn .' col-md-' . $bootstrapColumn;

if(is_admin())
	$classes[] = 'product';

?>

<li <?php post_class( $classes ); ?>>
	<div class="col-wrapper">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="main-link">

		<div class="product-thumbnail">

			<div class="frontal-image">
				<?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?>
			</div>

			<?php
			// Display Back Image of Product
			if( $attachment_ids && false == ivan_get_option('woo-disable-front-back') ) :

				$counter = 0;				
				
				// Loop in attachment	
				foreach ( $attachment_ids as $attachment_id ) {
					
					// Get attachment image URL
					$image_link = wp_get_attachment_url( $attachment_id );
					
					// If isn't a URL we go to next attachment
					if ( !$image_link )
						continue;
								
					$counter++;

					?>
						<div class="back-image"><?php echo wp_get_attachment_image( $attachment_id, 'shop_catalog' ); ?></div>
					<?php	
					
					// If we found any image, we stop the loop
					if ($counter == 1) 
						break;	
				}

			endif; ?>
			
			<?php if(false == ivan_get_option('woo-disable-quick-view') && false == ivan_get_option('woo-catalog-mode') ) : ?>
				<div class="quick-view" data-product-id="<?php echo esc_attr( $post->ID ); ?>"><?php _e( 'Quick View', 'ivan_domain'); ?></div>
			<?php endif; ?>
		
		</div><!--.product-thumbnail-->

		<div class="product-info">

			<h3><?php the_title(); ?></h3>

			<?php
				// Product Category
				$prod_cats = get_the_terms( $product->ID, 'product_cat' );
				$counter = 0;

				if( is_array( $prod_cats ) ) {
					foreach ($prod_cats as $single_cat) {
						if( $counter == 0 ) {
							echo '<div class="product-single-cat">' . $single_cat->name . '</div>';

							$counter++;
						} else {
							break;
						}
					}
					
				}
			?>

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

			<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>

			<?php
			// Adds Wishlist Button
			if( class_exists( 'YITH_WCWL' ) ) : ?>
				<?php echo '<div class="yith-wrapper">' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>'; ?>
			<?php endif; ?>

		</div><!--.product-info-->

	</a>

	<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>

	</div><!--.col-wrapper-->
</li>
