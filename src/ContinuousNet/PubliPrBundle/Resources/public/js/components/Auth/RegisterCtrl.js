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
app.controller('RegisterCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$parse', '$q', 'toaster', '$registerDataFactory', 'SweetAlert', '$filter', 'vcRecaptchaService',
    function ($scope, $rootScope, $localStorage, $state, $timeout, $parse, $q, toaster, $registerDataFactory, SweetAlert, $filter, vcRecaptchaService) {

        $scope.user = {
            name: "",
            email: "",
            password: "",
            "g-recaptcha-response": null
        };
        $scope.disableSubmit = false;
        $scope.widgetId = null;
        $scope.captchaError = false;

        $scope.setResponse = function (response) {
            console.info('Response available');
            $scope.user['g-recaptcha-response'] = response;
        };

        $scope.setWidgetId = function (widgetId) {
            console.info('Created widget ID: %s', widgetId);
            $scope.widgetId = widgetId;
        };

        $scope.cbExpiration = function() {
            console.info('Captcha expired. Resetting response object');
            vcRecaptchaService.reload($scope.widgetId);
            $scope.user['g-recaptcha-response'] = null;
        };

        $scope.submit = function (signUpForm) {

            if ($scope.user['g-recaptcha-response'] == null) {
                $scope.captchaError = true;
            }

            if (signUpForm.$valid) {
                $scope.user.locale = $localStorage.language;
                $scope.disableSubmit = true;
                $registerDataFactory.register($scope.user).$promise.then(function (data) {
                    $scope.disableSubmit = false;
                    console.log(data);
                    if (data.status) {
                        if (angular.isDefined(data.token)) {
                            $localStorage.access_token = data.token;
                            $scope.user = $localStorage.user = $rootScope.user = data.user;
                            $scope.authenticated = true;
                        }
                        SweetAlert.swal({
                            title: $filter('translate')('register.THANKS'),
                            text: $filter('translate')('register.EMAILSENT'),
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: $filter('translate')('content.form.messages.OK'),
                            closeOnConfirm: true
                        }, function(){
                            $state.go('auth.login');
                        });
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
