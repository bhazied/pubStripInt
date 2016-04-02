'use strict';

/**
 * Controller for Log Details
 */

app.controller('LogCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$logsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $logsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.accesscontrol.logs');
    };

    $scope.add = function() {
        $state.go('app.accesscontrol.logsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.accesscontrol.logsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $logsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.log = data;
        });
    }

}]);

