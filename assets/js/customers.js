$(document).ready(function(){

	var customer_id; // must set to zero if customer is deleted
	var counter=0;
	var mode;
	var customer_dup;
	var url_action;
	var customers = [];

	$.post($('#base_url').attr('base-url')+'customers/get_customer', function(response){
		$.each(JSON.parse(response), function(index, value){
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
			$('#customer_id').text('Loading...');
			customer_id = $(this).attr('customer_id');
			$('.customers').removeClass('active');
			$('[customer_id='+customer_id+']').addClass('active');

			$.post($('.list-group').attr('get-url'), {id:customer_id}, function(response){
				var customer = JSON.parse(response);
				customer_dup = customer[0];
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
						var text = (new_value.length==0) ? 'Active' : 'Inactive';
						$('#'+index).text(text);
					}else{
						$('#'+index).text(new_value);
					}
				});
				var del_url = $('#btn-delete').attr('base-url');
				$('#btn-delete').attr('href', del_url+'/'+customer_id);
				$('#btn-update, #btn-delete').removeClass('disabled');
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
			$('.modal-title').html('Add Customer');
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
					$('#myModal').modal('hide');
					window.location.href = $('#base_url').attr('url'); 
				}else{						// add fail
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					})
				}
			}else{			// update
				if(response.status){	// update success
					location.reload();
				}else{						// update fail
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					})
				}
			}
		}});
	});

	$('#forCustomerSettings').click(function(e){
		e.preventDefault();
		$('#customerSettings').modal('show');
	});

});