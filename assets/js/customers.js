$(document).ready(function(){

	var customer_id; // must set to zero if customer is deleted
	var counter=0;
	var mode;
	var customer_dup;
	var url_action;
	var customers = [];

	$.post($('#base_url').attr('base-url')+'customers/get_customer', function(response){
		var customer_detail = JSON.parse(response);
		$.each(customer_detail.customer_detail, function(index, value){
			if(customers.indexOf(value.complete_name) == -1 && value.complete_name != null){
				customers.push(value.complete_name);				
			}
		});
		$('#search_customer').autocomplete({
			lookup: customers,
			width: 280
		});
	});

	var source = $('#display_picture').attr('source');
	$('#display_picture').attr('src', source+'/user.png');
	$('[name=mobilenumber]').inputmask('9999 999 9999');

	$('.list-group').on('click', '.customers', function(e){
		e.preventDefault();
		if(customer_id != $(this).attr('customer_id')){
			$('.fa-spinner').removeClass('hidden');
			customer_id = $(this).attr('customer_id');
			$('.customers').removeClass('active');
			$('[customer_id='+customer_id+']').addClass('active');
			$('.loan_row').remove();

			$.post($('.list-group').attr('get-url'), {id:customer_id}, function(response){
				var customer_details_and_loans = JSON.parse(response);
				var customer = customer_details_and_loans.customer_detail;
				var loans = customer_details_and_loans.loan_detail;
				var customer_status;
				console.log(customer_details_and_loans);
				customer_dup = $.extend({}, customer[0]); // store to global for modal purposes.
				$.each(customer[0], function(index, value){
					var new_value = (value) ? value : '';
					if(index=='display_picture'){
						var source = $('#'+index).attr('source');
						if(!new_value){
							$('#'+index).attr('src', source+'/user.png');
						}else{
							$('#'+index).attr('src', source+'/'+value);
						}
					}else if(index=='deleted_at'){
						customer_status = (new_value.length==0) ? 'Active' : 'Inactive';
						$('#'+index).text(customer_status);
					}else if(index=='customer_id'){
						$('.mask p').text('Customer ID: '+new_value);
					}else{
						$('#'+index).text(new_value);
					}
				});
				var action_url = $('#del-btn-url-holder').attr('base-url');
				if(customer_status=='Active'){
					$('.btn-delete')
						.attr('href', action_url+'/'+customer_id+'/'+0)
						.removeClass('btn-success')
						.addClass('btn-dark')
						.html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del');
				}else{
					$('.btn-delete')
						.attr('href', action_url+'/'+customer_id+'/'+1)
						.removeClass('btn-dark')
						.addClass('btn-success')
						.html('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Und');
				}
				
				$.each(loans, function(index, value){
					var duplicate_row = $('#loan_row_dummy').clone();
					$.each(value, function(index, value){
						if(index == 'amount_loan' || index == 'total_interest_amount' || index == 'balance'){
							var new_value = $.number(parseFloat(value), 2);
							if(new_value < 1){
								new_value = "0"+new_value;
							}
							duplicate_row.find('#'+index).text(new_value);
						}else if(index == 'id'){
							duplicate_row.find('.view_loan_btn').attr('loan-id', value);
							duplicate_row.attr({id: value});
						}else if(index == 'interest_rate'){
							duplicate_row.find('#'+index).text(value+" %");
						}else{
							duplicate_row.find('#'+index).text(value);
						}
						if(index == 'balance' && value == '0.00'){
							duplicate_row.addClass('zerobalance');
							duplicate_row.find('.view_loan_btn').addClass('disabled');
							duplicate_row.find('.update-loan-btn').addClass('disabled');
						}
					});
					$('#loan_body').append(duplicate_row);
					duplicate_row.removeClass('hidden').addClass('loan_row');
				});

				$('#btn-update, .btn-delete').removeClass('disabled');
				$('#account_overview, .add-loan-btn').removeClass('hidden');
				$('.customer_id, .fa-spinner').addClass('hidden');
				$('input[name=customer_id]').val(customer_dup.id);
			});
		}
	});

	$('.add-btn').click(function(e){
		e.preventDefault();
		mode = 1;
		url_action = $('#form_customer').attr('add-url');
		$('.modal-body').find('form')[0].reset();
		$('#myModal').modal('show');
	});

	$('#btn-update').click(function(e){
		e.preventDefault();
		url_action = $('#form_customer').attr('update-url');
		mode = 0;
	});

	$('#myModal').on('show.bs.modal', function(e){
		if(mode==1){
			$('#myModal .modal-title').html('Add Customer');
		}else{
			$('.modal-title').html('Update Customer - '+$('#firstname').text()+' '+$('#lastname').text());
			$.each(customer_dup, function(index, value){
				var new_value = (value) ? value : '';
				if(index==='guarantor_id'){
					$('[name=guarantor_customers_id]').val(new_value);
				}else{
					$('[name='+index+']').val(new_value);
				}
			});
			$('option[value='+customer_dup.id+']').wrap('<span/>');
		}
	});

	$('#myModal').on('hidden.bs.modal', function(e){
		$('.form-group').removeClass('has-error');
		$('.errhandler').html('');
		if(mode!=1) $('option[value='+customer_dup.id+']').unwrap();
	});

	$('#form_customer').submit(function(e){
		e.preventDefault();
		$(this).ajaxSubmit({url:url_action, success:function(responseText){
			var response = JSON.parse(responseText);
			if(mode==1){	// add
				if(response.status){	// add success
					new PNotify({
						title:'Success!',
						text:'Customer successfully added!',
						type:"success",
						delay:3000,
						animation:"fade",
						mobile:{swipe_dismiss:true,styling:true},
						buttons:{closer:false,sticker:false},
						desktop: {desktop: true,fallback: true}
					});
					location.reload();
				}else{						// add fail
					$('.form-group').removeClass('has-error');
					$('.errhandler').html('');
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					})
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
				if(response.status){	// update success
					location.reload();
				}else{						// update fail
					$('.form-group').removeClass('has-error');
					$('.errhandler').html('');
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					})
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
			}
		}});
	});

	$('#forCustomerSettings').click(function(e){
		e.preventDefault();
		$('#customerSettings').modal('show');
	});

	$('#btn-setting').click(function(e){
		var set_page = $('[name=set_page]').val();
		var set_sortby = $('[name=set_sortby]').val();
		var set_orderby = $('[name=set_orderby]:checked').val();
		var set_display = ($('[name=set_display]').is(':checked')) ? 1 : 0;

		var setting_url = $('#form_setting').attr('action');
		setting_url = setting_url+"/"+set_page+"/"+set_sortby+"/"+set_orderby+"/"+set_display;
		window.location.href = setting_url;
	});
	
	$('.btn-group').on('click', '.view_loan_btn', function(event){
		console.log('hello');
		if($('.view_loan_btn').hasClass('disabled')){
			console.log('hi');
			event.preventDefault();
			return 0;
		}
	});
	$('.btn-group').on('click', '.update-loan-btn', function(event){
		if($('.update-loan-btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});

});