'use strict';

/**
 * Controller for Newsroom Form
 */

app.controller('NewsroomFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$fontsDataFactory', '$usersDataFactory', '$newsroomsDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $fontsDataFactory, $usersDataFactory, $newsroomsDataFactory) {

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';

    $scope.disableSubmit = false;

    // Editor options.
    $scope.editorOptions = {
        language: $scope.locale,
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReadyEditor = function () {
        
    };


    $scope.fonts = [];
    $scope.fontsLoaded = false;

    $scope.getFonts = function() {
        $timeout(function(){
            $scope.fontsLoaded = true;
            if ($scope.fonts.length == 0) {
                $scope.fonts.push({});
                var def = $q.defer();
                $fontsDataFactory.query({offset: 0, limit: 10000, 'order_by[font.name]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.fonts = data.results;
                    def.resolve($scope.fonts);
                });
                return def;
            } else {
                return $scope.fonts;
            }
        });
    };

    $scope.getFonts();

    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $timeout(function(){
            $scope.usersLoaded = true;
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.username]': 'asc'}).$promise.then(function(data) {
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


    $scope.users = [];
    $scope.usersLoaded = [];

    $scope.getUsers = function() {
        $timeout(function(){
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.username]': 'asc'}).$promise.then(function(data) {
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
            return false;
        } else {
            if ($scope.newsroom.id > 0) {
                $scope.disableSubmit = true;
                $newsroomsDataFactory.update($scope.newsroom).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.NEWSROOMUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.NEWSROOMNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $newsroomsDataFactory.create($scope.newsroom).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.NEWSROOMCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.NEWSROOMNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.prmanager.newsrooms');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $newsroomsDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.newsroom = savable(data);
            });
        });
    } else {
        $scope.newsroom = {id: 0, users: []};

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
                    return $scope.newsroom[field];
                },
                instance: function() {
                    return 'default';
                },
                folder: function() {
                    var company = '00000' + $localStorage.user.company;
                    company = company.substr(company.length - 5);
                    var newsroom_ = '00000' + $scope.newsroom.id;
                    newsroom_ = newsroom_.substr(newsroom_.length - 5);
                    return 'users/company_'+company+'/newsroom_'+newsroom_;
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.newsroom[field] = url;
        }, function () {
            
        });
    
    };

}]);

