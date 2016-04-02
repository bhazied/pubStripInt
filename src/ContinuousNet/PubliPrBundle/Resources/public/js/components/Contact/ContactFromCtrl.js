'use strict';

/**
 * Controller for Contact Form
 */

app.controller('ContactFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$contactGroupsDataFactory', '$usersDataFactory', '$contactsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $contactGroupsDataFactory, $usersDataFactory, $contactsDataFactory) {

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


    $scope.unsubscribedAtOpened = false;
    $scope.unsubscribedAtToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.unsubscribedAtOpened = !$scope.unsubscribedAtOpened;
    };

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.dateTimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');
    $scope.minDate = new Date(2010, 0, 1);
    $scope.maxDate = new Date(2050, 11, 31);
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.disabled = function (date, mode) {
        return (mode === 'day' && (date.getDay() === -1));
    };
    $scope.contactGroups = [];
    $scope.contactGroupsLoaded = false;

    $scope.getContactGroups = function() {
        $timeout(function(){
            $scope.contactGroupsLoaded = true;
            if ($scope.contactGroups.length == 0) {
                $scope.contactGroups.push({});
                var def = $q.defer();
                $contactGroupsDataFactory.query({offset: 0, limit: 10000, 'order_by[contactGroup.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.contactGroups = data.results;
                    def.resolve($scope.contactGroups);
                });
                return def;
            } else {
                return $scope.contactGroups;
            }
        });
    };

    $scope.getContactGroups();

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
            if ($scope.contact.id > 0) {
                $contactsDataFactory.update($scope.contact).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.CONTACTUPDATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.CONTACTNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $contactsDataFactory.create($scope.contact).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.CONTACTCREATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.CONTACTNOTCREATED'));
                    console.warn(error);
                });
            }
        }
    };

    $scope.list = function() {
        $state.go('app.contactmanager.contacts');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $contactsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.contact = savable(data);
                //console.warn($scope.contact);
            });
        });
    } else {
        $scope.contact = {id: 0};

    }

}]);

