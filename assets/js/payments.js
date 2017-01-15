$(document).ready(function(){

    var null_counter = 0;
    var current_payment = {};
    var next_payment = {};
	var confirm_payment = 0;
	var current_balance = 0;

    var calculated_current_payment = {
        amount_paid: 0,
        payment_balance: 0,
        running_balance: 0,
        actual_paid_date: ''
    };

    var calculated_next_payment = {
        due_amount: 0,
        running_balance: 0
    };

    $('input[name="payment_actual_paid_date"]').daterangepicker({
        singleDatePicker: true,
        locale:{
            format: 'YYYY-MM-DD'
        },
        parentEl: '#payment_form .modal-body'
    });

    $('#loan_table').on('click', '.view_loan_btn', function(){
        var loan_id = $(this).attr('loan-id');
		$('.payoff_div').hide();
		$('.payoff_information').attr('loan-id', loan_id);
        $.post($(this).attr('get-payment'), {id:loan_id}, function(response){
            var payments = JSON.parse(response);
			var last_balance = 0;
			$('input[name=payment-loan-id]').val(payments.data[0].loans_id);
            $.each(payments.data, function(index, payment_value){
                var duplicated_row = $('#view_loan_row_dummy').clone();
                $.each(payment_value, function(index, value){
                    var new_value = value;
                    if(index==='due_amount' || index==='amount_paid' || index==='payment_balance'){
                        var new_value = parseFloat(new_value);
                        if(new_value < 1){
                            new_value = $.number(('0'+new_value), 2);
                        }else{
							new_value = $.number(new_value, 2);
						}
                    }
					if(index==='running_balance'){
						if(new_value > 1){
							last_balance = new_value;
						}
						new_value = $.number(parseFloat(last_balance), 2);
					}
                    if(index==='id'){
                        duplicated_row.attr('payment-id', value);
                    }
                    if(index==='actual_paid_date' && null_counter<2){
                        if(null_counter===1){
                            $.extend(next_payment, payment_value);
                        }
                        if(!value){
                            if(null_counter===0){
                                $('#payment_id').val(payment_value.id);
                                duplicated_row.addClass('info');
                                $.extend(current_payment, payment_value);
                            }
                            null_counter++;
                        }
                    }
					if(index==='actual_paid_date' && !value){
						duplicated_row.find('#'+index).text('-');
					}else{
						duplicated_row.find('#'+index).text(new_value);
					}
                });
                duplicated_row.removeClass('hidden').addClass('view_loan_row');
                $('#view_loan_body').append(duplicated_row);
            });
        });
        null_counter=0;
        $('#viewloan').modal('show');
    });

    $('#viewloan').on('hidden.bs.modal', function(e){
        $('.view_loan_row').remove();
    });

    $('#viewloan').on('shown.bs.modal', function(e){
        $('#payment_form').resetForm();
    });

    $('#viewloan').on('click', '.confirm_payment', function(e){

        new PNotify({
                title: 'Confirmation Needed',
                text: 'Adding this payment cannot be undone. Are you sure?',
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
			var current_due_amount = $('#view_loan_body').find('.info').find('#due_amount').text();
			var payment_form = $('#payment_form');
			var payment_form_details = {
				'payment-loan-id': payment_form.find('input[name=payment-loan-id]').val(),
				'payment_amount_paid': payment_form.find('input[name=payment_amount_paid]').val(),
				'pay_amount': payment_form.find('input[name=pay_amount]').val(),
				'payment_actual_paid_date': payment_form.find('input[name=payment_actual_paid_date]').val(),
				'pay_date': payment_form.find('input[name=pay_date]').val(),
				'id': payment_form.find('input[name=id]').val(),
				'payment_payment_balance': payment_form.find('input[name=payment_payment_balance]').val(),
				'payment_running_balance': payment_form.find('input[name=payment_running_balance]').val(),
				'current_due_amount': $('#view_loan_body').find('.info').find('#due_amount').text()
			};
            $.post($('#payment_form').attr('add_payment'), payment_form_details, function(response){
                var data_response = JSON.parse(response);
                if(data_response.status){
                    new PNotify({
                        title:'Success!',
                        text:'Payment successfully added!',
                        type:"success",
                        delay:3000,
                        animation:"fade",
                        mobile:{swipe_dismiss:true,styling:true},
                        buttons:{closer:false,sticker:false},
                        desktop: {desktop: true,fallback: true}
                    });
                    var current_payment = $('#view_loan_body').find('tr.info');
                    current_payment.removeClass('info').next().addClass('info');
                    $('#payment_form').resetForm();
					$('#loan_body').find('#'+data_response.data.loans_id).find('#balance').text($.number(data_response.data.running_balance, 2));
					if(data_response.data.running_balance == '00.00'){
						$('#loan_body').find('#'+data_response.data.loans_id).addClass('zerobalance');
						$('#loan_body').find('#'+data_response.data.loans_id).find('button').prop('disabled', true);
					}
					$('#viewloan').modal('hide');
                }else{
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
            });
        }).on('pnotify.cancel', function(){
            return false;
        });

    });

    $('input[name=payment_actual_paid_date]').on('hide.daterangepicker', function(ev, picker){
        var selected_date = calculated_current_payment.actual_paid_date = ev.currentTarget.value;
        $('[payment-id='+current_payment.id+']').find('#actual_paid_date').text(selected_date);
    });

    $('input[name=payment_amount_paid]').blur(function(){
        var next_due_amount = 0;

		current_balance = $('#loan_body').find('#'+$('input[name=payment-loan-id]').val()).find('#balance').text();
		
        calculated_current_payment.amount_paid = parseFloat($(this).val().replace(/[₱ ]|[,]/g, ''));
        calculated_current_payment.payment_balance = $.number((parseFloat(current_payment.due_amount) - parseFloat(calculated_current_payment.amount_paid)), 2);
        calculated_current_payment.running_balance = $.number((parseFloat(current_payment.running_balance) - parseFloat(calculated_current_payment.amount_paid)), 2);
        calculated_current_payment.amount_paid = $.number(calculated_current_payment.amount_paid, 2);

        calculated_current_payment.payment_balance = (calculated_current_payment.payment_balance >= 0 && calculated_current_payment.payment_balance < 1) ? '0'+calculated_current_payment.payment_balance : calculated_current_payment.payment_balance;
        calculated_current_payment.running_balance = calculated_next_payment.running_balance = (calculated_current_payment.running_balance >= 0 && calculated_current_payment.running_balance < 1) ? '0'+calculated_current_payment.running_balance : calculated_current_payment.running_balance;

        $.each(calculated_current_payment, function(index, value){
            $('[payment-id='+current_payment.id+']').find('#'+index).text(value);
            if(index !== 'amount_paid'){
                $('input[name=payment_'+index+']').val(value);
            }
        });

        calculated_next_payment.due_amount = $.number((parseFloat(next_payment.due_amount)+parseFloat(calculated_current_payment.payment_balance)), 2);
        calculated_next_payment.due_amount = (calculated_next_payment.due_amount >= 0 && calculated_next_payment.due_amount < 1) ? '0'+calculated_next_payment.due_amount : calculated_next_payment.due_amount;
        $('[payment-id='+next_payment.id+']').find('#due_amount').text(calculated_next_payment.due_amount);
        $('[payment-id='+next_payment.id+']').find('#running_balance').text(calculated_next_payment.running_balance);
		
		$('[payment-id='+next_payment.id+']').nextAll().find('#due_amount').text(calculated_next_payment.due_amount);
        $('[payment-id='+next_payment.id+']').nextAll().find('#running_balance').text(calculated_next_payment.running_balance);
	});
    
    $('.payoff_div').hide();
    
    $('.modal-footer').on('click', '.payoff_information', function(){
        $('.payoff_div').toggle();
        if($('.payoff_div').css('display') === 'block'){
            $.post($('.payoff_information').attr('payoff_information_r'), {id:$('.payoff_information').attr('loan-id')}, function(response){
                var payoff_information = JSON.parse(response);
                $('.payoff_div h1 span').text($.number(payoff_information.data.payoff_amount, 2));
            });
        }
    });
    
    $('.radio').on('click', 'input[name=pay_amount]', function(){
        var loan_body = $('#view_loan_body');
        var due_amount = loan_body.find('tr.info').find('#due_amount').text();
        if($('input[name=pay_amount]').is(':checked')){
            if($(this).attr('id') === 'rad_due_amount'){
                $('#payment_amount_paid').val('₱ '+due_amount);
            }else{
                var btn_payoff = $('button[payoff_information_r]').attr('payoff_information_r');
                var btn_loan_id = $('button[payoff_information_r]').attr('loan-id');
                $.post(btn_payoff, {id:btn_loan_id}, function(response){
                    var payoff_information_amount = JSON.parse(response).data.payoff_amount;
                    $('#payment_amount_paid').val('₱ '+$.number(payoff_information_amount, 2));
                });
            }
        }
        $('#payment_amount_paid').trigger('blur');
    });
    
    $('.radio').on('click', 'input[name=pay_date]', function(){
        var loan_body = $('#view_loan_body');
        var due_date = loan_body.find('tr.info').find('#due_date').text();
        if($('input[name=pay_date]').is(':checked')){
            if($(this).attr('id') === 'rad_due_date'){
                $('#payment_actual_paid_date').val(due_date);
                $('[payment-id='+loan_body.find('tr.info').attr('payment-id')+']').find('#actual_paid_date').text(due_date);
            }else{
                var d = new Date();
                var strDate = d.getFullYear() + "-" + ( ((d.getMonth()+1) < 10) ? (''+d.getMonth()+1) : (d.getMonth()+1) ) + "-" + ( (d.getDate() < 10) ? ('0'+d.getDate()) : d.getDate() );
                $('#payment_actual_paid_date').val(strDate);
                $('[payment-id='+loan_body.find('tr.info').attr('payment-id')+']').find('#actual_paid_date').text(strDate);
            }
        }
    });

});