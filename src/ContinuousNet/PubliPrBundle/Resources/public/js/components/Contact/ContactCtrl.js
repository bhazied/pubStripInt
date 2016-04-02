'use strict';

/**
 * Controller for Contact Details
 */

app.controller('ContactCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$contactsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $contactsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.contactmanager.contacts');
    };

    $scope.add = function() {
        $state.go('app.contactmanager.contactsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.contactmanager.contactsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $contactsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.contact = data;
        });
    }

}]);

