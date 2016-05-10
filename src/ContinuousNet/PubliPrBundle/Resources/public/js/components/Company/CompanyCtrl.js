'use strict';

/**
 * Controller for Company Details
 */

app.controller('CompanyCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$companiesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $companiesDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.access.companies');
    };

    $scope.add = function() {
        $state.go('app.access.companiesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.access.companiesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $companiesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.company = data;
        });
    }

}]);

