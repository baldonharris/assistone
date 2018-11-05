Chart.defaults.global.scaleLabel = function (label) {
    return '₱ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

assistone.controller('homeController', function ($scope, $http) {
    $scope.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $scope.series = ['Investments', 'Released Loans', 'Returns'];
    $scope.datasetOverride = [
        {
            label: "Investments",
            borderWidth: 3,
            type: 'line'
        },
        {
            label: "Released Loans",
            borderWidth: 3,
            type: 'line'
        },
        {
            label: "Returns",
            borderWidth: 3,
            type: 'line'
        },
    ];
    $scope.options = {
        multiTooltipTemplate: function (label) {
            return label.datasetLabel + ': ₱ ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    };

    $scope.$watch('base_url', function () {
        $http({
            method: "POST",
            url: $scope.base_url + 'home/init_data'
        }).then(function (success) {
            $scope.current_loan_reservation_amount = success.data.current_loan_reservation_amount;
            $scope.expired_loan_reservation_amount = success.data.expired_loan_reservation_amount;
            $scope.total_cash_on_hand = success.data.total_cash_on_hand;
            $scope.graph_data = [
                success.data.transaction_summary,
                success.data.approved_loans_summary,
                success.data.returns_summary,
            ];
        });
    });
});
