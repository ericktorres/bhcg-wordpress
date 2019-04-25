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
		$course_detail_id = $_POST['hdn_headquarter_id'];
		$course_name = $_POST['txt_course_name'];
		$price = $_POST['txt_course_cost'];
		$iva = $_POST['txt_iva'];
		$price_in_cents = (($price + $iva) * 100);
		$total_price = ($price + $iva);
		$client_complete_name = $_POST['txt_name'] .' '. $_POST['txt_lastname'];
		$client_name = $_POST['txt_name'];
		$client_lastname = $_POST['txt_lastname'];
		$email = $_POST['txt_email'];
		$phone_number = $_POST['txt_mobile_phone'];
		$course_code = $_POST['txt_course_code'];
		$token_id = $_POST['conektaTokenId'];
		$course_location = $_POST['hdn_location'];
		$course_start_time = $_POST['hdn_start_time'];
		$course_start_date = $_POST['hdn_start_date'];
		$instructor_name = $_POST['hdn_instrutor_name'];
		$rfc = $_POST['txt_rfc'];
		$business_name = $_POST['txt_business_name'];
		$payment_type = $_POST['hdn_payment_type'];
		$places = $_POST['hdn_num_places'];
		$cardholder_name = $_POST['txt_cardholder_name'];
		$cardholder_email = $_POST['txt_cardholder_email'];
		$cardholder_phone = $_POST['txt_cardholder_phone'];
		$participant_name = $_POST['txt_name'];
		$participant_lastname = $_POST['txt_lastname'];
		$participant_email = $_POST['txt_email'];
		$participant_telephone = $_POST['txt_mobile_phone'];
		
		\Conekta\Conekta::setApiKey("key_84G14CLBJtwftNqQfsxxpw");
		\Conekta\Conekta::setApiVersion("2.0.0");
        
        if($payment_type == "card"){
        	$order_params = array(
      				"line_items" => array(
        				array(
          					"name" => $course_name,
          					"unit_price" => $price_in_cents,
          					"quantity" => $places
        				)//first line_item
      				), //line_items
      				"currency" => "MXN",
      				"customer_info" => array(
        				"name" => $cardholder_name,
        				"email" => $cardholder_email,
        				"phone" => $cardholder_phone
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
    		);//order

			try{
	  			$order = \Conekta\Order::create($order_params);
			}catch(\Conekta\ProcessingError $error){
	  			//echo $error->getMessage();
	  			$error_message = $error->getMessage();
			}catch(\Conekta\ParameterValidationError $error){
	  			//echo $error->getMessage();
	  			$error_message = $error->getMessage();
			}catch(\Conekta\Handler $error){
	  			//echo $error->getMessage();
	  			$error_message = $error->getMessage();
			}

        }else if($payment_type == "spei"){
        	// Set cardholder data to the first participant
			$cardholder_name = $participant_name[0] . ' ' . $participant_lastname[0];
			$cardholder_email = $participant_email[0];
			$cardholder_phone = $participant_telephone[0];

        	$order_params = array(
      				"line_items" => array(
        				array(
          					"name" => $course_name,
          					"unit_price" => $price_in_cents,
          					"quantity" => $places
        				)//first line_item
      				), //line_items
      				"currency" => "MXN",
      				"customer_info" => array(
        				"name" => $cardholder_name,
        				"email" => $cardholder_email,
        				"phone" => $cardholder_phone
      				), //customer_info
      				"metadata" => array("reference" => $course_code, "more_info" => "Pago de curso en línea"),
      				"charges" => array(
          				array(
              				"payment_method" => array(
                  				//"monthly_installments" => 3,
                  				"type" => "spei",
                  			) //payment_method - use customer's default - a card
                			//to charge a card, different from the default,
                			//you can indicate the card's source_id as shown in the Retry Card Section
          				) //first charge
      				) //charges
    		);//order
			
			try{
				$order = \Conekta\Order::create($order_params);
			}catch (\Conekta\ParameterValidationError $error){
	  			//echo $error->getMessage();
	  			$error_message = $error->getMessage();
			} catch (\Conekta\Handler $error){
	  			//echo $error->getMessage();
	  			$error_message = $error->getMessage();
			}
        }
    ?>
	<div class="container">
		<div id="payment_status" style="border: 2px dotted black; width: 70%; margin: auto; margin-bottom: 50px; padding: 30px; text-align: center;">
			
				<?php if($payment_type == "card"){ ?>
					<?php if($order->payment_status == 'paid'){ ?>
						<h1>¡Felicidades!</h1>
						<p>
							Has asegurado tu lugar en el curso: <b><?= $_POST['txt_course_name'] ?> </b><br>
							Tu clave de confirmación es <b><?= $order->id ?> </b><br>
							Guarda tu clave de confirmación y espera los detalles del curso en tu correo electrónico.
						</p>
						<?php
							$email_params = array(
								"to" => $cardholder_email,
								"course_name" => $course_name,
								"payment_confirmation" => $order->id,
								"course_location" => $course_location,
								"course_date" => $course_start_date,
								"course_start_time" => $course_start_time,
								"purchase_date" => date('Y-m-d H:i:s', $order->created_at),								
								"instructor" => $instructor_name,
								"participant_name" => $participant_name,
								"participant_lastname" => $participant_lastname,
								"participant_email" => $participant_email,
								"participant_telephone" => $participant_telephone,
								"places" => $places
							);
							$email_data_json = json_encode($email_params);

							// Sending the email notification
							$curl_send_mail = curl_init('https://cms.bluehand.com.mx/api/v1/emails/send-purchase-notification');
							curl_setopt($curl_send_mail, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
							curl_setopt($curl_send_mail, CURLOPT_POSTFIELDS, $email_data_json);
							curl_setopt($curl_send_mail, CURLOPT_RETURNTRANSFER, true);                                                                      
							curl_setopt($curl_send_mail, CURLOPT_HTTPHEADER, array(                                                                          
	    						'Content-Type: application/json',                                                                                
	    						'Content-Length: ' . strlen($email_data_json)) 
							);
	                                                                                                                     
							$result = curl_exec($curl_send_mail);
						?>

					<?php } else { ?>
				<h1>Lo sentimos :(</h1>
				<p><?php echo $error_message; ?></p>
					<?php } ?>
				<?php } else if($payment_type == "spei"){ ?>
				<h1>¡Felicidades!</h1>
				<p>
					Estás a un paso de asegurar tu lugar en el curso: <?= $_POST['txt_course_name'] ?><br>
					Realiza el pago vía SPEI con los siguiente datos:<br>
					<?php

					echo "<b>Número de orden:</b> ". $order->id . "<br>";
					echo "<b>Banco: </b>". $order->charges[0]->payment_method->bank . "<br>";
					echo "<b>CLABE: </b>". $order->charges[0]->payment_method->clabe . "<br>";
					echo "<b>$". $total_price . " MXN I.V.A. incluido.</b><br>";
					//echo "Orden ";

					/*echo 'clabe: '. $order->charges[0]->payment_method->clabe . "\r\n";
					echo 'bank: '. $order->charges[0]->payment_method->bank . "\r\n";
					echo 'Account Number: '. $order->charges[0]->payment_method->receiving_account_number . "\r\n";
					echo 'Account Banck: '. $order->charges[0]->payment_method->receiving_account_bank . "\r\n";*/

					/*echo $order->line_items->data[0]->quantity .
					      "-". $order->line_items->data[0]->name .
					      "- $". $order->line_items->data->unit_price/100 . "<br>";*/
					//echo date('Y-m-d H:i:s') . " - " . $order->created_at . "<br>";
					?>
					Una vez hecho el pago recibirás toda la información del curso en tu correo electrónico.
				</p>
					<?php
						$email_params = array(
							"to" => $cardholder_email,
							"course_name" => $course_name,
							"payment_confirmation" => $order->id,
							"bank" => $order->charges[0]->payment_method->bank,
							"clabe" => $order->charges[0]->payment_method->clabe,
							"amount" => $total_price,
							"participant_name" => $participant_name,
							"participant_lastname" => $participant_lastname,
							"participant_email" => $participant_email,
							"participant_telephone" => $participant_telephone,
							"places" => $places
						);
						$email_data_json = json_encode($email_params);

						// Sending the email notification
						$curl_send_mail = curl_init('https://cms.bluehand.com.mx/api/v1/emails/send-spei-notification');
						curl_setopt($curl_send_mail, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
						curl_setopt($curl_send_mail, CURLOPT_POSTFIELDS, $email_data_json);
						curl_setopt($curl_send_mail, CURLOPT_RETURNTRANSFER, true);                                                                      
						curl_setopt($curl_send_mail, CURLOPT_HTTPHEADER, array(                                                                          
    						'Content-Type: application/json',                                                                                
    						'Content-Length: ' . strlen($email_data_json)) 
						);
                                                                                                                     
						$result = curl_exec($curl_send_mail);
					?>

				<?php } ?>

				<?php 
					$params = array(
						"course_detail_id" => $course_detail_id,
						"name" => $cardholder_name,
						"email" => $cardholder_email,
						"telephone" => $cardholder_phone,
						"places" => $places,
						"amount" => $price,
						"iva" => $iva,
						"total_amount" => $total_price,
						"payment_type" => strtoupper($payment_type),
						"payment_confirmation" => $order->id,
						"rfc" => strtoupper($rfc),
						"business_name" => $business_name,
						"payment_status" => strtoupper($order->payment_status),
						"payment_date" => date('Y-m-d H:i:s', $order->created_at),
						"participant_name" => $participant_name,
						"participant_lastname" => $participant_lastname,
						"participant_email" => $participant_email,
						"participant_telephone" => $participant_telephone
					);
					$data_json = json_encode($params);

					// Calling the service that register the order in our system
					$ch = curl_init('https://cms.bluehand.com.mx/api/v1/payment/post');
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    					'Content-Type: application/json',                                                                                
    					'Content-Length: ' . strlen($data_json)) 
					);                                                                                                                                                                                           
					$result = curl_exec($ch);

				?>
			
		</div>
	</div>
	

<?php get_footer(); ?>