'use strict';

/**
 * Controller for Setting Details
 */

app.controller('SettingCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$settingsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $settingsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.access.settings');
    };

    $scope.add = function() {
        $state.go('app.access.settingsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.access.settingsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $settingsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.setting = data;
        });
    }

}]);

