'use strict';

/**
 * File Manager Modal Controller
 */

app.controller('FileManagerCtrl', ['$scope', '$localStorage', '$timeout', '$uibModalInstance', 'field', 'value', 'instance', 'folder',
    function ($scope, $localStorage, $timeout, $uibModalInstance, field, value, instance, folder) {

        $scope.field = field;
        $scope.value = value;
        $scope.instance = instance;
        $scope.folder = folder;
        $scope.url = '';
        $scope.mode = '';

        $timeout(function(){
            var defaultOpen = elFinder.prototype.commands.open;
            console.log(defaultOpen)
            elFinder.prototype.commands.open = function (param) {
                console.log(param)
                // custom code
            };
            var fileManager = $('#elfinder_'+$scope.field).elfinder({
                url : '/efconnect/'+$scope.instance+'/'+$scope.folder+'?mode='+$scope.mode,
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
