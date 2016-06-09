'use strict';

/**
 * Controller for Payment Plan Details
 */

app.controller('PaymentPlanCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$paymentPlansDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $paymentPlansDataFactory) {

    $scope.statuses = [{
        id: 'Active',
        title: $filter('translate')('content.list.fields.statuses.ACTIVE'),
        css: 'primary'
    }, {
        id: 'Disabled',
        title: $filter('translate')('content.list.fields.statuses.DISABLED'),
        css: 'success'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.billing.paymentplans');
    };

    $scope.add = function() {
        $state.go('app.billing.paymentplansnew');
    };

    $scope.edit = function(row) {
        $state.go('app.billing.paymentplansedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $paymentPlansDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.paymentPlan = data;
        });
    }
    
    

}]);

