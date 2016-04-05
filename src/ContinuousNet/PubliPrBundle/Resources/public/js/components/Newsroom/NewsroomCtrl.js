'use strict';

/**
 * Controller for Newsroom Details
 */

app.controller('NewsroomCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$newsroomsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $newsroomsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.settings.newsrooms');
    };

    $scope.add = function() {
        $state.go('app.settings.newsroomsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.newsroomsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $newsroomsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.newsroom = data;
        });
    }

}]);

