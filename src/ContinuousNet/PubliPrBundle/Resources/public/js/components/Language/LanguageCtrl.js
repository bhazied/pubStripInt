'use strict';

/**
 * Controller for Language Details
 */

app.controller('LanguageCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$languagesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $languagesDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.settings.languages');
    };

    $scope.add = function() {
        $state.go('app.settings.languagesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.languagesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $languagesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.language = data;
        });
    }

}]);

