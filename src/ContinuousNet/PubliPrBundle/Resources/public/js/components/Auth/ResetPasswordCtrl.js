'use strict';

/**
 * Controller for reset password
 */
app.controller('ResetPasswordCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$resetPasswordDataFactory',
    function ($scope, $rootScope, $localStorage, $state, $timeout, $resetPasswordDataFactory) {

        if ($localStorage.access_token) {
            delete $localStorage.access_token;
        }

        $scope.status = '';
        $scope.user = {};
        $scope.disableSubmit = false;

        $scope.submit = function () {
            $scope.status = 'progress';
            $scope.disableSubmit = true;
            $scope.user = {locale: $localStorage.language, email: $scope.email};
            $resetPasswordDataFactory.request($scope.user).$promise.then(function(data) {
                $scope.disableSubmit = false;
                if (data.status) {
                    $scope.status = 'success';
                } else {
                    $scope.status = 'error';
                }
            }, function(error) {
                $scope.disableSubmit = false;
                $scope.status = 'error';
            });
        };

    }
]);
