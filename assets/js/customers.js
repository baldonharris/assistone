var source = $('#display_picture').attr('source');
$('#display_picture').attr('src', source+'/user.png');

$(document).ready(function(){

	var customer_id; // must set to zero if customer is deleted
	var counter=0;
	var mode;
	var customer_dup;
	var url_action;

	$('.list-group').on('click', '.customers', function(e){
		e.preventDefault();
		$('#please').html('&nbsp;');
		if(customer_id != $(this).attr('customer_id')){
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

	$('#btn-add').click(function(e){
		e.preventDefault();
		mode = 1;
		url_action = $('#form_customer').attr('add-url');
		$('.modal-body').find('form')[0].reset();
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
				console.log(index);
				if(index==='guarantor_id'){
					$('[name=guarantor_customers_id]').val(new_value);
				}else{
					$('[name='+index+']').val(new_value);
				}
			});
		}
	});

	$('#form_customer').submit(function(e){
		e.preventDefault();
		$(this).ajaxSubmit({url:url_action, success:function(responseText){
			var response = JSON.parse(responseText);
			$('#myModal').modal('hide');
			if(mode==1){	// add
				if(response.status){	// add success
					// var dummy_template = $('#dummy_list_item').clone();
					// dummy_template.attr('customer_id', response.data.id);
					// dummy_template.find('td#dummy-cust-id').text(response.data.customer_id);
					// dummy_template.find('td#dummy-cust-name').text(response.data.name);
					// dummy_template.removeClass('hidden');
					// dummy_template.removeAttr('id');
					// $('#customer_list').prepend(dummy_template);
					window.location.href = $('#base_url').attr('url'); 
				}else{						// add fail
					console.log(responseText);
				}
			}else{			// update
				location.reload();
			}
		}});
	});

});