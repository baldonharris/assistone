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
					new PNotify({
						title:'Success!',
						text:'Admin successfully added!',
						type:"success",
						delay:3000,
						animation:"fade",
						mobile:{swipe_dismiss:true,styling:true},
						buttons:{closer:false,sticker:false},
						desktop: {desktop: true,fallback: true}
					});
					$('#add_admin').modal('hide');
				}else{
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
				if(response.status){
					new PNotify({
						title:'Success!',
						text:'Admin successfully updated! Please logout to see changes.',
						type:"success",
						delay:3000,
						animation:"fade",
						mobile:{swipe_dismiss:true,styling:true},
						buttons:{closer:false,sticker:false},
						desktop: {desktop: true,fallback: true}
					});
					$('#add_admin').modal('hide');
				}else{
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

});