'use strict';

/**
 * Controller for Email Campaign Form
 */

app.controller('EmailCampaignFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$pressReleasesDataFactory', '$usersDataFactory', '$emailCampaignsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $pressReleasesDataFactory, $usersDataFactory, $emailCampaignsDataFactory) {

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


    $scope.sendingDateTimeOpened = false;
    $scope.sendingDateTimeToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.sendingDateTimeOpened = !$scope.sendingDateTimeOpened;
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
    $scope.pressReleases = [];
    $scope.pressReleasesLoaded = false;

    $scope.getPressReleases = function() {
        $timeout(function(){
            $scope.pressReleasesLoaded = true;
            if ($scope.pressReleases.length == 0) {
                $scope.pressReleases.push({});
                var def = $q.defer();
                $pressReleasesDataFactory.query({offset: 0, limit: 10000, 'order_by[pressRelease.id]': 'desc'}).$promise.then(function(data) {
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
            return false;
        } else {
            if ($scope.emailCampaign.id > 0) {
                $scope.disableSubmit = true;
                $emailCampaignsDataFactory.update($scope.emailCampaign).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.EMAILCAMPAIGNUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.EMAILCAMPAIGNNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $emailCampaignsDataFactory.create($scope.emailCampaign).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.EMAILCAMPAIGNCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.EMAILCAMPAIGNNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.distribution.emailcampaigns');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $emailCampaignsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.emailCampaign = savable(data);
                if ($scope.emailCampaign.sending_date_time != null) {
                    $scope.emailCampaign.sending_date_time = new Date($scope.emailCampaign.sending_date_time);
                }
            });
        });
    } else {
        $scope.emailCampaign = {id: 0};

    }

}]);

