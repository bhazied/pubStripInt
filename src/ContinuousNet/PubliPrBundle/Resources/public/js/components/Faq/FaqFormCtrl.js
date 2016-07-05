'use strict';

/**
 * Controller for Faq Form
 */

app.controller('FaqFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$creatorUsersDataFactory', '$modifierUsersDataFactory', '$faqsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $creatorUsersDataFactory, $modifierUsersDataFactory, $faqsDataFactory) {

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';

    $scope.disableSubmit = false;

    // Editor options.
    $scope.editorOptions = {
        language: $scope.locale,
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReadyEditor = function () {
        
    };


    $scope.creatorUsers = [];
    $scope.creatorUsersLoaded = false;

    $scope.getCreatorUsers = function() {
        $timeout(function(){
            $scope.creatorUsersLoaded = true;
            if ($scope.creatorUsers.length == 0) {
                $scope.creatorUsers.push({});
                var def = $q.defer();
                $creatorUsersDataFactory.query({offset: 0, limit: 10000, 'order_by[creatorUser.]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.creatorUsers = data.results;
                    def.resolve($scope.creatorUsers);
                });
                return def;
            } else {
                return $scope.creatorUsers;
            }
        });
    };

    $scope.getCreatorUsers();

    $scope.modifierUsers = [];
    $scope.modifierUsersLoaded = false;

    $scope.getModifierUsers = function() {
        $timeout(function(){
            $scope.modifierUsersLoaded = true;
            if ($scope.modifierUsers.length == 0) {
                $scope.modifierUsers.push({});
                var def = $q.defer();
                $modifierUsersDataFactory.query({offset: 0, limit: 10000, 'order_by[modifierUser.]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.modifierUsers = data.results;
                    def.resolve($scope.modifierUsers);
                });
                return def;
            } else {
                return $scope.modifierUsers;
            }
        });
    };

    $scope.getModifierUsers();



    $scope.submitForm = function(form) {
        var firstError = null;
        if (form.$invalid) {
            var field = null, firstError = null;
            for (field in form) {
                if (field[0] != '$') {
                    if (firstError === null && !form[field].$valid) {
                        firstError = form[field].$name;
                    }
                    if (form[field].$pristine) {
                        form[field].$dirty = true;
                    }
                }
            }
            angular.element('.ng-invalid[name=' + firstError + ']').focus();
            SweetAlert.swal($filter('translate')('content.form.messages.FORMCANNOTBESUBMITTED'), $filter('translate')('content.form.messages.ERRORSAREMARKED'), "error");
            return false;
        } else {
            if ($scope.faq.id > 0) {
                $scope.disableSubmit = true;
                $faqsDataFactory.update($scope.faq).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.FAQUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.FAQNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $faqsDataFactory.create($scope.faq).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.FAQCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.FAQNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.settings.faqs');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $faqsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.faq = savable(data);
            });
        });
    } else {
        $scope.faq = {id: 0};

    }

}]);

