'use strict';

/**
 * File Manager Modal Controller
 */

app.controller('FileManagerCtrl', ['$scope', '$localStorage', '$timeout', '$uibModalInstance', 'field', 'value',
function ($scope, $localStorage, $timeout, $uibModalInstance, field, value) {

    $scope.field = field;
    $scope.value = value;
    $scope.url = '';
    $scope.mode = '';

    $timeout(function(){
        var fileManager = $('#elfinder_'+$scope.field).elfinder({
            url : '/efconnect'+'?mode='+$scope.mode,
            lang : (angular.isDefined($localStorage.language))?$localStorage.language:'en',
            useBrowserHistory: false,
            onlyMimes: ['image', 'video'],
            customHeaders: {
                'Authorization': 'Bearer ' + $localStorage.access_token,
                'PP-Application': 'BackOffice'
            },
            getFileCallback : function(file) {
                var parser = document.createElement('a');
                parser.href = file.url;
                $scope.url = parser.pathname;
            }
        });
    });

    $scope.ok = function () {
        $uibModalInstance.close($scope.url);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

}]);
