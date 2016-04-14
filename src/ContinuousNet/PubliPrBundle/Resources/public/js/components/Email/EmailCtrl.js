'use strict';

/**
 * Controller for Email Details
 */

app.controller('EmailCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$emailsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $emailsDataFactory) {

    $scope.sendingStatuses = [{
        id: 'Initialized',
        title: $filter('translate')('content.list.fields.sendingstatuses.INITIALIZED'),
        css: 'primary'
    }, {
        id: 'Sent',
        title: $filter('translate')('content.list.fields.sendingstatuses.SENT'),
        css: 'success'
    }, {
        id: 'Error',
        title: $filter('translate')('content.list.fields.sendingstatuses.ERROR'),
        css: 'warning'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.distribution.emails');
    };

    $scope.add = function() {
        $state.go('app.distribution.emailsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.distribution.emailsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $emailsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.email = data;
        });
    }

}]);

