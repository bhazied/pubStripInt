'use strict';

/**
 * Controller for Press Release Form
 */

app.controller('PressReleaseFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$newsroomsDataFactory', '$usersDataFactory', '$pressReleasesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $newsroomsDataFactory, $usersDataFactory, $pressReleasesDataFactory) {

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


    $scope.startPublishingOpened = false;
    $scope.startPublishingToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.startPublishingOpened = !$scope.startPublishingOpened;
    };

    $scope.endPublishingOpened = false;
    $scope.endPublishingToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.endPublishingOpened = !$scope.endPublishingOpened;
    };

    $scope.publishDateTimeOpened = false;
    $scope.publishDateTimeToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.publishDateTimeOpened = !$scope.publishDateTimeOpened;
    };
    $scope.statuses = [{
        id: 'Draft',
        title: $filter('translate')('content.list.fields.statuses.DRAFT'),
        css: 'primary'
    }, {
        id: 'Online',
        title: $filter('translate')('content.list.fields.statuses.ONLINE'),
        css: 'success'
    }, {
        id: 'Deactivated',
        title: $filter('translate')('content.list.fields.statuses.DEACTIVATED'),
        css: 'warning'
    }, {
        id: 'Offline',
        title: $filter('translate')('content.list.fields.statuses.OFFLINE'),
        css: 'danger'
    }, {
        id: 'Deleted',
        title: $filter('translate')('content.list.fields.statuses.DELETED'),
        css: 'default'
    }, {
        id: 'Archived',
        title: $filter('translate')('content.list.fields.statuses.ARCHIVED'),
        css: 'info'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.dateTimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');
    $scope.minDate = new Date(2010, 0, 1);
    $scope.maxDate = new Date(2050, 11, 31);
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.disabled = function (date, mode) {
        return (mode === 'day' && (date.getDay() === -1));
    };
    $scope.newsrooms = [];
    $scope.newsroomsLoaded = false;

    $scope.getNewsrooms = function() {
        $timeout(function(){
            $scope.newsroomsLoaded = true;
            if ($scope.newsrooms.length == 0) {
                $scope.newsrooms.push({});
                var def = $q.defer();
                $newsroomsDataFactory.query({offset: 0, limit: 10000, 'order_by[newsroom.name]': 'asc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.newsrooms = data.results;
                    def.resolve($scope.newsrooms);
                });
                return def;
            } else {
                return $scope.newsrooms;
            }
        });
    };

    $scope.getNewsrooms();

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
            if ($scope.pressRelease.id > 0) {
                $scope.disableSubmit = true;
                $pressReleasesDataFactory.update($scope.pressRelease).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PRESSRELEASEUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PRESSRELEASENOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $pressReleasesDataFactory.create($scope.pressRelease).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PRESSRELEASECREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PRESSRELEASENOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.prmanager.pressreleases');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $pressReleasesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.pressRelease = savable(data);
                if ($scope.pressRelease.start_publishing != null) {
                    $scope.pressRelease.start_publishing = new Date($scope.pressRelease.start_publishing);
                }
                if ($scope.pressRelease.end_publishing != null) {
                    $scope.pressRelease.end_publishing = new Date($scope.pressRelease.end_publishing);
                }
                if ($scope.pressRelease.publish_date_time != null) {
                    $scope.pressRelease.publish_date_time = new Date($scope.pressRelease.publish_date_time);
                }
            });
        });
    } else {
        $scope.pressRelease = {id: 0, publish_date_time: new Date(), status: 'Draft'};

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
                    return $scope.pressRelease[field];
                },
                instance: function() {
                    return 'default';
                },
                folder: function() {
                    return 'pressReleases';
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.pressRelease[field] = url;
        }, function () {
            
        });
    
    };

}]);

