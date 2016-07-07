$(document).ready(function(){

	var url_action_loan;
	var data_serialize;

	$('input[name=number_of_terms]').maskMoney({precision: 0});
	$('input[name=amount_loan], input[name=payment_amount_paid]').maskMoney({prefix: '₱ '});
	$('input[name=interest_rate]').maskMoney({suffix: ' %'});

	$('input[name="date_of_application"], input[name="date_of_release"]').daterangepicker({
		singleDatePicker: true,
		locale:{
			format: 'YYYY-MM-DD'
		},
		parentEl: '#addLoan .modal-body'
	});

	$('input[name="payment_actual_paid_date"]').daterangepicker({
		singleDatePicker: true,
		locale:{
			format: 'YYYY-MM-DD'
		},
		parentEl: '#payment_form .modal-body'
	});

	// $('input[name="date_of_application"], input[name="date_of_release"]').on('show.daterangepicker', function(ev, picker){
	// 	$('.daterangepicker').addClass('picker_3');
	// });

	$('.add-loan-btn').click(function(e){
		e.preventDefault();
		$('#addLoan').modal('show');
		url_action_loan = $('#form_loan').attr('add-url');
		mode = 1;
		$('#form_loan').resetForm();
	});

	$('#save_loan').click(function(e){
		e.preventDefault();
		var submit_loan = false;
		new PNotify({
				title: 'Confirmation Needed',
				text: 'Adding this loan cannot be undone. Are you sure?',
				icon: 'glyphicon glyphicon-question-sign',
				hide: false,
				confirm: {
				confirm: true
			},
			buttons: {
				closer: false,
				sticker: false
			},
			history: {
				history: false
			},
			addclass: 'stack-modal',
			stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
		})
		.get().on('pnotify.confirm', function(){
			submit_loan = true;
			$('#form_loan').ajaxSubmit({
				url: url_action_loan,
				beforeSubmit: function(arr, $form, options){
					data_serialize = arr;
				},
				success: function(responseText){
					var response = JSON.parse(responseText);
					if(mode==1){	// add
						if(response.status == 1){	// success adding
							var duplicate_row = $('#loan_row_dummy').clone();
							$.each(data_serialize, function(index, value){
								if(value.name == 'amount_loan'){
									value.value = value.value.replace('₱ ', '');
								}
								duplicate_row.find('#'+value.name).text(value.value)
							});
							var options = new JsNumberFormatter.formatNumberOptions().specifyDecimalMask('00');
							var new_interest_amount = JsNumberFormatter.formatNumber(parseFloat(response.data.total_interest_amount), options, true);
							var new_balance = JsNumberFormatter.formatNumber(parseFloat(response.data.balance), options, true);
							
							if(new_interest_amount < 1){
								new_interest_amount = "0"+new_interest_amount;
							}

							if(new_balance < 1){
								new_balance = "0"+new_balance;
							}

							duplicate_row.find('#loan_id').text(response.data.loan_id);
							duplicate_row.find('#total_interest_amount').text(new_interest_amount);
							duplicate_row.find('#balance').text(new_balance);
							duplicate_row.find('.view_loan_btn').attr('loan-id', response.data.id);
							$('#loan_body').prepend(duplicate_row);
							duplicate_row.removeAttr('class id').addClass('loan_row');
							$('#addLoan').modal('hide');
							new PNotify({
								title:'Success!',
								text:'Loan successfully added!',
								type:"success",
								delay:3000,
								animation:"fade",
								mobile:{swipe_dismiss:true,styling:true},
								buttons:{closer:false,sticker:false},
								desktop: {desktop: true,fallback: true}
							});
							$('#form_loan').resetForm();
						}else{						// failed
							$('.form-group').removeClass('has-error');
							$('.errhandler').html('');
							$.each(response.data, function(index, value){
								$('[errhandler='+index+']').html(value);
								$('[name='+index+']').parent().addClass('has-error');
							});
							new PNotify({
								title:'Oh no!',
								text:'An error has occured!',
								type:"error",
								delay:3000,
								animation:"fade",
								mobile:{swipe_dismiss:true,styling:true},
								buttons:{closer:false,sticker:false},
								desktop: {desktop: true,fallback: true}
							});
						}
					}else{			// update

					}
				}
			});
		}).on('pnotify.cancel', function(){
			return false;
		});
	});

	$('#addLoan').on('hidden.bs.modal', function(e){
		$('.form-group').removeClass('has-error');
		$('.errhandler').html('');
		if(mode!=1) $('option[value='+customer_dup.id+']').unwrap();
	});

	$('#loan_table').on('click', '.view_loan_btn', function(){
		$.post($(this).attr('get-payment'), {id:$(this).attr('loan-id')}, function(response){
			var payments = JSON.parse(response);
			var null_counter = 0;
			$.each(payments.data, function(index, payment_value){
				var duplicated_row = $('#view_loan_row_dummy').clone();
				$.each(payment_value, function(index, value){
					var new_value = value;
					if(index=='due_amount' || index=='amount_paid' || index=='payment_balance' || index=='running_balance'){
						var options = new JsNumberFormatter.formatNumberOptions().specifyDecimalMask('00');
						var new_value = JsNumberFormatter.formatNumber(parseFloat(new_value), options, true);
						if(new_value < 1){
							new_value = '0'+new_value;
						}
					}
					if(index=='id'){
						duplicated_row.attr('payment-id', value);
					}
					if(index=='actual_paid_date' && null_counter==0){
						if(!value){
							$('#payment_id').val(payment_value.id);
							duplicated_row.addClass('info');
							null_counter++;
						}
					}
					duplicated_row.find('#'+index).text(new_value);
				});
				duplicated_row.removeClass('hidden').addClass('view_loan_row');
				$('#view_loan_body').append(duplicated_row);
			});
		});
		$('#viewloan').modal('show');
	});

	$('#viewloan').on('hidden.bs.modal', function(e){
		$('.view_loan_row').remove();
	});

	$('#viewloan').on('click', '.confirm_payment', function(e){

		new PNotify({
				title: 'Confirmation Needed',
				text: 'Adding this payment cannot be undone. Are you sure?',
				icon: 'glyphicon glyphicon-question-sign',
				hide: false,
				confirm: {
				confirm: true
			},
			buttons: {
				closer: false,
				sticker: false
			},
			history: {
				history: false
			},
			addclass: 'stack-modal',
			stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
		})
		.get().on('pnotify.confirm', function(){
			
		}).on('pnotify.cancel', function(){
			return false;
		});

	});

	$('input[name=payment_amount_paid]').blur(function(){
		var payment = parseFloat($(this).val().replace('₱ ', '').replace(',', ''));
		console.log(parseFloat($(this).val().replace('₱ ', '').replace(',', ''))-1);
	});

});