'use strict';

/**
 * Controller for Track Press Release Details
 */

app.controller('TrackPressReleaseCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$trackPressReleasesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $trackPressReleasesDataFactory) {

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
        $state.go('app.statistics.trackpressreleases');
    };

    $scope.add = function() {
        $state.go('app.statistics.trackpressreleasesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.statistics.trackpressreleasesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $trackPressReleasesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.trackPressRelease = data;
        });
    }

}]);

