<?php
/*
    Template Name: Checkout
*/
wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/css/bootstrap-for-courses.css');
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.7.0/css/all.css');
get_header(); 

?>

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

	<!-- Here start the checkout components -->
	<?php
		if($_GET['adc']){
			$ad_code = $_GET['adc'];
			$request = wp_remote_get('https://cms.bluehand.com.mx/api/v1/get-headquarter/'.$ad_code);
			$body = wp_remote_retrieve_body($request);
			$course = json_decode($body);

			// Data variables
			$headquarter_id = $course->{'headquarter_id'};
			$course_code = $course->{'code'};
			$course_name = $course->{'course_name'};
			$location = $course->{'location'};
			$city = $course->{'city'};
			$state = $course->{'state'};
			$start_date = date('d/m/Y', strtotime($course->{'start_date'}));
			$start_time = date('H:i', strtotime($course->{'complete_start_date'}));
			$capacity = $course->{'capacity'};
			$inscription_limit_date = date('d/m/Y', strtotime($course->{'complete_start_date'} . '- ' . $course->{'registration_deadline'} . ' days'));
			$cost_formatted = money_format('%i', $course->{'cost'});
			$cost = $course->{'cost'};
			$iva = (($cost * 16) / 100);
			$total_cost = ($cost + $iva);
			$instructor = $course->{'instructor_name'}.' '.$course->{'instructor_lastname'};
			$instructor_photo = $course->{'instructor_photo'};
			$instructor_resume = $course->{'instructor_resume'};
			$temary = $course->{'temary_file'};
		}else{
			// We get this variables from the courses page via POST
			$headquarter_id = $_POST['hdn_headquarter_id'];
			$course_code = $_POST['hdn_course_code'];
			$course_name = $_POST['hdn_course_name'];
			$location = $_POST['hdn_location'];
			$city = $_POST['hdn_city'];
			$state = $_POST['hdn_state'];
			$start_date = $_POST['hdn_start_date'];
			$start_time = $_POST['hdn_start_time'];
			$capacity = $_POST['hdn_capacity'];
			$inscription_limit_date = $_POST['hdn_registration_limit'];
			$cost_formatted = $_POST['hdn_cost_formatted'];
			$cost = $_POST['hdn_cost'];
			$iva = (($cost * 16) / 100);
			$total_cost = ($cost + $iva);
			$instructor = $_POST['hdn_instrutor_name'];
			$instructor_photo = $_POST['hdn_instructor_photo'];
			$instructor_resume = $_POST['hdn_instructor_resume'];
			$temary = $_POST['hdn_temary'];
		}
	?>
	<div class="container" id="main_container_checkout">

		<div class="card" style="margin-bottom:15px;">
      		<div class="card-header">
        		<h4 class="my-0 font-weight-normal"><?php echo $course_name; ?></h4>
      		</div>
      		<div class="card-body" style="text-align:center;">
      			<div class="row" style="padding:5px;">
      				<div class="col">
      					<span><?php echo $location . ', ' . $city . ', ' . $state; ?></span><br>
      					<span>Inicio: <?php echo $start_date; ?> a las <?php echo $start_time; ?> Hrs.</span><br>
      					<span>Capacidad total: <?php echo $capacity; ?> personas</span><br>
      					<span>Lugares disponibles: </span><br>
      					<span>Cierre de inscripción: <?php echo $inscription_limit_date; ?></span><br><br>
      					<h1 class="card-title pricing-card-title"><?php echo $cost_formatted; ?><br>+ IVA</h1>
      				</div>
      				<div class="col" style="border-left:1px dotted gray;">
      					<div class="row" style="border-bottom:1px dotted gray;">
      						<div class="col">
      							<p>Instructor:</p>
      							<img width="50" src="https://cms.bluehand.com.mx/files/photos/instructors/<?php echo $instructor_photo; ?>">
      							<p><?php echo $instructor; ?></p>
      						</div>
      						<div class="col">
      							<p>CV</p>
      							<a href="https://cms.bluehand.com.mx/files/resumes/<?php echo $instructor_resume; ?>" target="_blank"><i class="fas fa-file-pdf fa-3x"></i></a>
      						</div>
      					</div>
      					<div class="row">
      						<div class="col">	
      							<p>Temario del curso</p>
      							<a href="https://cms.bluehand.com.mx/files/agendas/<?php echo $temary; ?>" target="_blank"><i class="fas fa-file-alt fa-3x"></i></a>
      						</div>
      					</div>
      				</div>
      			</div>
      		</div>
    	</div><!-- end course main info -->
    					
		<form action="/confirmacion-de-pago" method="POST" id="card-form">
			<span class="card-errors"></span>
			<fieldset>
				<legend><b>Datos del participante</b></legend>
			<div class="form-group">
				<label for="txt_name">Nombre:</label>
    			<input type="text" class="form-control" id="txt_name" name="txt_name" aria-describedby="name_help" placeholder="Nombre" style="height:38px;" required>
    			<small id="name_help" class="form-text" style="display:none; color: red;">El nombre del participante es un campo obligatorio.</small>
			</div>
			<div class="form-group">
				<label for="txt_lastname">Apellidos:</label>
    			<input type="text" class="form-control" id="txt_lastname" name="txt_lastname" aria-describedby="lastname_help" placeholder="Apellidos" style="height:38px;" required>
    			<small id="lastname_help" class="form-text" style="display:none; color: red;">Los apellidos del participante son un campo obligatorio.</small>
			</div>
			<div class="row">
				<div class="col">
					<label for="txt_email">Correo electrónico:</label>
    				<input type="email" class="form-control" id="txt_email" name="txt_email" aria-describedby="email_help" placeholder="Correo electrónico" style="height:38px;" required>
    				<small id="email_help" class="form-text" style="display:none; color: red;">El campo correo electrónico es obligatorio.</small>
    			</div>
    			<div class="col">
					<label for="txt_email">Confirmar correo:</label>
    				<input type="email" class="form-control" id="txt_confirm_email" name="txt_confirm_email" aria-describedby="email2_help" placeholder="Correo electrónico" style="height:38px;" required>
    				<small id="email2_help" class="form-text" style="display:none; color: red;">El campo correo electrónico es obligatorio.</small>
    			</div>
			</div>
			<div class="row">
				<div class="col">
					<label for="txt_phone">Teléfono:</label>
    				<input type="number" class="form-control" id="txt_phone" name="txt_phone" placeholder="Teléfono" style="height:38px;" size="10">
    			</div>
    			<div class="col">
					<label for="txt_mobile_phone">Teléfono móvil:</label>
    				<input type="number" class="form-control" id="txt_mobile_phone" name="txt_mobile_phone" aria-describedby="mobile_help" placeholder="Teléfono móvil" style="height:38px;" size="10" required>
    				<small id="mobile_help" class="form-text" style="display:none; color: red;">El campo teléfono móvil es obligatorio.</small>
    			</div>
			</div>
			</fieldset>
			<br>
			<fieldset>
				<legend><b>Datos del curso</b></legend>
				<div class="form-group">
					<label for="txt_course_name">Nombre del curso:</label>
	    			<input type="text" class="form-control" id="txt_course_name" name="txt_course_name" placeholder="Curso" value="<? echo $course_name; ?>" style="height:38px;" readonly>
	    			<input type="hidden" name="hdn_headquarter_id" id="hdn_headquarter_id" value="<?php echo $headquarter_id; ?>">
				</div>
				<div class="form-group">
					<label for="txt_course_code">Código:</label>
	    			<input type="text" class="form-control" id="txt_course_code" name="txt_course_code" placeholder="Código" value="<? echo $course_code; ?>" style="height:38px;" readonly>
				</div>
				<div class="form-group">
					<label for="txt_course_cost">Costo:</label>
	    			<input type="text" class="form-control" id="txt_course_cost" name="txt_course_cost" placeholder="Costo" value="<? echo $cost; ?>" style="height:38px;" readonly>
	    			<input type="hidden" id="hdn_location" name="hdn_location" value="<?php echo $location . ', ' . $city . ', ' . $state; ?>">
	    			<input type="hidden" id="hdn_start_time" name="hdn_start_time" value="<? echo $start_time; ?>">
	    			<input type="hidden" id="hdn_start_date" name="hdn_start_date" value="<? echo $start_date; ?>">
	    			<input type="hidden" id="hdn_instrutor_name" name="hdn_instrutor_name" value="<?php echo $instructor; ?>">
				</div>
				<div class="form-group">
					<label for="txt_iva">IVA:</label>
	    			<input type="text" class="form-control" id="txt_iva" name="txt_iva" placeholder="IVA" value="<? echo $iva; ?>" style="height:38px;" readonly>
				</div>
				<div class="form-group">
					<label for="txt_total_cost">Costo total:</label>
	    			<input type="text" class="form-control" id="txt_total_cost" name="txt_total_cost" placeholder="Costo total" value="<? echo $total_cost; ?>" style="height:38px;" readonly>
				</div>
			</fieldset>
			<fieldset>
				<legend><b>Seleccione método de pago</b></legend>
				<div style="text-align: center;">
					<div class="form-check form-check-inline">
	  					<input class="form-check-input" type="radio" name="rdo_payment_method" id="rdo_card_payment" value="card" onclick="selectPaymentType('card');">
	  					<label class="form-check-label" for="rdo_card_payment">Tarjeta de crédito/Débito</label>
					</div>
					<div class="form-check form-check-inline">
	  					<input class="form-check-input" type="radio" name="rdo_payment_method" id="rdo_spei_payment" value="spei" onclick="selectPaymentType('spei');">
	  					<label class="form-check-label" for="rdo_spei_payment">SPEI</label>
					</div>
					<div id="payment_method_image"></div>
					<div>
						<p>Todos los pagos realizados en BH Consulting Group son realizados mediante la plataforma de Conekta</p>
						<img src="https://bluehand.com.mx/console/img/conekta-logo.svg" width="270">
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><b>Información de pago</b></legend>
				<div id="payment_type_container"></div>
				<input type="hidden" id="hdn_payment_type" name="hdn_payment_type">
			</fieldset>
			<fieldset>
				<legend><b>Información de facturación</b></legend>
				<p>Si requiere factura favor de llenar los siguientes campos:</p>
				<div class="form-row">
    				<div class="form-group col-md-4">
      					<label for="txt_rfc">RFC</label>
      					<input type="text" class="form-control" id="txt_rfc" name="txt_rfc" style="height:38px;">
    				</div>
    				<div class="form-group col-md-8">
      					<label for="txt_business_name">Razón Social</label>
      					<input type="text" class="form-control" id="txt_business_name" name="txt_business_name" style="height:38px;">
    				</div>
    			</div>
			</fieldset>
			<div class="form-check">
  					<input class="form-check-input" type="checkbox" value="" id="chk_terms_conditions" required>
  					<label class="form-check-label" for="chk_terms_conditions">
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Al dar click en esta casilla acepto los <a href="https://www.bh-cg.com.mx/politica-terminos-de-servicio/" target="_blank">Términos de servicio</a>, la <a href="https://www.bh-cg.com.mx/politica-reembolso-y-cambios/" target="_blank">Política de reembolsos y/o cambios.</a> y el <a href="https://www.bh-cg.com.mx/aviso-de-privacidad/" target="_blank">Aviso de Privacidad.</a>
  					</label>
			</div>
			<br>
			<button type="submit">Realizar Pago</button>
		</form>

		<div class="container" style="text-align: center;">
		</div>
		<script>
			

  			// Conekta script

  			var conektaSuccessResponseHandler = function(token) {
  				console.log('Token success');
  				console.log('Token: ' + token);

    			var $form = $("#card-form");
    			//Inserta el token_id en la forma para que se envíe al servidor
     			$form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
    			$form.get(0).submit(); //Hace submit
  			};

  			var conektaErrorResponseHandler = function(response) {
  				console.log('Error token');

    			var $form = $("#card-form");
    			$form.find(".card-errors").text(response.message_to_purchaser);
    			$form.find("button").prop("disabled", false);
  			};

  			//jQuery para que genere el token después de dar click en submit
  			
  				$(function () {
	    			$("#card-form").submit(function(event) {
	    				if($('#hdn_payment_type').val() == 'card'){
		      				console.log('Submit ok');

		      				var $form = $(this);
		      				// Previene hacer submit más de una vez
		      				$form.find("button").prop("disabled", true);
		      				Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
		      				return false;
		      			}
	    			});
	  			});
  			

  			var selectPaymentType = function(payment_type){
  				var container = $('#payment_type_container');
  				var main_form = $('#card-form');
  				var payment_type_image_container = $('#payment_method_image');
  				
  				if(payment_type == "card"){
  					var card_form = '<div class="form-group"><label for="txt_cardholder_name">Nombre del tarjetahabiente:</label> <input type="text" class="form-control" id="txt_cardholder_name" name="txt_cardholder_name" aria-describedby="cardholder_name" placeholder="Nombre de tarjetahabiente" style="height:38px;" data-conekta="card[name]" size="20" required> <small id="name_help" class="form-text" style="display:none; color: red;">El nombre del tarjetahabiente es un campo obligatorio.</small></div><div class="form-group"><label for="txt_card_number">Número de tarjeta de crédito:</label> <input type="text" class="form-control" id="txt_card_number" name="txt_card_number" aria-describedby="cardholder_name" placeholder="Número de tarjeta" style="height:38px;" data-conekta="card[number]" size="20" required> <small id="name_help" class="form-text" style="display:none; color: red;">El número de la tarjeta es un campo obligatorio.</small></div><div class="form-row"> <div class="form-group col-md-4 mb-3"> <label for="txt_cvc">CVC:</label> <input type="text" class="form-control" id="txt_cvc" name="txt_cvc" style="height:38px;" placeholder="CVC" size="4" data-conekta="card[cvc]" required> </div><div class="form-group col-md-4 mb-3"> <label for="txt_expiration_month">Mes de expiración (MM):</label> <input type="text" class="form-control" id="txt_expiration_month" name="txt_expiration_month" style="height:38px;" placeholder="Mes de expiración" size="2" data-conekta="card[exp_month]" required> </div><div class="form-group col-md-4 mb-3"> <label for="txt_expiration_year">Año de expiración (AAAA):</label> <input type="text" class="form-control" id="txt_expiration_year" name="txt_expiration_year" style="height:38px;" placeholder="Año de expiración" size="4" data-conekta="card[exp_year]" required> </div></div>';
  					container.html(card_form);
  					payment_type_image_container.html('<p>Se aceptan pagos con tarjetas Visa, Mastercard y American Express.</p><img src="https://bluehand.com.mx/console/img/payments-cards.png" width="270">');

  				}else if(payment_type = "spei"){
  					var spei_legend = '<h4>Los datos para pago vía SPEI serán generados al momento de confirmar la compra.</h4>';
  					container.html(spei_legend);
  					payment_type_image_container.html('<img src="https://bluehand.com.mx/console/img/spei-logo.png" width="270">');
  				}

  				$('#hdn_payment_type').val(payment_type);
  			}

  			$(document).ready(function(){
  				$( "#txt_name" ).focus();

  				Conekta.setPublicKey('key_bKFak7iY6oHRtDGBkmacraQ');
			});
		</script>
	</div>
	

<?php get_footer(); ?>