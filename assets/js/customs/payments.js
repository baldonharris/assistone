$(document).ready(function(){

    var null_counter = 0;
    var current_payment = {};
    var next_payment = {};
	var confirm_payment = 0;
	var current_balance = 0;
    var clicked_view_loan_button;
    var payment_id_to_be_paid = 0;

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
        $('#viewloan').trigger('hidden.bs.modal');
        $('#viewloan').trigger('shown.bs.modal');
        clicked_view_loan_button = this;
        var loan_id = $(this).attr('loan-id');
		$('.payoff_div').hide();
		$('.payoff_information').attr('loan-id', loan_id);
        $.post($(this).attr('get-payment'), {id:loan_id}, function(response){
            var payments = JSON.parse(response);
			var last_balance = 0;

			console.log(payments.data);

			$('input[name=payment-loan-id]').val(payments.data[0].loans_id);
			for (var index in payments.data) {
			    if (payments.data.hasOwnProperty(index)) {
                    var payment_value = payments.data[index];
                    var duplicated_row = $('#view_loan_row_dummy').clone();

                    for (var column in payment_value) {
                        if (payment_value.hasOwnProperty(column)) {
                            var value = payment_value[column];
                            var new_value = 'due_amount amount_paid payment_balance running_balance'.indexOf(column) > -1 ? $.number(value, 2) : value;
                            var parsedIndex = Number(index);
                            var trueLength = payments.data.length - 1;

                            if (column === 'actual_paid_date' && value === null && last_balance === 0 && ((parsedIndex !== trueLength) || (parsedIndex === trueLength))) {
                                var new_index = parsedIndex === 0 || parsedIndex === trueLength ? parsedIndex : (parsedIndex - 1);
                                
                                last_balance = parseFloat(payments.data[new_index]['running_balance']);
                                payment_id_to_be_paid = Number(payment_value['id']);
                                current_payment = payment_value;
                                duplicated_row.addClass('info');
                            }

                            if (column === 'running_balance' && last_balance > 0) {
                                new_value = $.number(last_balance, 2);
                            }

                            duplicated_row.removeAttr('id');
                            duplicated_row.attr('payment-id', payment_value['id']);
                            duplicated_row.find(`#${ column }`).text(new_value || '-');
                        }
                    }
                    duplicated_row.removeClass('hidden').addClass('view_loan_row');
                    $('#view_loan_body').append(duplicated_row);
                }
            }

            var $paymentInput = $('#viewloan').find('.modal-body > .row');
            var $paymentBtns = $('#viewloan').find('.modal-footer button:not(:last-of-type)');

            /* Thug life one-liner */
            $paymentInput[last_balance === 0 ? 'addClass' : 'removeClass']('hidden');
            $paymentBtns[last_balance === 0 ? 'addClass' : 'removeClass']('hidden');
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
				'id': payment_id_to_be_paid,
				'payment_payment_balance': payment_form.find('input[name=payment_payment_balance]').val(),
				'payment_running_balance': payment_form.find('input[name=payment_running_balance]').val(),
				'current_due_amount': $('#view_loan_body').find('.info').find('#due_amount').text()
			};
            $.post($('#payment_form').attr('add_payment'), payment_form_details, function(response){
                var data_response = JSON.parse(response);

                console.log(data_response.data);
                if(data_response.status){
                    pnotify('Success!', 'Payment successfully added!', 'success');
                    var current_payment = $('#view_loan_body').find('tr.info');
                    current_payment.removeClass('info').next().addClass('info');
                    $('#payment_form').resetForm();
					$('#loan_body').find('#'+data_response.data.loans_id).find('#balance').text($.number(data_response.data.running_balance, 2));
					if(data_response.data.running_balance == '00.00'){
						$('#loan_body').find('#'+data_response.data.loans_id).addClass('zerobalance');
						$('#loan_body').find('#'+data_response.data.loans_id).find('button').prop('');
						$('#viewloan').modal('hide');
					}
                    // $(clicked_view_loan_button).trigger('click');
					$('#viewloan').modal('hide');
                }else{
                    pnotify('Oh no!', 'An error has occured!', 'error');
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
        var $loan_body = $('#view_loan_body');
        var $current_payment = $loan_body.find('.info');
        var $amount_paid = $($current_payment.find('#amount_paid'));
        var current_balance = $current_payment.find('#running_balance').text().replace(/[₱ ]|[,]/g, '');
        var amount_paid = $(this).val().replace(/[₱ ]|[,]/g, '');
        var new_balance = current_balance - amount_paid;
        var $next_payments = $current_payment.nextAll();

        $amount_paid.text($.number(amount_paid, 2));
        $current_payment.find('#running_balance').text($.number(new_balance, 2));
        for (var index = 0; index < $next_payments.length; index++) {
            var next_payment = $next_payments[index];

            $(next_payment).find('#running_balance').text($.number(new_balance, 2));
        }
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

        var $payment_amount_paid = $('#payment_amount_paid');

        if($('input[name=pay_amount]').is(':checked')){
            if($(this).attr('id') === 'rad_due_amount'){
                $payment_amount_paid.val('₱ '+due_amount);
            }else{
                var btn_payoff = $('button[payoff_information_r]').attr('payoff_information_r');
                var btn_loan_id = $('button[payoff_information_r]').attr('loan-id');
                $.post(btn_payoff, {id:btn_loan_id}, function(response){
                    var payoff_information_amount = JSON.parse(response).data.payoff_amount;
                    $('#payment_amount_paid').val('₱ '+$.number(payoff_information_amount, 2));
                });
            }
        }
        $payment_amount_paid.trigger('blur');
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
                var strDate = d.getFullYear() + "-" + ( ((d.getMonth()+1) < 10) ? ("0"+(d.getMonth()+1)) : (d.getMonth()+1) ) + "-" + ( ((d.getDate()) < 10) ? ("0"+(d.getDate())) : (d.getDate()) );
                $('#payment_actual_paid_date').val(strDate);
                $('[payment-id='+loan_body.find('tr.info').attr('payment-id')+']').find('#actual_paid_date').text(strDate);
            }
        }
    });

});

