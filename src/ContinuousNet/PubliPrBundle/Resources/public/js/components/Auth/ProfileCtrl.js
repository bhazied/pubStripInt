'use strict';
/** 
 * controller for User Profile Example
 */
app.controller('ProfileCtrl', ['$scope', '$stateParams', '$timeout', '$filter', '$uibModal', 'toaster', '$q', 'savable', '$localStorage', '$profileDataFactory', '$countriesDataFactory',
    function ($scope, $stateParams, $timeout, $filter, $uibModal, toaster, $q, savable, $localStorage, $profileDataFactory, $countriesDataFactory) {

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

        $scope.countries = [];
        $scope.countriesLoaded = false;

        $scope.getCountries = function() {
            $timeout(function(){
                $scope.countriesLoaded = true;
                if ($scope.countries.length == 0) {
                    $scope.countries.push({});
                    var def = $q.defer();
                    $countriesDataFactory.query({offset: 0, limit: 10000, 'order_by[country.name]': 'asc'}).$promise.then(function(data) {
                        for (var i in data.results) {
                            data.results[i].hidden = false;
                        }
                        $scope.countries = data.results;
                        def.resolve($scope.countries);
                    });
                    return def;
                } else {
                    return $scope.countries;
                }
            });
        };

        $scope.getCountries();

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
                $scope.user.country = $scope.user.country.id;
            });
        });

        $scope.submit = function (form) {
            $scope.user.locale = $localStorage.language;
            $scope.disableSubmit = true;
            $profileDataFactory.updateProfile($scope.user).$promise.then(function (data) {
                $scope.disableSubmit = false;
                console.log(data);
                console.log(data.status);

                if (data.status) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('profile.PROFILEUPDATED'));
                } else {
                    toaster.pop('warning', $filter('translate')('content.common.NOTIFICATION'), data.message);
                }

            }, function (error) {
                $scope.disableSubmit = false;
                console.warn(error);
            });
        };

    }]);