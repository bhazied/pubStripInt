'use strict';

/**
 * Controller for Country Details
 */

app.controller('CountryCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$countriesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $countriesDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.configuration.countries');
    };

    $scope.add = function() {
        $state.go('app.configuration.countriesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.configuration.countriesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $countriesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.country = data;
        });
    }

}]);

