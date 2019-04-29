			$(document).ready(function(){
	  			$( "#txt_name" ).focus();
	  			Conekta.setPublicKey('key_JZbV8T6Ercs8rXmrNtsTobQ');	
			});

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
  					var card_form = '<div class="form-group"><label for="txt_cardholder_name">Nombre del tarjetahabiente:</label> <input type="text" class="form-control" id="txt_cardholder_name" name="txt_cardholder_name" aria-describedby="cardholder_name" placeholder="Nombre de tarjetahabiente" style="height:38px;" data-conekta="card[name]" size="20" required> <small id="name_help" class="form-text" style="display:none; color: red;">El nombre del tarjetahabiente es un campo obligatorio.</small></div><div class="row"><div class="col"><label for="txt_cardholder_email">Email</label><input type="text" class="form-control" id="txt_cardholder_email" name="txt_cardholder_email" style="height:38px;"></div><div class="col"><label for="txt_cardholder_phone">Teléfono</label><input type="text" class="form-control" id="txt_cardholder_phone" name="txt_cardholder_phone" style="height:38px;"></div></div><div class="form-group"><label for="txt_card_number">Número de tarjeta de crédito:</label> <input type="text" class="form-control" id="txt_card_number" name="txt_card_number" aria-describedby="cardholder_name" placeholder="Número de tarjeta" style="height:38px;" data-conekta="card[number]" size="20" required> <small id="name_help" class="form-text" style="display:none; color: red;">El número de la tarjeta es un campo obligatorio.</small></div><div class="form-row"> <div class="form-group col-md-4 mb-3"> <label for="txt_cvc">CVC:</label> <input type="text" class="form-control" id="txt_cvc" name="txt_cvc" style="height:38px;" placeholder="CVC" size="4" data-conekta="card[cvc]" required> </div><div class="form-group col-md-4 mb-3"> <label for="txt_expiration_month">Mes de expiración (MM):</label> <input type="text" class="form-control" id="txt_expiration_month" name="txt_expiration_month" style="height:38px;" placeholder="Mes de expiración" size="2" data-conekta="card[exp_month]" required> </div><div class="form-group col-md-4 mb-3"> <label for="txt_expiration_year">Año de expiración (AAAA):</label> <input type="text" class="form-control" id="txt_expiration_year" name="txt_expiration_year" style="height:38px;" placeholder="Año de expiración" size="4" data-conekta="card[exp_year]" required> </div></div>';
  					container.html(card_form);
  					payment_type_image_container.html('<p>Se aceptan pagos con tarjetas Visa, Mastercard y American Express.</p><img src="https://bluehand.com.mx/console/img/payments-cards.png" width="270">');

  				}else if(payment_type = "spei"){
  					var spei_legend = '<h4>Los datos para pago vía SPEI serán generados al momento de confirmar la compra.</h4>';
  					container.html(spei_legend);
  					payment_type_image_container.html('<img src="https://bluehand.com.mx/console/img/spei-logo.png" width="270">');
  				}

  				$('#hdn_payment_type').val(payment_type);
  			}

			var addParticipant = function(){
				var main_container = $('#participants_container');
				var html = '<hr>';
				html += '<div class="row">';
				html += '<div class="col">';
				html += '<label for="txt_name">Nombre:</label>';
    			html += '<input type="text" class="form-control" name="txt_name[]" aria-describedby="name_help" placeholder="Nombre" style="height:38px;" required>';
    			html += '<small id="name_help" class="form-text" style="display:none; color: red;">El nombre del participante es un campo obligatorio.</small>';
				html += '</div>';

				html += '<div class="col">';
				html += '<label for="txt_lastname">Apellidos:</label>';
    			html += '<input type="text" class="form-control" name="txt_lastname[]" aria-describedby="lastname_help" placeholder="Apellidos" style="height:38px;" required>';
    			html += '<small id="lastname_help" class="form-text" style="display:none; color: red;">Los apellidos del participante son un campo obligatorio.</small>';
				html += '</div>';

				html += '<div class="col">';
				html += '<label for="txt_email">Correo electrónico:</label>';
    			html += '<input type="email" class="form-control" name="txt_email[]" aria-describedby="email_help" placeholder="Correo electrónico" style="height:38px;" required>';
    			html += '<small id="email_help" class="form-text" style="display:none; color: red;">El campo correo electrónico es obligatorio.</small>';
    			html += '</div>';

    			html += '<div class="col">';
				html += '<label for="txt_mobile_phone">Teléfono móvil:</label>';
    			html += '<input type="number" class="form-control" name="txt_mobile_phone[]" aria-describedby="mobile_help" placeholder="Teléfono móvil" style="height:38px;" size="10" required>';
    			html += '<small id="mobile_help" class="form-text" style="display:none; color: red;">El campo teléfono móvil es obligatorio.</small>';
    			html += '</div>';

				html += '</div>';				
				
				main_container.append(html);
				
				// Updating price
				places++;
				console.log('Price: ' + places);
				$('#hdn_num_places').val(places);

				var new_value = (unit_price * places);
				var new_iva = ((new_value * 16) / 100);
				var new_total = (new_value + new_iva);

				$('#txt_course_cost').val(new_value);
				$('#txt_iva').val(new_iva);
				$('#txt_total_cost').val(new_total);
			}

			var removeParticipant = function(){
				if(places > 1){
					$('#participants_container .row').last().remove();
					$('#participants_container hr').last().remove();
					
					// Updating price
					places--;
					console.log('Price: ' + places);
					$('#hdn_num_places').val(places);

					var new_value = (unit_price * places);
					var new_iva = ((new_value * 16) / 100);
					var new_total = (new_value + new_iva);

					$('#txt_course_cost').val(new_value);
					$('#txt_iva').val(new_iva);
					$('#txt_total_cost').val(new_total);
				}
			}