'use strict';

/**
 * Controller for Country Form
 */

app.controller('CountryFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$usersDataFactory', '$countriesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $usersDataFactory, $countriesDataFactory) {

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';

    // Editor options.
    $scope.editorOptions = {
        language: $scope.locale,
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReadyEditor = function () {
        
    };


    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $timeout(function(){
            $scope.usersLoaded = true;
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.users = data.results;
                    def.resolve($scope.users);
                });
                return def;
            } else {
                return $scope.users;
            }
        });
    };

    $scope.getUsers();



    $scope.submitForm = function(form) {
        var firstError = null;
        if (form.$invalid) {
            var field = null, firstError = null;
            for (field in form) {
                if (field[0] != '$') {
                    if (firstError === null && !form[field].$valid) {
                        firstError = form[field].$name;
                    }
                    if (form[field].$pristine) {
                        form[field].$dirty = true;
                    }
                }
            }
            angular.element('.ng-invalid[name=' + firstError + ']').focus();
            SweetAlert.swal($filter('translate')('content.form.messages.FORMCANNOTBESUBMITTED'), $filter('translate')('content.form.messages.ERRORSAREMARKED'), "error");
            return;
        } else {
            if ($scope.country.id > 0) {
                $countriesDataFactory.update($scope.country).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.COUNTRYUPDATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.COUNTRYNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $countriesDataFactory.create($scope.country).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.COUNTRYCREATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.COUNTRYNOTCREATED'));
                    console.warn(error);
                });
            }
        }
    };

    $scope.list = function() {
        $state.go('app.settings.countries');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $countriesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.country = savable(data);
                //console.warn($scope.country);
            });
        });
    } else {
        $scope.country = {id: 0};

    }

    $scope.showFileManager = function(field) {
    
        var modalInstance = $uibModal.open({
            templateUrl: '/bundles/publipr/js/common/FileManager/modal_content.html',
            controller: 'FileManagerCtrl',
            size: 'lg',
            resolve: {
                field: function() {
                    return field;
                },
                value: function() {
                    return $scope.country[field];
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.country[field] = url;
        }, function () {
            
        });
    
    };

}]);

