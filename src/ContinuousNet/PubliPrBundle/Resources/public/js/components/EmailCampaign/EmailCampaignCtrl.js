'use strict';

/**
 * Controller for Email Campaign Details
 */

app.controller('EmailCampaignCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$emailCampaignsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $emailCampaignsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.distribution.emailcampaigns');
    };

    $scope.add = function() {
        $state.go('app.distribution.emailcampaignsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.distribution.emailcampaignsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $emailCampaignsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.emailCampaign = data;
        });
    }

}]);

