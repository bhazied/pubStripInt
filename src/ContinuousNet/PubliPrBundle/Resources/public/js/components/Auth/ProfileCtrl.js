'use strict';
/** 
 * controller for User Profile Example
 */
app.controller('ProfileCtrl', ['$scope', '$stateParams', '$timeout', '$filter', '$uibModal', 'savable', '$localStorage', '$profileDataFactory',
    function ($scope, $stateParams, $timeout, $filter, $uibModal, savable, $localStorage, $profileDataFactory) {

        $scope.disableSubmit = false;
        $scope.locale = (angular.isDefined($localStorage.language)) ? $localStorage.language : 'fr';
        $scope.genders = [{
            id: 'Male',
            title: $filter('translate')('content.list.fields.genders.MALE'),
            css: 'info'
        }, {
            id: 'Female',
            title: $filter('translate')('content.list.fields.genders.FEMALE'),
            css: 'success'
        }];

        $scope.showFileManager = function (field) {

            var modalInstance = $uibModal.open({
                templateUrl: '/bundles/publipr/js/common/FileManager/modal_content.html',
                controller: 'FileManagerCtrl',
                size: 'lg',
                resolve: {
                    field: function () {
                        return field;
                    },
                    value: function () {
                        return $scope.user[field];
                    }
                }
            });
            modalInstance.result.then(function (url) {
                $scope.user[field] = url;
            }, function () {

            });
        };

        $profileDataFactory.getProfile({locale: $localStorage.language}).$promise.then(function (data) {
            $timeout(function () {
                
                $scope.user = data ;
                console.log(data);
            });
        });

        $scope.submit = function (form) {
            $scope.user.locale = $localStorage.language;
            $scope.disableSubmit = true;
            $profileDataFactory.updateProfile($scope.user).$promise.then(function (data) {
                $scope.disableSubmit = false;
                console.log(data);
            }, function (error) {
                $scope.disableSubmit = false;
                console.warn(error);
            });
        };

    }]);