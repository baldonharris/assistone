$(document).ready(function(){
    $('input[name="in-loan-date-range"]').daterangepicker({
        "opens": "left"
    }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
});

var getInitRangeDate = function(){
    var date = new Date();
    var date_now = date.getMonth()+1+'/'+date.getDate()+'/'+date.getFullYear();
    return date_now+' - '+date_now;
};

assistone.controller('collectionStatementController', function($scope, $http){
    $scope.in_loan_date_range = getInitRangeDate();
    $scope.$watch('base_url', function(){
        $scope.loans();
        $http({ // get due dates
            method: "POST",
            url: $scope.base_url+'payments/get_payment',
        }).then(function(response){
            $scope.due_dates = response.data.data;
        });
    });
    
    $scope.loans = function(){
        $scope.selected_due_date = null;
        if(typeof $scope.model_due_date_option === 'object'){ // this condition is for model_due_date_option. at init, this var is undefined.
            $scope.selected_due_date = $scope.model_due_date_option.due_date;
        }else{
            var today = new Date();
            var last_day_of_month = (new Date(today.getFullYear(), today.getMonth()+1, 0)).getDate();
            if(today.getDate() < 15){
                if(today.getDate() >= 11){
                    $scope.selected_due_date = today.getFullYear()+'-'+( ((today.getMonth()+1) < 10) ? '0'+(today.getMonth()+1) : (today.getMonth()+1) )+'-15';
                }else{
                    var prev_month = (today.getMonth() === 0) ? 12 : today.getMonth();
                    var prev_year = (today.getMonth() === 0) ? (today.getFullYear()-1) : today.getFullYear();
                    var prev_last_day_of_month = (new Date(prev_year, prev_month, 0)).getDate();
                    $scope.selected_due_date = prev_year+'-'+( (prev_month < 10) ? '0'+prev_month : prev_month )+'-'+( (prev_last_day_of_month < 10) ? '0'+prev_last_day_of_month : prev_last_day_of_month );
                }
            }else{ // today.getDate() is >= 15
                if(today.getDate() >= (last_day_of_month-4) && today.getDate() <= last_day_of_month){
                    $scope.selected_due_date = today.getFullYear()+'-'+ ( ((today.getMonth()+1) < 10) ? '0'+(today.getMonth()+1) : (today.getMonth()+1) ) +'-'+last_day_of_month;
                }else{
                    $scope.selected_due_date = today.getFullYear()+'-'+( ((today.getMonth()+1) < 10) ? '0'+(today.getMonth()+1) : (today.getMonth()+1) )+'-15';
                }
            }
        }
        $http({
            method: "POST",
            url: $scope.base_url+'reports/get_collection_statement',
            data: $.param({
                due_date: $scope.selected_due_date
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response){
            $scope.collection_statement = response.data.data.data;
            console.log(response);
            $scope.total_amounts = response.data.data.sub_detail;
        });
    };
});