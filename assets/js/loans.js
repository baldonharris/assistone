$(document).ready(function(){

	var url_action_loan;
	var data_serialize;

	$('input[name=number_of_terms]').maskMoney({precision: 0});
	$('input[name=amount_loan]').maskMoney({prefix: '₱ '});
	$('input[name=interest_rate]').maskMoney({suffix: ' %'});

	$('input[name="date_of_application"], input[name="date_of_release"]').daterangepicker({
		singleDatePicker: true,
		locale:{
			format: 'YYYY-MM-DD'
		},
		parentEl: '#addLoan .modal-body'
	});

	$('input[name="date_of_application"], input[name="date_of_release"]').on('show.daterangepicker', function(ev, picker){
		$('.daterangepicker').addClass('picker_3');
	});

	$('.add-loan-btn').click(function(e){
		e.preventDefault();
		$('#addLoan').modal('show');
		url_action_loan = $('#form_loan').attr('add-url');
		mode = 1;
	});

	$('#form_loan').submit(function(e){
		e.preventDefault();
		$(this).ajaxSubmit({
			url: url_action_loan,
			resetForm: true,
			clearForm: true,
			beforeSubmit: function(arr, $form, options){
				data_serialize = arr;
			},
			success: function(responseText){
				var response = JSON.parse(responseText);
				if(mode==1){	// add
					if(response.status == 1){	// success adding
						console.log(data_serialize);
						var duplicate_row = $('#loan_row_dummy').clone();
						$.each(data_serialize, function(index, value){
							duplicate_row.find('#'+value.name).text(value.value)
						});
						var options = new JsNumberFormatter.formatNumberOptions().specifyDecimalMask('00');
						var new_interest_amount = JsNumberFormatter.formatNumber(parseFloat(response.data.total_interest_amount), options, true);
						var new_balance = JsNumberFormatter.formatNumber(parseFloat(response.data.balance), options, true);
						
						if(new_interest_amount < 1){
							new_interest_amount = "₱ 0"+new_interest_amount;
						}else{
							new_interest_amount = "₱ "+new_interest_amount;
						}

						if(new_balance < 1){
							new_balance = "₱ 0"+new_balance;
						}else{
							new_balance = "₱ "+new_balance;
						}

						duplicate_row.find('#loan_id').text(response.data.loan_id);
						duplicate_row.find('#total_interest_amount').text(new_interest_amount);
						duplicate_row.find('#balance').text(new_balance);
						$('#loan_body').prepend(duplicate_row);
						duplicate_row.removeAttr('class id').addClass('loan_row');
					}else{						// failed

					}
				}else{			// update

				}
			}
		});
	});

});