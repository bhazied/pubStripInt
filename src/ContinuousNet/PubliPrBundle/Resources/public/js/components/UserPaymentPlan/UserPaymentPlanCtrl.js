'use strict';

/**
 * Controller for User Payment Plan Details
 */

app.controller('UserPaymentPlanCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$userPaymentPlansDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $userPaymentPlansDataFactory) {

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
        $state.go('app.billing.userpaymentplans');
    };

    $scope.add = function() {
        $state.go('app.billing.userpaymentplansnew');
    };

    $scope.edit = function(row) {
        $state.go('app.billing.userpaymentplansedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $userPaymentPlansDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.userPaymentPlan = data;
        });
    }

}]);

