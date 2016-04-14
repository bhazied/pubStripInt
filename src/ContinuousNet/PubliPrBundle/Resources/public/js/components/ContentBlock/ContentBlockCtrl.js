'use strict';

/**
 * Controller for Content Block Details
 */

app.controller('ContentBlockCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$contentBlocksDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $contentBlocksDataFactory) {

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

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.templatemanager.contentblocks');
    };

    $scope.add = function() {
        $state.go('app.templatemanager.contentblocksnew');
    };

    $scope.edit = function(row) {
        $state.go('app.templatemanager.contentblocksedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $contentBlocksDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.contentBlock = data;
        });
    }

}]);

