$(document).ready(function(){

	var url_action;
	var mode=1;

	$('#add_admin_btn').click(function(){
		$('#add_admin').modal('show');
		$('#admin_modal_label').text('Add Admin');
		url_action = $('#form_add_admin').attr('add-url');
		mode = 1;
	});

	$('#upd_admin_btn').click(function(){
		$('#add_admin').modal('show');
		$('#admin_modal_label').text('Update Admin');
		$('#in_fullname').val($('#sess_fn').val());
		$('#in_username').val($('#sess_us').val());
		url_action = $('#form_add_admin').attr('update-url');
		mode = 0;
	});

	$('#add_admin').on('show.bs.modal', function(e){
		$('#form_add_admin').resetForm();
		$('.form-group').removeClass('has-error');
		$('.errhandler').html('');
	});

	$('#form_add_admin').submit(function(e){
		e.preventDefault();
		$(this).ajaxSubmit({url:url_action, success:function(responseText){
			var response = JSON.parse(responseText);
			if(mode == 1){	// add
				if(response.status){
					pnotify('Success', 'Admin successfully added!', 'success');
					$('#add_admin').modal('hide');
				}else{
					$('.form-group').removeClass('has-error');
					$('.errhandler').html('');
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					});
					pnotify('Oh no!', 'An error has occured', 'error');
				}
			}else{			// update
				if(response.status){
					pnotify('Success!', 'Admin successfully updated! Please logout to see changes.', 'success');
					$('#add_admin').modal('hide');
				}else{
					$('.form-group').removeClass('has-error');
					$('.errhandler').html('');
					$.each(response.data, function(index, value){
						$('[errhandler='+index+']').html(value);
						$('[name='+index+']').parent().addClass('has-error');
					});
					pnotify('Oh no!', 'An error has occured!', 'error');
				}
			}
		}});
	});

});