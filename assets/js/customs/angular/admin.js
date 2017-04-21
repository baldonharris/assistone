$(document).ready(function () {
    $('#effectivity_date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        parentEl: 'div.x_content'
    });
});

function isEmpty(value) {
    return (value === null || value === '');
}

assistone.controller('adminController', function ($scope, $http) {
    $scope.master_percentages = [];
    $scope.zero_master_percentages = true;
    $scope.buckets = [];
    $scope.effectivity_date_set = '';

    $scope.$watch('base_url', function () {
        $http({
            method: "POST",
            url: $scope.base_url + 'admin/get_effectivities',
            headers: {
                'Content-Type': 'application/x-www-form-url-urlencoded'
            }
        }).then(function (success) {
            $scope.effectivities = angular.copy(success.data, $scope.effectivities);
        });

        $scope.save_bucket = function () {
            var error_counter = 0;
            if ($scope.master_percentages.length === 0) {
                error_counter++;
            } else {
                var total_percentage = 0;
                /* start check empty bucket */
                for (var x = 0; x < $scope.master_percentages.length; x++) {
                    var bucket = $scope.master_percentages[x];
                    if (isEmpty(bucket.bucket_name) || isEmpty(bucket.percentage)) {
                        error_counter++;
                        break;
                    }
                    total_percentage += parseFloat(bucket.percentage);
                }

                /* start check total percentage */
                if (total_percentage !== 100) {
                    error_counter++;
                }

                /* start check effectivity date */
                if (isEmpty($scope.effectivity_date)) {
                    error_counter++;
                } else {
                    var exploded_ed = $scope.effectivity_date.split("-");
                    var now_date = new Date();
                    var ed = new Date(parseInt(exploded_ed[0]), parseInt(exploded_ed[1]) - 1, parseInt(exploded_ed[2]), now_date.getHours(), now_date.getMinutes(), now_date.getSeconds(), now_date.getMilliseconds());
                    if (ed < now_date) {
                        error_counter++;
                    }
                }
            }
            if (error_counter) {
                pnotify('Oh no!', 'An error has occured!', 'error');
            } else {
                $http({
                    method: "POST",
                    url: $scope.base_url + 'admin/save_bucket',
                    data: $.param({
                        effectivity_date: $scope.effectivity_date,
                        buckets: $scope.master_percentages
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function (success) {
                    $scope.effectivities = angular.copy(success.data, $scope.effectivities);
                    $('#add_effectivity_modal').modal('hide');
                    $scope.master_percentages = angular.copy([], $scope.master_percentages);
                    $scope.zero_master_percentages = true;
                    pnotify('Success!', 'Buckets successfully added!', 'success');
                });
            }
            error_counter = 0;
        };
    });

    $scope.add_percentage = function () {
        $scope.zero_master_percentages = false;
        $scope.master_percentages.push({
            percentage: '',
            bucket_name: ''
        });
    };

    $scope.remove_percentage = function (index) {
        $scope.master_percentages.splice(index, 1);
        if ($scope.master_percentages.length === 0) {
            $scope.zero_master_percentages = true;
        }
    };

    $scope.get_buckets = function (index) {
        $('#view_buckets_modal').modal('show');
        $scope.buckets = angular.copy($scope.effectivities[index].buckets, $scope.buckets);
        console.log($scope.effectivities[index]);
        $scope.effectivity_date_set = $scope.effectivities[index].effectivity_date;
    };

    $scope.launch_modal = function () {
        $('#add_effectivity_modal').modal('show');
    };
});
