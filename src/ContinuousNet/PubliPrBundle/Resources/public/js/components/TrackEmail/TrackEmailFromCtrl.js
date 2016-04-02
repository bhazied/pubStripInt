'use strict';

/**
 * Controller for Track Email Form
 */

app.controller('TrackEmailFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$emailsDataFactory', '$usersDataFactory', '$trackEmailsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $emailsDataFactory, $usersDataFactory, $trackEmailsDataFactory) {

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';

    // Editor options.
    $scope.editorOptions = {
        language: $scope.locale,
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReadyEditor = function () {
        
    };

    $scope.actions = [{
        id: 'View',
        title: $filter('translate')('content.list.fields.actions.VIEW'),
        css: 'info'
    }, {
        id: 'Click',
        title: $filter('translate')('content.list.fields.actions.CLICK'),
        css: 'success'
    }];

    $scope.emails = [];
    $scope.emailsLoaded = false;

    $scope.getEmails = function() {
        $timeout(function(){
            $scope.emailsLoaded = true;
            if ($scope.emails.length == 0) {
                $scope.emails.push({});
                var def = $q.defer();
                $emailsDataFactory.query({offset: 0, limit: 10000, 'order_by[email.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.emails = data.results;
                    def.resolve($scope.emails);
                });
                return def;
            } else {
                return $scope.emails;
            }
        });
    };

    $scope.getEmails();

    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $timeout(function(){
            $scope.usersLoaded = true;
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.users = data.results;
                    def.resolve($scope.users);
                });
                return def;
            } else {
                return $scope.users;
            }
        });
    };

    $scope.getUsers();



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
            return;
        } else {
            if ($scope.trackEmail.id > 0) {
                $trackEmailsDataFactory.update($scope.trackEmail).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.TRACKEMAILUPDATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.TRACKEMAILNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $trackEmailsDataFactory.create($scope.trackEmail).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.TRACKEMAILCREATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.TRACKEMAILNOTCREATED'));
                    console.warn(error);
                });
            }
        }
    };

    $scope.list = function() {
        $state.go('app.statistics.trackemails');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $trackEmailsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.trackEmail = savable(data);
                //console.warn($scope.trackEmail);
            });
        });
    } else {
        $scope.trackEmail = {id: 0, action: 'View'};

    }

}]);

