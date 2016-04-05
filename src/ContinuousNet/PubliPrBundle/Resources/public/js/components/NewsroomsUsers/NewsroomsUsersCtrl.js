'use strict';

/**
 * Controller for Newsrooms Users Details
 */

app.controller('NewsroomsUsersCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$newsroomsUsersDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $newsroomsUsersDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.nogroup.newsroomsusers');
    };

    $scope.add = function() {
        $state.go('app.nogroup.newsroomsusersnew');
    };

    $scope.edit = function(row) {
        $state.go('app.nogroup.newsroomsusersedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $newsroomsUsersDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.newsroomsUsers = data;
        });
    }

}]);

