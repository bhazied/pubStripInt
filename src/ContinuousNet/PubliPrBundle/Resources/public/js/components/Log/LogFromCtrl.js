'use strict';

/**
 * Controller for Log Form
 */

app.controller('LogFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$sessionsDataFactory', '$usersDataFactory', '$logsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $sessionsDataFactory, $usersDataFactory, $logsDataFactory) {

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


    $scope.sessions = [];
    $scope.sessionsLoaded = false;

    $scope.getSessions = function() {
        $timeout(function(){
            $scope.sessionsLoaded = true;
            if ($scope.sessions.length == 0) {
                $scope.sessions.push({});
                var def = $q.defer();
                $sessionsDataFactory.query({offset: 0, limit: 10000, 'order_by[session.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.sessions = data.results;
                    def.resolve($scope.sessions);
                });
                return def;
            } else {
                return $scope.sessions;
            }
        });
    };

    $scope.getSessions();

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
            if ($scope.log.id > 0) {
                $logsDataFactory.update($scope.log).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.LOGUPDATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.LOGNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $logsDataFactory.create($scope.log).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.LOGCREATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.LOGNOTCREATED'));
                    console.warn(error);
                });
            }
        }
    };

    $scope.list = function() {
        $state.go('app.accesscontrol.logs');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $logsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.log = savable(data);
                //console.warn($scope.log);
            });
        });
    } else {
        $scope.log = {id: 0};

    }

}]);

