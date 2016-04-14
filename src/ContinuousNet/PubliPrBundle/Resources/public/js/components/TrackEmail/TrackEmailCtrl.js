'use strict';

/**
 * Controller for Track Email Details
 */

app.controller('TrackEmailCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$trackEmailsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $trackEmailsDataFactory) {

    $scope.actions = [{
        id: 'View',
        title: $filter('translate')('content.list.fields.actions.VIEW'),
        css: 'primary'
    }, {
        id: 'Click',
        title: $filter('translate')('content.list.fields.actions.CLICK'),
        css: 'success'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.statistics.trackemails');
    };

    $scope.add = function() {
        $state.go('app.statistics.trackemailsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.statistics.trackemailsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $trackEmailsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.trackEmail = data;
        });
    }

}]);

