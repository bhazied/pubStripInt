'use strict';

/**
 * Controller for Content Blocks List
 */

app.controller('ContentBlocksCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$usersDataFactory', '$contentBlocksDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $usersDataFactory, $contentBlocksDataFactory) {

    $scope.isFiltersVisible = false;

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

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
    $scope.showFieldsMenu = false;

    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $scope.usersLoaded = true;
        if ($scope.users.length == 0) {
            $scope.users.push({});
            var def = $q.defer();
            $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.users.length = 0;
                        for (var i in data.results) {
                            $scope.users.push({
                                id: data.results[i].id,
                                title: data.results[i].username
                            });
                        }
                        def.resolve($scope.users);
                    }
                });
            });
            return def;
        } else {
            return $scope.users;
        }
    };

    $scope.getUsers();


    $scope.textValue = function($scope, row) {
        return $scope.$eval('row.' + this.field);
    };

    $scope.trusted = {};

    $scope.linkValue = function($scope, row) {
        var value = row[this.field];
        if (value == null || typeof value == 'undefined') {
            return '';
        }
        var html = '<a ui-sref="'+this.state+'({id: ' + row.id + '})">' + value[this.displayField] + '</a>';
        return $scope.trusted[html] || ($scope.trusted[html] = $sce.trustAsHtml(html));
    };

    $scope.evaluatedValue = function($scope, row) {
        var value = $scope.$eval('row.' + this.field, {row: row});
        if (value == null || typeof value == 'undefined') {
            return '';
        }
        return $scope.$eval('\'' + value + '\' | ' + this.valueFormatter);
    };

    $scope.interpolatedValue = function($scope, row) {
        return this.interpolateExpr({
            row: row,
            blockTypes: $scope.blockTypes,
            statuses: $scope.statuses,
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.contentBlocksParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.contentBlocksParams)) {
           $localStorage.contentBlocksParams = {};
        }
        if (angular.isDefined($localStorage.contentBlocksParams[param])) {
            return $localStorage.contentBlocksParams[param];
        } else {
            $localStorage.contentBlocksParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'contentBlock.id', filter: { 'contentBlock.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'name', title: $filter('translate')('content.list.fields.NAME'), sortable: 'contentBlock.name', filter: { 'contentBlock.name': 'text' }, show: $scope.getParamValue('name_show_filed', true), getValue: $scope.textValue },
            { field: 'description', title: $filter('translate')('content.list.fields.DESCRIPTION'), sortable: 'contentBlock.description', filter: { 'contentBlock.description': 'text' }, show: $scope.getParamValue('description_show_filed', false), getValue: $scope.textValue },
            { field: 'html_template', title: $filter('translate')('content.list.fields.HTMLTEMPLATE'), sortable: 'contentBlock.htmlTemplate', filter: { 'contentBlock.htmlTemplate': 'text' }, show: $scope.getParamValue('html_template_show_filed', false), getValue: $scope.textValue },
            { field: 'settings', title: $filter('translate')('content.list.fields.SETTINGS'), sortable: 'contentBlock.settings', filter: { 'contentBlock.settings': 'text' }, show: $scope.getParamValue('settings_show_filed', false), getValue: $scope.textValue },
            { field: 'picture', title: $filter('translate')('content.list.fields.PICTURE'), sortable: 'contentBlock.picture', filter: { 'contentBlock.picture': 'text' }, show: $scope.getParamValue('picture_show_filed', true), getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<img ng-src="'+$rootScope.app.thumbURL+'[[ (row.picture)?row.picture:\'/assets/images/picturenotavailable.'+$scope.locale+'.png\' ]]" alt="" class="img-thumbnail" />') },
            { field: 'block_type', title: $filter('translate')('content.list.fields.BLOCKTYPE'), sortable: 'contentBlock.blockType', filter: { 'contentBlock.blockType': 'select' }, show: $scope.getParamValue('block_type_show_filed', true), getValue: $scope.interpolatedValue, filterData : $scope.blockTypes, interpolateExpr: $interpolate('<span my-enum="[[ row.block_type ]]" my-enum-list=\'[[ blockTypes ]]\'></span>') },
            { field: 'status', title: $filter('translate')('content.list.fields.STATUS'), sortable: 'contentBlock.status', filter: { 'contentBlock.status': 'select' }, show: $scope.getParamValue('status_show_filed', false), getValue: $scope.interpolatedValue, filterData : $scope.statuses, interpolateExpr: $interpolate('<span my-enum="[[ row.status ]]" my-enum-list=\'[[ statuses ]]\'></span>') },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'contentBlock.createdAt', filter: { 'contentBlock.createdAt': 'text' }, show: $scope.getParamValue('created_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.username', filter: { 'contentBlock.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('creator_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'contentBlock.modifiedAt', filter: { 'contentBlock.modifiedAt': 'text' }, show: $scope.getParamValue('modified_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modifier_user', title: $filter('translate')('content.list.fields.MODIFIERUSER'), sortable: 'modifier_user.username', filter: { 'contentBlock.modifierUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('modifier_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { title: $filter('translate')('content.common.ACTIONS'), show: true, getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<div class="btn-group pull-right"><button type="button" class="btn btn-success" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.EDIT')+'" ng-click="edit(row)"><i class="ti-pencil-alt"></i></button><button type="button" class="btn btn-warning" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.SHOWDETAILS')+'" ng-click="details(row)"><i class="ti-clipboard"></i></button><button type="button" class="btn btn-danger" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.REMOVE')+'" ng-click="delete(row)"><i class="ti-trash"></i></button></div>') }
        ];
    };

    $scope.setCols();

    $scope.$on('languageChange', function(event, locale) {
        $timeout(function(){;
            $scope.setCols();
        }, 500);
    });

    $scope.tableParams = new ngTableParams({
        page: 1, // show first page
        count: $scope.getParamValue('count', 50), // count per page
        sorting: $scope.getParamValue('sorting', {'contentBlock.createdAt': 'desc'}),
        filter: $scope.getParamValue('filter', {})
    }, {
        getData: function ($defer, params) {
            var offset = (params.page() - 1) * params.count();
            var limit = params.count();
            var order_by = params.sorting();
            var filters = params.filter();
            $scope.setParamValue('sorting', order_by);
            $scope.setParamValue('filter', filters);
            $scope.setParamValue('count', limit);
            var http_params = {
                offset: offset,
                limit: limit
            };
            for (var field in order_by) {
                http_params['order_by['+field+']'] = order_by[field];
            }
            if (filters.length > 0) {
                http_params.offset = 0;
            }
            for (var field in filters) {
                if (filters[field] != null || filters[field] != '') {
                    http_params['filters['+field+']'] = filters[field];
                }
            }
            return $contentBlocksDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERCONTENTBLOCK'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: $filter('translate')('content.common.YESDELETE'),
            cancelButtonText: $filter('translate')('content.common.NOCANCEL'),
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $contentBlocksDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.CONTENTBLOCKDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.CONTENTBLOCKNOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.CONTENTBLOCKNOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.templatemanager.contentblocksnew');
    };

    $scope.edit = function(row) {
        $state.go('app.templatemanager.contentblocksedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.templatemanager.contentblocksdetails', {id: row.id});
    };

}]);

