$(document).ready(function(){

	var investor_id; // must set to zero if investor is deleted
	var counter=0;
	var mode;
	var investor_dup;
	var url_action;
	var investors=[];

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
			$('.transaction_row').remove();
			$.post($('.list-group').attr('get-url'), {id:investor_id}, function(response){
				var investor_details_and_transactions = JSON.parse(response);
				var investor = investor_details_and_transactions.investor_detail;
				var transactions = investor_details_and_transactions.transaction_detail;
                var total_investment = investor_details_and_transactions.total_investment;
                var total_investment_return = investor_details_and_transactions.total_investment_return;
				var investor_status;
				investor_dup = $.extend({}, investor[0]); // store to global for modal purposes.
                
                /* investor info */
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
				
                /* investor transactions */
                console.log(transactions);
				$.each(transactions, function(index, value){
					var duplicate_row = $('#transaction_row_dummy').clone();
					$.each(value, function(index, value){
						if(index == 'amount_transaction'){
							var new_value = $.number(parseFloat(value), 2);
							if(new_value < 1){
								new_value = "0"+new_value;
							}
							duplicate_row.find('#'+index).text(new_value);
						}else if(index == 'id'){
				            duplicate_row.find('.view_transaction_btn').attr('transaction-id', value);
							duplicate_row.attr({id: value});
						}else if(index == 'type_transaction'){
                            duplicate_row.find('#'+index+' span').text(value).addClass( (value === 'W') ? 'type-withdrawal' : 'type-investment' );
                        }else{
							duplicate_row.find('#'+index).text(value);
						}
					});
					$('#transaction_body').append(duplicate_row);
					duplicate_row.removeClass('hidden').addClass('transaction_row');
				});
                
                /* total investment */
                $('#investor-total-investment').text($.number(parseFloat(total_investment), 2)).attr('total-investment', total_investment);
                
                /* investment return */
                $('#investor-total-investment-return').text($.number(parseFloat(total_investment_return), 2));

				$('#btn-update, .btn-delete').removeClass('disabled');
				$('#account_overview, .add-transaction-btn').removeClass('hidden');
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
	
	$('.btn-group').on('click', '.view_transaction_btn', function(event){
		if($('.view_transaction_btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});
    
	$('.btn-group').on('click', '.update-transaction-btn', function(event){
		if($('.update-transaction-btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});
    
    $('#transaction_table').on('click', '.view_transaction_btn', function(event){
        $('#view_transaction_details').modal('show', this);
    });
    
    $('#view_transaction_details').on('show.bs.modal', function(e){
        var transaction_id = $(e.relatedTarget).closest('tr').find('#transaction_id').text();
        $(this).find('.modal-title span').text(transaction_id);
        $(this).find('.returns_row').remove();
    });
    
    $('#view_transaction_details').on('shown.bs.modal', function(e){
        var id = $(e.relatedTarget).attr('transaction-id');
        var url = $('#base_url').attr('base-url')+'returns/get_returns';
        $(this).find('.table').addClass('hidden');
        $(this).find('.loading-section .fa-spinner').removeClass('hidden');
        
        $.post(url, {id:id}, function(response){
            var data = JSON.parse(response);
            $.each(data.data, function(index, value){
                var sign = (value.type_transaction === 'W') ? '-' : '';
                var new_row = $('#returns_body #returns_row_dummy').clone();
                new_row.find('#return_loan_id').text(value.loan_id);
                new_row.find('#return_percentage').text(parseFloat((value.percentage*100), 2)+'%');
                new_row.find('#return_return').text(sign+($.number(parseFloat(value.returns), 2)));
                new_row.removeClass('hidden').removeAttr('id').addClass('returns_row');
                $('#returns_body').prepend(new_row);
            });
        });
        
        $(this).find('.loading-section .fa-spinner').addClass('hidden');
        $(this).find('.table').removeClass('hidden');
    });

});