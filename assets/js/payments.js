$(document).ready(function(){

    var null_counter = 0;
    var current_payment = {};
    var next_payment = {};

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
        $('.payoff_div').hide();
        $.post($(this).attr('get-payment'), {id:$(this).attr('loan-id')}, function(response){
            var payments = JSON.parse(response);
            console.log(payments);
            $.each(payments.data, function(index, payment_value){
                var duplicated_row = $('#view_loan_row_dummy').clone();
                $.each(payment_value, function(index, value){
                    var new_value = value;
                    if(index=='due_amount' || index=='amount_paid' || index=='payment_balance' || index=='running_balance'){
                        var new_value = $.number(parseFloat(new_value), 2);
                        if(new_value < 1){
                            new_value = '0'+new_value;
                        }
                    }
                    if(index=='id'){
                        duplicated_row.attr('payment-id', value);
                    }
                    if(index=='actual_paid_date' && null_counter<2){
                        if(null_counter==1){
                            $.extend(next_payment, payment_value);
                        }
                        if(!value){
                            if(null_counter==0){
                                $('#payment_id').val(payment_value.id);
                                duplicated_row.addClass('info');
                                $.extend(current_payment, payment_value);
                            }
                            null_counter++;
                        }
                    }
                    duplicated_row.find('#'+index).text(new_value);
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
            $.post($('#payment_form').attr('add_payment'), $('#payment_form').serialize(), function(data){
                console.log("hi");
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

        calculated_current_payment.amount_paid = parseFloat($(this).val().replace(/[₱ ]|[,]/g, ''));
        calculated_current_payment.payment_balance = $.number((parseFloat(current_payment.due_amount) - parseFloat(calculated_current_payment.amount_paid)), 2);
        calculated_current_payment.running_balance = $.number((parseFloat(current_payment.running_balance) - parseFloat(calculated_current_payment.amount_paid)), 2);
        calculated_current_payment.amount_paid = $.number(calculated_current_payment.amount_paid, 2);

        calculated_current_payment.payment_balance = (calculated_current_payment.payment_balance >= 0 && calculated_current_payment.payment_balance < 1) ? '0'+calculated_current_payment.payment_balance : calculated_current_payment.payment_balance;
        calculated_current_payment.running_balance = calculated_next_payment.running_balance = (calculated_current_payment.running_balance >= 0 && calculated_current_payment.running_balance < 1) ? '0'+calculated_current_payment.running_balance : calculated_current_payment.running_balance;

        $.each(calculated_current_payment, function(index, value){
                $('[payment-id='+current_payment.id+']').find('#'+index).text(value);
                if(index != 'amount_paid'){
                        $('input[name=payment_'+index+']').val(value);
                }
        });

        calculated_next_payment.due_amount = $.number((parseFloat(next_payment.due_amount)+parseFloat(calculated_current_payment.payment_balance)), 2);
        calculated_next_payment.due_amount = (calculated_next_payment.due_amount >= 0 && calculated_next_payment.due_amount < 1) ? '0'+calculated_next_payment.due_amount : calculated_next_payment.due_amount;
        $('[payment-id='+next_payment.id+']').find('#due_amount').text(calculated_next_payment.due_amount);
        $('[payment-id='+next_payment.id+']').find('#running_balance').text(calculated_next_payment.running_balance);
    });
    
    var opencounter = 0;
    $('.payoff_div').hide();
    
    $('.modal-footer').on('click', '.payoff_information', function(){
        $('.payoff_div').toggle();
    });

});