$(document).ready(function(){

	var url_action_loan;
	var data_serialize;
	var mode;

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

	$('.add-loan-btn').click(function(e){
		mode = 0;
		e.preventDefault();
		$('#addLoan').modal('show');
		url_action_loan = $('#form_loan').attr('add-url');
		$('#form_loan').resetForm();
	});

	$('#loan_table').on('click', '.update-loan-btn', function(e){
		mode = 1;
		e.preventDefault();
		$('#addLoan').modal('show');
		url_action_loan = $('#form_loan').attr('update-url');
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
								}else if(value.name == 'interest_rate'){
									value.value = $.number(parseFloat(value.value), 2)+' %';
								}
								duplicate_row.find('#'+value.name).text(value.value)
							});
		
							var new_interest_amount = $.number(parseFloat(response.data.total_interest_amount), 2);
							var new_balance = $.number(parseFloat(response.data.balance), 2);
							
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
		$(this).find('#myModalLabel').text('');
		$('.form-group').removeClass('has-error');
	});

	$('#addLoan').on('show.bs.modal', function(relatedTarget){
		$(this).find('#myModalLabel').text( (!mode) ? 'Add Loan' : 'Update Loan' );
		if(mode == 1){
			console.log(relatedTarget);
		}
	});

});