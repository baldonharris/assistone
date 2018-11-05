assistone.controller('fundsController', function ($scope, $http) {
    $scope.buckets = [];

    $scope.$watch('base_url', function () {
        $http({
            method: 'POST',
            url: $scope.base_url + 'funds/init_data'
        }).then(function (response) {
            $scope.buckets = response.data;
        });
    });

    $scope.returns = function (index) {
        console.log($scope.buckets[index]);
    };
});
