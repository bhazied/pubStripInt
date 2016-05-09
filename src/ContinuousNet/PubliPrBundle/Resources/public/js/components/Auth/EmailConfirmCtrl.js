'use strict';


/**
 * Controller for user email confirmation
 */
app.controller('EmailConfirmCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$parse', '$q', 'toaster', '$registerDataFactory', '$stateParams',
    function ($scope, $rootScope, $localStorage, $state, $timeout, $parse, $q, toaster, $registerDataFactory, $stateParams) {

        $scope.status = 'progress';
        $scope.authenticated = false;

        if (angular.isDefined($stateParams.token)) {
            $timeout(function() {
                $registerDataFactory.emailConfirm({locale: $localStorage.language, token: $stateParams.token}).$promise.then(function(data) {
                    $timeout(function(){
                        if (data.status) {
                            $scope.status = 'success';
                            $localStorage.access_token = data.token;
                            $scope.user = $localStorage.user = $rootScope.user = data.user;
                            $scope.authenticated = true;
                        } else {
                            $scope.status = 'error';
                        }
                    }, 2000);
                });
            }, 2000)
        } else {
            $scope.status = 'warning';
        }

    }
]);
