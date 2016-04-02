'use strict';

/**
 * Controller for Session Details
 */

app.controller('SessionCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$sessionsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $sessionsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.accesscontrol.sessions');
    };

    $scope.add = function() {
        $state.go('app.accesscontrol.sessionsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.accesscontrol.sessionsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $sessionsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.session = data;
        });
    }

}]);

