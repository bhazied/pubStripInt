'use strict';

/**
 * Controller for Faqs List
 */

app.controller('FaqsShowAllCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$faqsDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $faqsDataFactory) {

        $scope.faqs = [];
        $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
        $scope.currentPage = 1;
        $scope.numPerPage = 10;
        $scope.maxSize = 5;
        $scope.totalItems = 0;
        $scope.faqLoaded = false;
        $scope.getAllFaqs = function () {
            $scope.faqLoaded = true;
            var def = $q.defer();
            var http_params = {
                limit  : $scope.numPerPage,
                offset : ($scope.currentPage - 1) * $scope.numPerPage
            };
            //if($scope.faqs.length == 0){
                $scope.faqs.push({});
                $faqsDataFactory.get(http_params).$promise.then(function (data) {
                    $scope.faqs = data.results;
                    $scope.totalItems = data.inlineCount;
                });
                def.resolve($scope.faqs);
                return def;
            //}
        }

        $scope.changePage = function () {
            $scope.faqs.push({});
            $scope.getAllFaqs();
        }
        $scope.getAllFaqs();
    }]);

