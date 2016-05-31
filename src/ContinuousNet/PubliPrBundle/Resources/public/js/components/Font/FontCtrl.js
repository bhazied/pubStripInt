'use strict';

/**
 * Controller for Font Details
 */

app.controller('FontCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$fontsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $fontsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.templatemanager.fonts');
    };

    $scope.add = function() {
        $state.go('app.templatemanager.fontsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.templatemanager.fontsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $fontsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.font = data;
        });
    }

}]);

