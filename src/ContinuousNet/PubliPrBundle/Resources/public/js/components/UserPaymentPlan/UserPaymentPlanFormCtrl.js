'use strict';

/**
 * Controller for User Payment Plan Form
 */

app.controller('UserPaymentPlanFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$usersDataFactory', '$paymentPlansDataFactory', '$userPaymentPlansDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $usersDataFactory, $paymentPlansDataFactory, $userPaymentPlansDataFactory) {

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

    $scope.statuses = [{
        id: 'Active',
        title: $filter('translate')('content.list.fields.statuses.ACTIVE'),
        css: 'primary'
    }, {
        id: 'Disabled',
        title: $filter('translate')('content.list.fields.statuses.DISABLED'),
        css: 'success'
    }];

    $scope.closeDateOpened = false;
    $scope.closeDateToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.closeDateOpened = !$scope.closeDateOpened;
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

    $scope.paymentPlans = [];
    $scope.paymentPlansLoaded = false;

    $scope.getPaymentPlans = function() {
        $timeout(function(){
            $scope.paymentPlansLoaded = true;
            if ($scope.paymentPlans.length == 0) {
                $scope.paymentPlans.push({});
                var def = $q.defer();
                $paymentPlansDataFactory.query({offset: 0, limit: 10000, 'order_by[paymentPlan.name]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.paymentPlans = data.results;
                    def.resolve($scope.paymentPlans);
                });
                return def;
            } else {
                return $scope.paymentPlans;
            }
        });
    };

    $scope.getPaymentPlans();



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
            if ($scope.userPaymentPlan.id > 0) {
                $scope.disableSubmit = true;
                $userPaymentPlansDataFactory.update($scope.userPaymentPlan).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.USERPAYMENTPLANUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.USERPAYMENTPLANNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $userPaymentPlansDataFactory.create($scope.userPaymentPlan).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.USERPAYMENTPLANCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.USERPAYMENTPLANNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.billing.userpaymentplans');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $userPaymentPlansDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.userPaymentPlan = savable(data);
                if ($scope.userPaymentPlan.close_date != null) {
                    $scope.userPaymentPlan.close_date = new Date($scope.userPaymentPlan.close_date);
                }
            });
        });
    } else {
        $scope.userPaymentPlan = {id: 0, status: 'Active', close_date: new Date()};

    }

}]);

