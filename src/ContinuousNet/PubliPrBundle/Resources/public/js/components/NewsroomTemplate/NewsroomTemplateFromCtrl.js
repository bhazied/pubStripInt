'use strict';

/**
 * Controller for Newsroom Template Form
 */

app.controller('NewsroomTemplateFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$usersDataFactory', '$newsroomTemplatesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $usersDataFactory, $newsroomTemplatesDataFactory) {

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
            if ($scope.newsroomTemplate.id > 0) {
                $newsroomTemplatesDataFactory.update($scope.newsroomTemplate).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.NEWSROOMTEMPLATEUPDATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.NEWSROOMTEMPLATENOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $newsroomTemplatesDataFactory.create($scope.newsroomTemplate).$promise.then(function(data) {
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.NEWSROOMTEMPLATECREATED'));
                    $scope.list();
                }, function(error) {
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.NEWSROOMTEMPLATENOTCREATED'));
                    console.warn(error);
                });
            }
        }
    };

    $scope.list = function() {
        $state.go('app.settings.newsroomtemplates');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $newsroomTemplatesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.newsroomTemplate = savable(data);
                //console.warn($scope.newsroomTemplate);
            });
        });
    } else {
        $scope.newsroomTemplate = {id: 0};

    }

}]);

