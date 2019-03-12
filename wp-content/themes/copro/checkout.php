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
		<form>
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
    				<input type="number" class="form-control" id="txt_phone" name="txt_phone" placeholder="Teléfono" style="height:38px;" min="10" max="10">
    			</div>
    			<div class="col">
					<label for="txt_mobile_phone">Teléfono móvil:</label>
    				<input type="number" class="form-control" id="txt_mobile_phone" name="txt_mobile_phone" aria-describedby="mobile_help" placeholder="Teléfono móvil" style="height:38px;" min="10" max="10" onblur="validateInputs('phone');">
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
		</form>
		<div class="container" style="text-align: center;">
			<p>Elija cualquiera de nuestras diferentes formas de pago (Visa, Mastercard, American Express o Paypal).</p>
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

			$(document).ready(function(){
  				$( "#txt_name" ).focus();
			});

  			paypal.Buttons({
  				style: {
  					layout: 'vertical',
  					color: 'silver'
  				},
    			createOrder: function(data, actions) {
      				// Set up the transaction
      				return actions.order.create({
        				purchase_units: [{
          					amount: {
            					value: 1
          					},
          					payer: {
          						name: {
          							given_name: document.getElementById('txt_name').value,
          							surname: document.getElementById('txt_lastname').value
          						}
          					}
        				}]
      				});
    			},
    			onApprove: function(data, actions) {
    				return actions.order.capture().then(function(details) {
    					var container = $('#main_container_checkout');
    					var course_name = $('#txt_course_name').val();

    					var html_success = '<div style="text-align:center;">';
    					html_success += '<h1>¡Felicidades!</h1>';
    					html_success += '<p>Has asegurado tu lugar en el curso: '+course_name+'</p>';
    					html_success += '<p><b>Clave de confirmación: '+details.id+'</b></p>';
    					html_success += '<p>Guarda tu clave de confirmación y espera los detalles del curso en tu correo electrónico.</p>';
    					html_success += '</div>';

    					var html_fail = '<div>';
    					html_fail += '<h1>Ha ocurrido un problema :(</h1>';
    					html_fail += '<p>Tu pago no ha sido aprobado, verifica tus movimientos e inténtalo de nuevo.</p>';
    					html_fail += '<p>Si tienes dudas acerca del estado de tu compra puedes comunicarte con nuestro equipo de soporte.</p>';
    					html_fail = '</div>';

    					if(details.status == 'COMPLETED'){
    						
							var to = $('#txt_confirm_email').val();
							var course_name = $('#txt_course_name').val();
							var payment_confirmation = details.id;
							var course_location = $('#hdn_location').val();
							var course_date = $('#hdn_start_time').val();
							var course_detail_id = <? echo "'".$_POST['hdn_headquarter_id']."'"; ?>;
							var name = $('#txt_name').val();
							var lastname = $('#txt_lastname').val();
							var email = $('#txt_confirm_email').val();
							var telephone = $('#txt_mobile_phone').val();
							var amount = $('#txt_course_cost').val() - (($('#txt_course_cost').val() * 16) / 100);
							var iva = (($('#txt_course_cost').val() * 16) / 100);
							var total_amount = $('#txt_course_cost').val();
							var payment_status = details.status;
							var payment_date = details.create_time;
							var email_params = JSON.stringify({to: to, course_name: course_name, payment_confirmation: payment_confirmation, course_location: course_location, course_date: course_date});
							var save_params = JSON.stringify({course_detail_id: course_detail_id, name: name, lastname: lastname, email: email, telephone: telephone, places: 1, amount: amount, iva: iva, total_amount: total_amount, payment_type: 'Paypal', payment_confirmation: payment_confirmation, payment_status: payment_status, payment_date: payment_date});

							console.log(save_params);
							
							// Sending the email notification
							$.ajax({
								url: 'https://cms.bluehand.com.mx/api/v1/emails/send-purchase-notification',
								method: 'post',
								dataType: 'json',
								data: email_params,
								success: function(response){
									console.log(response.code_result);
								},
								error: function(error){
									console.log('Ha ocurrido un error: ' + error);
								}
							});

							// Saving the order in the system
							$.ajax({
								url: 'https://cms.bluehand.com.mx/api/v1/payment/post',
								method: 'post',
								dataType: 'json',
								data: save_params,
								success: function(response){
									console.log(save_params);
								},
								error: function(error){

								}
							});

							container.empty();
							container.html(html_success);
    					}else{
    						container.empty();
							container.html(html_fail);
    					}

    					var response = JSON.stringify({
    						name: details.payer.name.given_name,
    						email: details.payer.email_address,
    						order_id: details.id,
    						order_status: details.status,
    						order_time: details.create_time
    					});
    					//console.log(response);
    				});
    			}
  			}).render('#paypal-button-container');
		</script>
	</div>
	

<?php get_footer(); ?>