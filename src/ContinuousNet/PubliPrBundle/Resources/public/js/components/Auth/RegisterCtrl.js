'use strict';

app.directive('licenceValidator', function($registerDataFactory, $timeout, $localStorage) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$asyncValidators.licence = function(modelValue, viewValue) {
                if (!angular.isDefined(viewValue) ||  viewValue == null ||  viewValue == '') {
                    ngModel.$setValidity('licenceValidator', false);
                    return false;
                }
                return $registerDataFactory.checkLicenceKey({locale: $localStorage.language, key: viewValue}).$promise.then(function(data) {
                    $timeout(function() {
                        ngModel.$setValidity('licenceValidator', data.status);
                    }, 2000);
                });
            };
        }
    };
});

app.directive('emailValidator', function($registerDataFactory, $timeout, $localStorage) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$asyncValidators.email = function(modelValue, viewValue) {
                if (!angular.isDefined(viewValue) ||  viewValue == null ||  viewValue == '') {
                    ngModel.$setValidity('emailValidator', false);
                    return false;
                }
                return $registerDataFactory.checkEmail({locale: $localStorage.language, email: viewValue}).$promise.then(function(data) {
                    $timeout(function() {
                        ngModel.$setValidity('emailValidator', data.status);
                    }, 2000);
                });
            };
        }
    };
});


/**
 * Controller for user registration
 */
app.controller('RegisterCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$parse', '$q', 'toaster', '$registerDataFactory', 'SweetAlert', '$filter',
    function ($scope, $rootScope, $localStorage, $state, $timeout, $parse, $q, toaster, $registerDataFactory, SweetAlert, $filter) {

        $scope.user = {
            name: "",
            email: "",
            password: "",
            "g-recaptcha-response": ""
        };
        $scope.disableSubmit = false;

        $scope.submit = function (signUpForm) {

            if (signUpForm.$valid) {
                $scope.user.locale = $localStorage.language;
                $scope.disableSubmit = true;
                $registerDataFactory.register($scope.user).$promise.then(function (data) {
                    $scope.disableSubmit = false;
                    console.log(data)
                    if (data.status) {
                        if (angular.isDefined(data.token)) {
                            $localStorage.access_token = data.token;
                            $scope.user = $localStorage.user = $rootScope.user = data.user;
                            $scope.authenticated = true;
                        }
                        SweetAlert.swal($filter('translate')('register.THANKS'), $filter('translate')('register.EMAILSENT'), 'success');
                    } else {
                        SweetAlert.swal($filter('translate')('content.common.ERROR'), $filter('translate')('register.FAILED'), 'error');
                    }
                }, function (error) {
                    $scope.disableSubmit = false;
                    SweetAlert.swal($filter('translate')('content.common.ERROR'), $filter('translate')('register.FAILED'), 'error');
                });

            } else {
                $scope.swal = function () {
                    SweetAlert.swal($filter('translate')('form.messages.CHECKFROMFIELDS'), $filter('translate')('form.messages.FORMCANNOTBESUBMITTED'), 'error');
                };
            }

            return false;
        };

    }
]);
