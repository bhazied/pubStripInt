'use strict';

/**
 * Controller for user login
*/
app.controller('LoginCtrl', ['$scope', '$rootScope', '$localStorage', '$state', '$timeout', '$loginDataFactory',
function ($scope, $rootScope, $localStorage, $state, $timeout, $loginDataFactory) {
    
    if ($localStorage.access_token) {
        delete $localStorage.access_token;
    }
            
    $scope.status = '';
    $scope.user = {};
    $scope.disableSubmit = false;
    
    $scope.submit = function () {
        $scope.disableSubmit = true;
		$scope.user = {email: $scope.email, password: $scope.password};
        $loginDataFactory.check($scope.user).$promise.then(function(data) {
            $scope.disableSubmit = false;
            $scope.status = 'welcome';
            $localStorage.access_token = data.token;
            $scope.user = $localStorage.user = $rootScope.user = data.user;
            $timeout(function() {
                $state.go('app.dashboard');
            }, 1000);
        }, function(error) {
            $scope.disableSubmit = false;
            $scope.status = 'error';
        });
	};

}]);
