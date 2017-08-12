'use strict';

/**
 * Controller for Payment Form
 */

app.controller('PaymentFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$productsDataFactory', '$usersDataFactory', '$paymentsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $productsDataFactory, $usersDataFactory, $paymentsDataFactory) {

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


    $scope.startDateOpened = false;
    $scope.startDateToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.startDateOpened = !$scope.startDateOpened;
    };

    $scope.endDateOpened = false;
    $scope.endDateToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.endDateOpened = !$scope.endDateOpened;
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
    $scope.products = [];
    $scope.productsLoaded = false;

    $scope.getProducts = function() {
        $timeout(function(){
            $scope.productsLoaded = true;
            if ($scope.products.length == 0) {
                $scope.products.push({});
                var def = $q.defer();
                $productsDataFactory.query({offset: 0, limit: 10000, 'order_by[product.name]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.products = data.results;
                    def.resolve($scope.products);
                });
                return def;
            } else {
                return $scope.products;
            }
        });
    };

    $scope.getProducts();

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
            if ($scope.payment.id > 0) {
                $scope.disableSubmit = true;
                $paymentsDataFactory.update($scope.payment).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PAYMENTUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PAYMENTNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $paymentsDataFactory.create($scope.payment).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PAYMENTCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PAYMENTNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.billing.payments');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $paymentsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.payment = savable(data);
                if ($scope.payment.start_date != null) {
                    $scope.payment.start_date = new Date($scope.payment.start_date);
                }
                if ($scope.payment.end_date != null) {
                    $scope.payment.end_date = new Date($scope.payment.end_date);
                }
            });
        });
    } else {
        $scope.payment = {id: 0};

    }

}]);

