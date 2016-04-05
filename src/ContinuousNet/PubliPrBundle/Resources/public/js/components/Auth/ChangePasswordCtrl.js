'use strict';

/**
 * Controller for set new password
 */
app.controller('ChangePasswordCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$profileDataFactory', '$stateParams',
    function ($scope, $rootScope, $localStorage, $state, $timeout, $profileDataFactory, $stateParams) {



        $scope.confrimation = '';
        $scope.status = '';
        $scope.disableSubmit = false;

        $scope.password = {
            new : {
                first: '',
                second: ''
            }
        };

        $scope.submit = function () {
            var data = {
                locale: $localStorage.language,
                'current_password': $scope.current_password, 
                'new': $scope.password.new
            };
            $scope.disableSubmit = true;
            $profileDataFactory.changePassword(data).$promise.then(function (data) {
                $scope.disableSubmit = false;
                if (data.status) {
                    $scope.status = 'success';
                    $scope.user = $localStorage.user = $rootScope.user = data.user;

                } else {
                    $scope.status = 'error';
                }
            }, function (error) {
                $scope.disableSubmit = false;
                $scope.status = 'error';
            });
        };



    }
]);
