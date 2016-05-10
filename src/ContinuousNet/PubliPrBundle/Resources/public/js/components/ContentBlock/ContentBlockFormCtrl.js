'use strict';

/**
 * Controller for Content Block Form
 */

app.controller('ContentBlockFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$usersDataFactory', '$contentBlocksDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $usersDataFactory, $contentBlocksDataFactory) {

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

    $scope.blockTypes = [{
        id: 'Text',
        title: $filter('translate')('content.list.fields.blocktypes.TEXT'),
        css: 'primary'
    }, {
        id: 'BoxedText',
        title: $filter('translate')('content.list.fields.blocktypes.BOXEDTEXT'),
        css: 'success'
    }, {
        id: 'Divider',
        title: $filter('translate')('content.list.fields.blocktypes.DIVIDER'),
        css: 'warning'
    }, {
        id: 'Image',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGE'),
        css: 'danger'
    }, {
        id: 'ImageGroup',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGEGROUP'),
        css: 'default'
    }, {
        id: 'ImageCard',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGECARD'),
        css: 'info'
    }, {
        id: 'ImageWithCaption',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGEWITHCAPTION'),
        css: 'primary'
    }, {
        id: 'SocialShare',
        title: $filter('translate')('content.list.fields.blocktypes.SOCIALSHARE'),
        css: 'success'
    }, {
        id: 'SocialFollow',
        title: $filter('translate')('content.list.fields.blocktypes.SOCIALFOLLOW'),
        css: 'warning'
    }, {
        id: 'Button',
        title: $filter('translate')('content.list.fields.blocktypes.BUTTON'),
        css: 'danger'
    }, {
        id: 'Footer',
        title: $filter('translate')('content.list.fields.blocktypes.FOOTER'),
        css: 'default'
    }, {
        id: 'Video',
        title: $filter('translate')('content.list.fields.blocktypes.VIDEO'),
        css: 'info'
    }, {
        id: 'RssHeader',
        title: $filter('translate')('content.list.fields.blocktypes.RSSHEADER'),
        css: 'primary'
    }, {
        id: 'RssItems',
        title: $filter('translate')('content.list.fields.blocktypes.RSSITEMS'),
        css: 'success'
    }, {
        id: 'Code',
        title: $filter('translate')('content.list.fields.blocktypes.CODE'),
        css: 'warning'
    }, {
        id: 'Zone',
        title: $filter('translate')('content.list.fields.blocktypes.ZONE'),
        css: 'danger'
    }];
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
            if ($scope.contentBlock.id > 0) {
                $scope.disableSubmit = true;
                $contentBlocksDataFactory.update($scope.contentBlock).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.CONTENTBLOCKUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.CONTENTBLOCKNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $contentBlocksDataFactory.create($scope.contentBlock).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.CONTENTBLOCKCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.CONTENTBLOCKNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.templatemanager.contentblocks');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $contentBlocksDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.contentBlock = savable(data);
            });
        });
    } else {
        $scope.contentBlock = {id: 0, block_type: 'Text', status: 'Draft'};

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
                    return $scope.contentBlock[field];
                },
                instance: function() {
                    return 'default';
                },
                folder: function() {
                    return 'contentBlocks';
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.contentBlock[field] = url;
        }, function () {
            
        });
    
    };

}]);

