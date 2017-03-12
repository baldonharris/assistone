$(document).ready(function(){
    $('#effectivity_date').daterangepicker({
        singleDatePicker: true,
        locale:{
            format: 'YYYY-MM-DD'
        },
        parentEl: 'div.x_content'
	});
});

assistone.controller('adminController', function($scope, $http){        
    $scope.master_percentages = [];
    $scope.zero_master_percentages = true;
    
    $scope.$watch('base_url', function(){
        $http({ // get due dates
            method: "POST",
            url: $scope.base_url+'payments/get_payment',
        }).then(function(response){
            console.log(response);
            $scope.due_dates = response.data.data;
        });
    });
    
    $scope.add_percentage = function(){
        $scope.zero_master_percentages = false;
        $scope.master_percentages.push({
            subject: '',
            bucket: ''
        });
    };
    
    $scope.remove_percentage = function(index){
        $scope.master_percentages.splice(index, 1);
        if($scope.master_percentages.length === 0){
            $scope.zero_master_percentages = true;
        }
        console.log($scope.master_percentages);
    };
    
    $scope.push_percentages = function(){
        console.log($scope.master_percentages);
    };
});