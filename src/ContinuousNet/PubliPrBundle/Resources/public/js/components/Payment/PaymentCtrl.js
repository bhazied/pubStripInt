'use strict';

/**
 * Controller for Payment Details
 */

app.controller('PaymentCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$paymentsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $paymentsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.billing.payments');
    };

    $scope.add = function() {
        $state.go('app.billing.paymentsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.billing.paymentsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $paymentsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.payment = data;
        });
    }

}]);

