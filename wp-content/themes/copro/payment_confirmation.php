<?php
/*
    Template Name: Payment Confirmation
*/
wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/css/bootstrap-for-courses.css');
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.7.0/css/all.css');
get_header(); ?>

	<?php

	$_classes = '';

	// Title Logic
	if( ( false == ivan_get_option('title-wrapper-enable-switch') && false == ivan_get_option('page-boxed-page') )
		OR ( true == ivan_get_option('header-negative-height') && false == ivan_get_option('title-wrapper-enable-switch') ) ) :
		do_action( 'ivan_title_wrapper' );
	else :

		if( ( false == ivan_get_option('header-negative-height') && true == ivan_get_option('title-wrapper-enable-switch') )
			OR true == ivan_get_option('page-boxed-page') )
			echo apply_filters('ivan_blog_divider', '<div class="title-wrapper-divider blog-version"></div>');

		if( true == ivan_get_option('title-wrapper-enable-switch') && false == ivan_get_option('page-boxed-page') )
			$_classes .= ' no-title-wrapper';
	endif;
	?>

	<div class="<?php echo apply_filters( 'iv_content_wrapper_classes', 'iv-layout content-wrapper content-full ' ); ?><?php echo esc_attr($_classes); ?>">
		<div class="container">

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('page-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
			<div class="boxed-page-wrapper">

				<?php
				// Adds Title
				if( false == ivan_get_option('title-wrapper-enable-switch') && true == ivan_get_option('page-boxed-page')
					&& false == ivan_get_option('header-negative-height') ) :
					do_action( 'ivan_title_wrapper' );
				endif; ?>

				<div class="boxed-page-inner">
			<?php endif; ?>

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 site-main" role="main">

						<?php get_template_part( 'page-templates/page', 'loop' ); ?>
						
					</div>

				</div>

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('page-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
				</div><!-- .boxed-page-inner -->
			</div><!-- .boxed-page-wrapper -->
			<?php endif; ?>

		</div>
	</div>

	<!-- Here start the payment confirmation page -->
	<?php
		//Variables
		$course_name = $_POST['txt_course_name'];
		$price = ($_POST['txt_course_cost'] * 100);
		$client_name = $_POST['txt_name'] .' '. $_POST['txt_lastname'];
		$email = $_POST['txt_confirm_email'];
		$phone_number = $_POST['txt_mobile_phone'];
		$course_code = $_POST['txt_course_code'];
		$token_id = $_POST['conektaTokenId'];
		//require_once("lib/Conekta.php");
		\Conekta\Conekta::setApiKey("key_tSD9hmj2QAnLj5X7JxqGNg");
		\Conekta\Conekta::setApiVersion("2.0.0");
        
        try{
  			$order = \Conekta\Order::create(
    			array(
      				"line_items" => array(
        				array(
          					"name" => $course_name,
          					"unit_price" => $price,
          					"quantity" => 1
        				)//first line_item
      				), //line_items
      				"currency" => "MXN",
      				"customer_info" => array(
        				"name" => $client_name,
        				"email" => $email,
        				"phone" => $phone_number
      				), //customer_info
      				"metadata" => array("reference" => $course_code, "more_info" => "Pago de curso en línea"),
      				"charges" => array(
          				array(
              				"payment_method" => array(
                  				//"monthly_installments" => 3,
                  				"type" => "card",
                  				"token_id" => $token_id
                  			) //payment_method - use customer's default - a card
                			//to charge a card, different from the default,
                			//you can indicate the card's source_id as shown in the Retry Card Section
          				) //first charge
      				) //charges
    			)//order
  			);
		}catch(\Conekta\ProcessingError $error){
  			echo $error->getMessage();
		}catch(\Conekta\ParameterValidationError $error){
  			echo $error->getMessage();
		}catch(\Conekta\Handler $error){
  			echo $error->getMessage();
		}
    ?>
	<div class="container">
		<div id="payment_status">
			<?php if($order->payment_status == 'paid'){ ?>
				<h1>Felicidades</h1>
			<?php } ?>
		</div>
	</div>
	

<?php get_footer(); ?>