$(document).ready(function(){

	var url_action_transaction;
	var data_serialize;
	var mode;

	$('input[name=number_of_terms]').maskMoney({precision: 0});
	$('input[name=amount_transaction], input[name=payment_amount_paid]').maskMoney({prefix: '₱ '});
	$('input[name=interest_rate]').maskMoney({suffix: ' %'});

	$('input[name="date_of_transaction"]').daterangepicker({
            singleDatePicker: true,
            locale:{
                    format: 'YYYY-MM-DD'
            },
            parentEl: '#addTransaction .modal-body'
	});

	$('.add-transaction-btn').click(function(e){
            mode = 0;
            e.preventDefault();
            $('#addTransaction').modal('show');
            url_action_transaction = $('#form_transaction').attr('add-url');
            $('#form_transaction').resetForm();
            console.log(url_action_transaction);
	});

	$('#transaction_table').on('click', '.update-transaction-btn', function(e){
            mode = 1;
            e.preventDefault();
            $('#addTransaction').modal('show');
            url_action_transaction = $('#form_transaction').attr('update-url');
            $('#form_transaction').resetForm();
	});

	$('#save_transaction').click(function(e){
            e.preventDefault();
            var submit_transaction = false;
            new PNotify({
                    title: 'Confirmation Needed',
                    text: 'Adding this transaction cannot be undone. Are you sure?',
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
                submit_transaction = true;
                $('#form_transaction').ajaxSubmit({
                        url: url_action_transaction,
                        beforeSubmit: function(arr, $form, options){
                                data_serialize = arr;
                        },
                        success: function(responseText){
                            var response = JSON.parse(responseText);
                            if(mode==0){	// add
                                if(response.status == 1){	// success adding
                                    var duplicate_row = $('#transaction_row_dummy').clone();
                                    var amount_transaction;
                                    var type_transaction;
                                    $.each(data_serialize, function(index, value){
                                        if(value.name == 'amount_transaction'){
                                            value.value = value.value.replace('₱ ', '');
                                            amount_transaction = value.value.replace(',', '');
                                        }
                                        if(value.name == 'type_transaction'){
                                            duplicate_row.find('#'+value.name+' span').text(value.value).addClass( (value.value === 'W') ? 'type-withdrawal' : 'type-investment' );
                                            type_transaction = value.value;
                                        }else{
                                            duplicate_row.find('#'+value.name).text(value.value);    
                                        }
                                    });

                                    $('#transaction_body').prepend(duplicate_row);
                                    duplicate_row.find('#transaction_id').text(response.data.transaction_id);
                                    duplicate_row.find('.view_transaction_btn').attr('transaction-id', response.data.id);
                                    duplicate_row.removeAttr('class id').addClass('transaction_row');
									duplicate_row.attr('id', response.data.id);
                                    
                                    if(type_transaction == 'I'){
                                        var current_total_investment = parseFloat($('#investor-total-investment').attr('total-investment'));
                                        var add_investment = parseFloat(amount_transaction);
                                        var new_total_investment = parseFloat(current_total_investment+add_investment);
                                        $('#investor-total-investment').text($.number(new_total_investment, 2)).attr('total-investment', new_total_investment);
                                    }
                                    
                                    $('#addTransaction').modal('hide');
                                    new PNotify({
                                        title:'Success!',
                                        text:'Transaction successfully added!',
                                        type:"success",
                                        delay:3000,
                                        animation:"fade",
                                        mobile:{swipe_dismiss:true,styling:true},
                                        buttons:{closer:false,sticker:false},
                                        desktop: {desktop: true,fallback: true}
                                    });
                                    $('#form_transaction').resetForm();
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

	$('#addTransaction').on('hidden.bs.modal', function(e){
            $(this).find('#myModalLabel').text('');
            $('.form-group').removeClass('has-error');
	});

	$('#addTransaction').on('show.bs.modal', function(relatedTarget){
            $(this).find('#myModalLabel').text( (!mode) ? 'Add Transaction' : 'Update Transaction' );
            if(mode == 1){
                console.log(relatedTarget);
            }
	});

});