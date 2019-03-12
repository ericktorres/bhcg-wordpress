<?php
/*
    Template Name: Checkout
*/

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
	<div class="container" id="main_container_checkout">
		<form action="/confirmacion-de-pago" method="POST" id="card-form">
			<span class="card-errors"></span>
			<fieldset>
				<legend><b>Datos del participante</b></legend>
			<div class="form-group">
				<label for="txt_name">Nombre:</label>
    			<input type="text" class="form-control" id="txt_name" name="txt_name" aria-describedby="name_help" placeholder="Nombre" style="height:38px;" onblur="validateInputs('name');">
    			<small id="name_help" class="form-text" style="display:none; color: red;">El nombre del participante es un campo obligatorio.</small>
			</div>
			<div class="form-group">
				<label for="txt_lastname">Apellidos:</label>
    			<input type="text" class="form-control" id="txt_lastname" name="txt_lastname" aria-describedby="lastname_help" placeholder="Apellidos" style="height:38px;" onblur="validateInputs('lastname');">
    			<small id="lastname_help" class="form-text" style="display:none; color: red;">Los apellidos del participante son un campo obligatorio.</small>
			</div>
			<div class="row">
				<div class="col">
					<label for="txt_email">Correo electrónico:</label>
    				<input type="email" class="form-control" id="txt_email" name="txt_email" aria-describedby="email_help" placeholder="Correo electrónico" style="height:38px;" onblur="validateInputs('email');">
    				<small id="email_help" class="form-text" style="display:none; color: red;">El campo correo electrónico es obligatorio.</small>
    			</div>
    			<div class="col">
					<label for="txt_email">Confirmar correo:</label>
    				<input type="email" class="form-control" id="txt_confirm_email" name="txt_confirm_email" aria-describedby="email2_help" placeholder="Correo electrónico" style="height:38px;" onblur="validateInputs('email2');">
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
    				<input type="number" class="form-control" id="txt_mobile_phone" name="txt_mobile_phone" aria-describedby="mobile_help" placeholder="Teléfono móvil" style="height:38px;" size="10" onblur="validateInputs('phone');">
    				<small id="mobile_help" class="form-text" style="display:none; color: red;">El campo teléfono móvil es obligatorio.</small>
    			</div>
			</div>
			</fieldset>
			<br>
			<fieldset>
				<legend><b>Datos del curso</b></legend>
				<div class="form-group">
					<label for="txt_course_name">Nombre del curso:</label>
	    			<input type="text" class="form-control" id="txt_course_name" name="txt_course_name" placeholder="Curso" value="<? echo $_POST['hdn_course_name']; ?>" style="height:38px;" readonly>
				</div>
				<div class="form-group">
					<label for="txt_course_code">Código:</label>
	    			<input type="text" class="form-control" id="txt_course_code" name="txt_course_code" placeholder="Código" value="<? echo $_POST['hdn_course_code']; ?>" style="height:38px;" readonly>
				</div>
				<div class="form-group">
					<label for="txt_course_cost">Costo:</label>
	    			<input type="text" class="form-control" id="txt_course_cost" name="txt_course_cost" placeholder="Costo" value="<? echo $_POST['hdn_cost']; ?>" style="height:38px;" readonly>
	    			<input type="hidden" id="hdn_location" name="hdn_location" value="<? echo $_POST['hdn_location']; ?>">
	    			<input type="hidden" id="hdn_start_time" name="hdn_start_time" value="<? echo $_POST['hdn_start_time']; ?>">
				</div>
			</fieldset>
			<fieldset>
				<legend><b>Información de pago</b></legend>
				<div class="form-group">
					<label for="txt_cardholder_name">Nombre del tarjetahabiente:</label>
    				<input type="text" class="form-control" id="txt_cardholder_name" name="txt_cardholder_name" aria-describedby="cardholder_name" placeholder="Nombre de tarjetahabiente" style="height:38px;" data-conekta="card[name]" size="20">
    				<small id="name_help" class="form-text" style="display:none; color: red;">El nombre del tarjetahabiente es un campo obligatorio.</small>
				</div>
				<div class="form-group">
					<label for="txt_card_number">Número de tarjeta de crédito:</label>
    				<input type="text" class="form-control" id="txt_card_number" name="txt_card_number" aria-describedby="cardholder_name" placeholder="Número de tarjeta" style="height:38px;" data-conekta="card[number]" size="20">
    				<small id="name_help" class="form-text" style="display:none; color: red;">El número de la tarjeta es un campo obligatorio.</small>
				</div>
				<div class="form-row">
    				<div class="form-group col-md-4 mb-3">
      					<label for="txt_cvc">CVC:</label>
      					<input type="text" class="form-control" id="txt_cvc" name="txt_cvc" style="height:38px;" placeholder="CVC" size="4" data-conekta="card[cvc]">
    				</div>
    				<div class="form-group col-md-4 mb-3">
      					<label for="txt_expiration_month">Mes de expiración (MM):</label>
      					<input type="text" class="form-control" id="txt_expiration_month" name="txt_expiration_month" style="height:38px;" placeholder="Mes de expiración" size="2" data-conekta="card[exp_month]">
    				</div>
    				<div class="form-group col-md-4 mb-3">
      					<label for="txt_expiration_year">Año de expiración (AAAA):</label>
      					<input type="text" class="form-control" id="txt_expiration_year" name="txt_expiration_year" style="height:38px;" placeholder="Año de expiración" size="4" data-conekta="card[exp_year]">
    				</div>
  				</div>
			</fieldset>
			<button type="submit">Realizar Pago</button>
		</form>
		<!-- Card form -->
		<!--<form action="/confirmacion-de-pago" method="POST" id="card-form">
  			<span class="card-errors"></span>
  			<div>
    			<label>
      				<span>Nombre del tarjetahabiente</span>
      				<input type="text" size="20" data-conekta="card[name]">
    			</label>
  			</div>
  			<div>
    			<label>
      				<span>Número de tarjeta de crédito</span>
      				<input type="text" size="20" data-conekta="card[number]">
    			</label>
  			</div>
  			<div>
    			<label>
      				<span>CVC</span>
      				<input type="text" size="4" data-conekta="card[cvc]">
    			</label>
  			</div>
  			<div>
    			<label>
      				<span>Fecha de expiración (MM/AAAA)</span>
      				<input type="text" size="2" data-conekta="card[exp_month]">
    			</label>
    			<span>/</span>
    			<input type="text" size="4" data-conekta="card[exp_year]">
  			</div>
  			<button type="submit">Crear token</button>
		</form>-->

		<div class="container" style="text-align: center;">
			<p>Se aceptan pagos con tarjetas Visa, Mastercard y American Express.</p>
			<div id="paypal-button-container" style="width: 320px; display: block; margin: auto;"></div>
		</div>
		<script>
			var validateInputs = function(input){
				switch(input){
					case 'name':
						if($('#txt_name').val() == ''){
							$('#name_help').css('display', 'inline');
							$('#txt_name').css('border', '1px solid red');
						}else{
							$('#txt_name').css('border', '1px solid #e7e7e7');
							$('#name_help').css('display', 'none');
						}
						break;
					case 'lastname':
						if($('#txt_lastname').val() == ''){
							$('#lastname_help').css('display', 'inline');
							$('#txt_lastname').css('border', '1px solid red');
						}else{
							$('#txt_lastname').css('border', '1px solid #e7e7e7');
							$('#lastname_help').css('display', 'none');
						}
						break;
					case 'email':
						if($('#txt_email').val() == ''){
							$('#email_help').css('display', 'inline');
							$('#txt_email').css('border', '1px solid red');
						}else{
							$('#txt_email').css('border', '1px solid #e7e7e7');
							$('#email_help').css('display', 'none');
						}
						break;
					case 'email2':
						if($('#txt_confirm_email').val() == ''){
							$('#email2_help').css('display', 'inline');
							$('#email2_help').html('El campo de confirmación de correo es obligatorio.');
							$('#txt_confirm_email').css('border', '1px solid red');
						}else{
							if($('#txt_confirm_email').val() != $('#txt_email').val()){
								$('#email2_help').css('display', 'inline');
								$('#email2_help').html('El correo electrónico ingresado no es igual al anterior.');
								$('#txt_confirm_email').css('border', '1px solid red');
							}else{
								$('#txt_confirm_email').css('border', '1px solid #e7e7e7');
								$('#email2_help').css('display', 'none');
							}
						}
						break;
					case 'phone':
						if($('#txt_mobile_phone').val() == ''){
							$('#mobile_help').css('display', 'inline');
							$('#txt_mobile_phone').css('border', '1px solid red');
						}else{
							$('#txt_mobile_phone').css('border', '1px solid #e7e7e7');
							$('#mobile_help').css('display', 'none');
						}
						break;
				}
			}

  			// Conekta script
  			Conekta.setPublicKey('key_JZbV8T6Ercs8rXmrNtsTobQ');

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
      				console.log('Submit ok');

      				var $form = $(this);
      				// Previene hacer submit más de una vez
      				$form.find("button").prop("disabled", true);
      				Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      				return false;
    			});
  			});

  			$(document).ready(function(){
  				$( "#txt_name" ).focus();
			});
		</script>
	</div>
	

<?php get_footer(); ?>