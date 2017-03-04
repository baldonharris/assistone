$(document).ready(function(){
    $('input[name="in-loan-date-range"]').daterangepicker({
        "opens": "left"
    }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
});

var getInitRangeDate = function(){
    var date_now = (new Date()).getMonth()+'/'+(new Date()).getDay()+'/'+(new Date()).getFullYear();
    return date_now+' - '+date_now;
};

assistone.controller('collectionStatementController', function($scope, $http){
    $scope.$watch('get_url', function(){
        $scope.get_url_catcher = $scope.get_url;
        $http({
            method: "POST",
            url: $scope.get_url_catcher,
        }).then(function mySuccess(response){
            $scope.collection_statement = response.data.data;
        });
    });
    
    $scope.in_loan_date_range = getInitRangeDate();
    
});