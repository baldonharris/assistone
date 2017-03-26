$(document).ready(function(){

	var url_action_loan;
	var data_serialize;
	var mode;
    var text;
    
    var modify_loan_row = function(passed_row, response){
        $.each(data_serialize, function(index, value){
            if(value.name == 'amount_loan'){
                value.value = value.value.replace('₱ ', '');
            }else if(value.name == 'interest_rate'){
                value.value = $.number(parseFloat(value.value), 2)+' %';
            }
            passed_row.find('#'+value.name).text(value.value);
        });

        var new_interest_amount = $.number(parseFloat(response.data.total_interest_amount), 2);
        var new_balance = $.number(parseFloat(response.data.balance), 2);

        if(new_interest_amount < 1){
            new_interest_amount = "0"+new_interest_amount;
        }

        if(new_balance < 1){
            new_balance = "0"+new_balance;
        }
        passed_row.find('#loan_id').text(response.data.loan_id);
        passed_row.find('#total_interest_amount').text(new_interest_amount);
        passed_row.find('#balance').text(new_balance);
        passed_row.find('.view_loan_btn').attr('loan-id', response.data.id);
        passed_row.removeAttr('class id').addClass('loan_row');
        passed_row.attr('id', response.data.id);
        return passed_row;
    }

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
        ;
        $('#addLoan form')[0].reset();
	});

	$('#loan_table').on('click', '.update-loan-btn', function(e){
        mode = 1;
        e.preventDefault();
        $('#addLoan').modal('show', this);
        url_action_loan = $('#form_loan').attr('update-url');
	});

	$('#save_loan').click(function(e){
            e.preventDefault();
            var submit_loan = false;
            new PNotify({
                    title: 'Confirmation Needed',
                    text: text, // global var, see show.bs.modal of #addLoan
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
                            if(mode==0){	// add
                                if(response.status == 1){	// success adding
                                    var duplicate_row = $('#loan_row_dummy').clone();
                                    
                                    var passed_row = modify_loan_row(duplicate_row, response);
                                    $('#loan_body').prepend(passed_row);
                                    
                                    $('#addLoan').modal('hide');
                                    pnotify('Success', 'Loan successfully added!', 'success');
                                    $('#form_loan').resetForm();
                                }else{						// failed
                                    $('.form-group').removeClass('has-error');
                                    $('.errhandler').html('');
                                    $.each(response.data, function(index, value){
                                        $('[errhandler='+index+']').html(value);
                                        $('[name='+index+']').parent().addClass('has-error');
                                    });
                                    pnotify('Oh no!', 'An error has occured!', 'error');
                                }
                            }else{			// update
                                if(response.status === 1){
                                    var relatedRow = $('tr#'+response.data.id);
                                    console.log(relatedRow);
                                    if(response.data.status === 'approved'){
                                        $(relatedRow).remove();
                                    }else{
                                        modify_loan_row(relatedRow, response);
                                    }
                                    $('#addLoan').modal('hide');
                                    pnotify('Success', 'Loan successfully updated!', 'success');
                                    $('#form_loan').resetForm();
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
    
    $('.btn-group').on('click', '.view_loan_btn', function(event){
		if($('.view_loan_btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
	});

	$('#addLoan').on('show.bs.modal', function(e){
        if($('.update-loan-btn').hasClass('disabled')){
			event.preventDefault();
			return 0;
		}
        
        if(mode === 1){
            var rt = $(e.relatedTarget).closest('tr');
            var loan_id = rt.find('#loan_id').text();
            var loan_details = {
                id: rt.attr('id'),
                date_of_application: rt.find('#date_of_application').text(),
                date_of_release: rt.find('#date_of_release').text(),
                amount_loan: rt.find('#amount_loan').text(),
                interest_rate: rt.find('#interest_rate').text(),
                number_of_terms: rt.find('#number_of_terms').text(),
                status: ($(e.relatedTarget).hasClass('btn-danger')) ? 'approved' : 'reserved'
            };
            
            if(loan_details.status === 'reserved'){
                text = 'Are you sure you want to update Loan ID '+loan_id+'?';
                $(this).find('#myModalLabel').text( 'Update Loan: '+rt.find('#loan_id').text() );
            }else{
                text = 'Are you sure you want to approve Loan ID '+loan_id+'?';
                $(this).find('#myModalLabel').text( 'Approve Loan: '+rt.find('#loan_id').text() );
            }

            $.each(loan_details, function(index, value){
                if(index === 'interest_rate'){
                    $('#form_loan').find('#in_'+index).val(value.replace('.00 %', '.0'));
                }else if(index === 'amount_loan'){
                    $('#form_loan').find('#in_'+index).val('₱ '+value);
                }else{
                    $('#form_loan').find('#in_'+index).val(value);   
                }
            });
        }else{
            $('#form_loan').find('#in_status').val('reserved');
            $(this).find('#myModalLabel').text('Add Loan');
            text = 'Adding this loan can\'t be undone. Are you sure?';
        }
	});

});