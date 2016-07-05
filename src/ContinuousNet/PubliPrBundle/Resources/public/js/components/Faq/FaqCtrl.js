'use strict';

/**
 * Controller for Faq Details
 */

app.controller('FaqCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$faqsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $faqsDataFactory) {


    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.settings.faqs');
    };

    $scope.add = function() {
        $state.go('app.settings.faqsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.faqsedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $faqsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.faq = data;
        });
    }

}]);

