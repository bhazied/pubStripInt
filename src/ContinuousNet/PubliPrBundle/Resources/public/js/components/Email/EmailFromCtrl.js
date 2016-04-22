'use strict';

/**
 * Controller for Email Form
 */

app.controller('EmailFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$pressReleasesDataFactory', '$contactsDataFactory', '$usersDataFactory', '$emailsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $pressReleasesDataFactory, $contactsDataFactory, $usersDataFactory, $emailsDataFactory) {

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

    $scope.sendingStatuses = [{
        id: 'Initialized',
        title: $filter('translate')('content.list.fields.sendingstatuses.INITIALIZED'),
        css: 'primary'
    }, {
        id: 'Sent',
        title: $filter('translate')('content.list.fields.sendingstatuses.SENT'),
        css: 'success'
    }, {
        id: 'Error',
        title: $filter('translate')('content.list.fields.sendingstatuses.ERROR'),
        css: 'warning'
    }];

    $scope.pressReleases = [];
    $scope.pressReleasesLoaded = false;

    $scope.getPressReleases = function() {
        $timeout(function(){
            $scope.pressReleasesLoaded = true;
            if ($scope.pressReleases.length == 0) {
                $scope.pressReleases.push({});
                var def = $q.defer();
                $pressReleasesDataFactory.query({offset: 0, limit: 10000, 'order_by[pressRelease.title]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.pressReleases = data.results;
                    def.resolve($scope.pressReleases);
                });
                return def;
            } else {
                return $scope.pressReleases;
            }
        });
    };

    $scope.getPressReleases();

    $scope.contacts = [];
    $scope.contactsLoaded = false;

    $scope.getContacts = function() {
        $timeout(function(){
            $scope.contactsLoaded = true;
            if ($scope.contacts.length == 0) {
                $scope.contacts.push({});
                var def = $q.defer();
                $contactsDataFactory.query({offset: 0, limit: 10000, 'order_by[contact.firstName]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.contacts = data.results;
                    def.resolve($scope.contacts);
                });
                return def;
            } else {
                return $scope.contacts;
            }
        });
    };

    $scope.getContacts();

    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $timeout(function(){
            $scope.usersLoaded = true;
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.username]': 'asc'}).$promise.then(function(data) {
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
            return false;
        } else {
            if ($scope.email.id > 0) {
                $scope.disableSubmit = true;
                $emailsDataFactory.update($scope.email).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.EMAILUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.EMAILNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $emailsDataFactory.create($scope.email).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.EMAILCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.EMAILNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.distribution.emails');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $emailsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.email = savable(data);
            });
        });
    } else {
        $scope.email = {id: 0, sending_status: 'Initialized'};

    }

}]);

