'use strict';

/**
 * Controller for Content Block Details
 */

app.controller('ContentBlockCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$contentBlocksDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $contentBlocksDataFactory) {

    $scope.blockTypes = [{
        id: 'Text',
        title: $filter('translate')('content.list.fields.blocktypes.TEXT'),
        css: 'text'
    }, {
        id: 'BoxedText',
        title: $filter('translate')('content.list.fields.blocktypes.BOXEDTEXT'),
        css: 'boxed-text'
    }, {
        id: 'Divider',
        title: $filter('translate')('content.list.fields.blocktypes.DIVIDER'),
        css: 'divider'
    }, {
        id: 'Image',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGE'),
        css: 'image'
    }, {
        id: 'ImageGroup',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGEGROUP'),
        css: 'image-group'
    }, {
        id: 'ImageCard',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGECARD'),
        css: 'image-card'
    }, {
        id: 'ImageWithCaption',
        title: $filter('translate')('content.list.fields.blocktypes.IMAGEWITHCAPTION'),
        css: 'image-with-caption'
    }, {
        id: 'SocialShare',
        title: $filter('translate')('content.list.fields.blocktypes.SOCIALSHARE'),
        css: 'social-share'
    }, {
        id: 'SocialFollow',
        title: $filter('translate')('content.list.fields.blocktypes.SOCIALFOLLOW'),
        css: 'social-follow'
    }, {
        id: 'Button',
        title: $filter('translate')('content.list.fields.blocktypes.BUTTON'),
        css: 'button'
    }, {
        id: 'Footer',
        title: $filter('translate')('content.list.fields.blocktypes.FOOTER'),
        css: 'footer'
    }, {
        id: 'RSSHeader',
        title: $filter('translate')('content.list.fields.blocktypes.RSSHEADER'),
        css: 'r-s-s-header'
    }, {
        id: 'RSSItems',
        title: $filter('translate')('content.list.fields.blocktypes.RSSITEMS'),
        css: 'r-s-s-items'
    }, {
        id: 'Code',
        title: $filter('translate')('content.list.fields.blocktypes.CODE'),
        css: 'code'
    }];
    $scope.statuses = [{
        id: 'Draft',
        title: $filter('translate')('content.list.fields.statuses.DRAFT'),
        css: 'info'
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
        css: 'inverse'
    }, {
        id: 'Deleted',
        title: $filter('translate')('content.list.fields.statuses.DELETED'),
        css: 'danger'
    }, {
        id: 'Archived',
        title: $filter('translate')('content.list.fields.statuses.ARCHIVED'),
        css: 'primary'
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

