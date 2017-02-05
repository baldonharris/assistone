$(document).ready(function(){

	var investor_id; // must set to zero if investor is deleted
	var counter=0;
	var mode;
	var investor_dup;
	var url_action;
	var investors = [];

	$.post($('#base_url').attr('base-url')+'investors/get_investor', function(response){
		var investor_detail = JSON.parse(response);
		$.each(investor_detail.investor_detail, function(index, value){
			if(investors.indexOf(value.complete_name) == -1 && value.complete_name != null){
				investors.push(value.complete_name);				
			}
		});
		$('#search_investor').autocomplete({
			lookup: investors,
			width: 280
		});
	});

	var source = $('#display_picture').attr('source');
	$('#display_picture').attr('src', source+'/user.png');
	$('[name=mobilenumber]').inputmask('9999 999 9999');

	$('.list-group').on('click', '.investors', function(e){
		e.preventDefault();
		$('.x_panel').removeClass('acc_overview_min_height');
		if(investor_id != $(this).attr('investor_id')){
			$('.fa-spinner').removeClass('hidden');
			investor_id = $(this).attr('investor_id');
			$('.investors').removeClass('active');
			$('[investor_id='+investor_id+']').addClass('active');
			$('.investment_row').remove();

			$.post($('.list-group').attr('get-url'), {id:investor_id}, function(response){
				var investor_details_and_investments = JSON.parse(response);
				var investor = investor_details_and_investments.investor_detail;
				var investments = investor_details_and_investments.investment_detail;
				var investor_status;
				investor_dup = $.extend({}, investor[0]); // store to global for modal purposes.
				$.each(investor[0], function(index, value){
					var new_value = (value) ? value : '';
					if(index=='display_picture'){
						var source = $('#'+index).attr('source');
						if(!new_value){
							$('#'+index).attr('src', source+'/user.png');
						}else{
							$('#'+index).attr('src', source+'/'+value);
						}
					}else if(index=='deleted_at'){
						investor_status = (new_value.length==0) ? 'Active' : 'Inactive';
						$('#'+index).text(investor_status);
					}else if(index=='investor_id'){
						$('.mask p').text('investor ID: '+new_value);
					}else{
						$('#'+index).text(new_value);
					}
				});
				var action_url = $('#del-btn-url-holder').attr('base-url');
				if(investor_status=='Active'){
					$('.btn-delete')
						.attr('href', action_url+'/'+investor_id+'/'+0)
						.removeClass('btn-success')
						.addClass('btn-dark')
						.html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del');
				}else{
					$('.btn-delete')
						.attr('href', action_url+'/'+investor_id+'/'+1)
						.removeClass('btn-dark')
						.addClass('btn-success')
						.html('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Und');
				}
				
				/*$.each(investments, function(index, value){
					var duplicate_row = $('#investment_row_dummy').clone();
					$.each(value, function(index, value){
						if(index == 'amount_investment' || index == 'total_interest_amount' || index == 'balance'){
							var new_value = $.number(parseFloat(value), 2);
							if(new_value < 1){
								new_value = "0"+new_value;
							}
							duplicate_row.find('#'+index).text(new_value);
						}else if(index == 'id'){
							duplicate_row.find('.view_investment_btn').attr('investment-id', value);
							duplicate_row.attr({id: value});
						}else if(index == 'interest_rate'){
							duplicate_row.find('#'+index).text(value+" %");
						}else{
							duplicate_row.find('#'+index).text(value);
						}
						if(index == 'balance' && value == '0.00'){
							duplicate_row.addClass('zerobalance');
							duplicate_row.find('button').prop('disabled', true);
						}
					});
					$('#investment_body').append(duplicate_row);
					duplicate_row.removeClass('hidden').addClass('investment_row');
				});*/

				$('#btn-update, .btn-delete').removeClass('disabled');
				$('#account_overview, .add-investment-btn').removeClass('hidden');
				$('.investor_id, .fa-spinner').addClass('hidden');
				$('input[name=investor_id]').val(investor_dup.id);
			});
		}
	});

	$('.add-btn').click(function(e){
		e.preventDefault();
		mode = 1;
		url_action = $('#form_investor').attr('add-url');
		$('.modal-body').find('form')[0].reset();
		$('#myModal').modal('show');
	});

	$('#btn-update').click(function(e){
		e.preventDefault();
		url_action = $('#form_investor').attr('update-url');
		mode = 0;
	});

	$('#myModal').on('show.bs.modal', function(e){
		if(mode==1){
			$('#myModal .modal-title').html('Add investor');
		}else{
			$('.modal-title').html('Update investor - '+$('#firstname').text()+' '+$('#lastname').text());
			$.each(investor_dup, function(index, value){
				var new_value = (value) ? value : '';
				if(index==='guarantor_id'){
					$('[name=guarantor_investors_id]').val(new_value);
				}else{
					$('[name='+index+']').val(new_value);
				}
			});
			$('option[value='+investor_dup.id+']').wrap('<span/>');
		}
	});

	$('#myModal').on('hidden.bs.modal', function(e){
		$('.form-group').removeClass('has-error');
		$('.errhandler').html('');
		if(mode!=1) $('option[value='+investor_dup.id+']').unwrap();
	});

	$('#form_investor').submit(function(e){
		e.preventDefault();
		$(this).ajaxSubmit({url:url_action, success:function(responseText){
			var response = JSON.parse(responseText);
			if(mode==1){	// add
				if(response.status){	// add success
					new PNotify({
						title:'Success!',
						text:'investor successfully added!',
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

	$('#forinvestorsettings').click(function(e){
		e.preventDefault();
		$('#investorsettings').modal('show');
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
	
	$('.btn-group').on('click', '.view_investment_btn', function(event){
		if($('.view_investment_btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});
	$('.btn-group').on('click', '.update-investment-btn', function(event){
		if($('.update-investment-btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});

});