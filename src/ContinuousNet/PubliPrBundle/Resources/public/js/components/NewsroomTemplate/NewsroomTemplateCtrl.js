'use strict';

/**
 * Controller for Newsroom Template Details
 */

app.controller('NewsroomTemplateCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$newsroomTemplatesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $newsroomTemplatesDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.settings.newsroomtemplates');
    };

    $scope.add = function() {
        $state.go('app.settings.newsroomtemplatesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.newsroomtemplatesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $newsroomTemplatesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.newsroomTemplate = data;
        });
    }

}]);

