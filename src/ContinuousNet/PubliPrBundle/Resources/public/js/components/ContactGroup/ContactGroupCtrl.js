'use strict';

/**
 * Controller for Contact Group Details
 */

app.controller('ContactGroupCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$contactGroupsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $contactGroupsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.contactmanager.contactgroups');
    };

    $scope.add = function() {
        $state.go('app.contactmanager.contactgroupsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.contactmanager.contactgroupsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $contactGroupsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.contactGroup = data;
        });
    }

}]);

