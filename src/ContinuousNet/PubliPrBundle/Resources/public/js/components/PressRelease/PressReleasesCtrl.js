'use strict';

/**
 * Controller for Press Releases List
 */

app.controller('PressReleasesCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$newsroomsDataFactory', '$usersDataFactory', '$pressReleasesDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $newsroomsDataFactory, $usersDataFactory, $pressReleasesDataFactory) {

    $scope.isFiltersVisible = false;

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

    $scope.booleanOptions = [{
        id: '1',
        title: $filter('translate')('content.common.YES'),
        css: 'success'
     }, {
        id: '0',
        title: $filter('translate')('content.common.NO'),
        css: 'danger'
    }];

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
    $scope.showFieldsMenu = false;

    $scope.newsrooms = [];
    $scope.newsroomsLoaded = false;

    $scope.getNewsrooms = function() {
        $scope.newsroomsLoaded = true;
        if ($scope.newsrooms.length == 0) {
            $scope.newsrooms.push({});
            var def = $q.defer();
            $newsroomsDataFactory.query({offset: 0, limit: 10000, 'order_by[newsroom.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.newsrooms.length = 0;
                        for (var i in data.results) {
                            $scope.newsrooms.push({
                                id: data.results[i].id,
                                title: data.results[i].name
                            });
                        }
                        def.resolve($scope.newsrooms);
                    }
                });
            });
            return def;
        } else {
            return $scope.newsrooms;
        }
    };

    $scope.getNewsrooms();

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
            statuses: $scope.statuses,
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.pressReleasesParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.pressReleasesParams)) {
           $localStorage.pressReleasesParams = {};
        }
        if (angular.isDefined($localStorage.pressReleasesParams[param])) {
            return $localStorage.pressReleasesParams[param];
        } else {
            $localStorage.pressReleasesParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'pressRelease.id', filter: { 'pressRelease.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'newsroom', title: $filter('translate')('content.list.fields.NEWSROOM'), sortable: 'newsroom.name', filter: { 'pressRelease.newsroom': 'select' }, getValue: $scope.linkValue, filterData: $scope.getNewsrooms(), show: $scope.getParamValue('newsroom_id_show_filed', true), displayField: 'name', state: 'app.prmanager.newsroomsdetails' },
            { field: 'title', title: $filter('translate')('content.list.fields.TITLE'), sortable: 'pressRelease.title', filter: { 'pressRelease.title': 'text' }, show: $scope.getParamValue('title_show_filed', true), getValue: $scope.textValue },
            { field: 'slug', title: $filter('translate')('content.list.fields.SLUG'), sortable: 'pressRelease.slug', filter: { 'pressRelease.slug': 'text' }, show: $scope.getParamValue('slug_show_filed', false), getValue: $scope.textValue },
            { field: 'description', title: $filter('translate')('content.list.fields.DESCRIPTION'), sortable: 'pressRelease.description', filter: { 'pressRelease.description': 'text' }, show: $scope.getParamValue('description_show_filed', false), getValue: $scope.textValue },
            { field: 'picture_preview', title: $filter('translate')('content.list.fields.PICTUREPREVIEW'), sortable: 'pressRelease.picturePreview', filter: { 'pressRelease.picturePreview': 'text' }, show: $scope.getParamValue('picture_preview_show_filed', true), getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<img ng-src="'+$rootScope.app.thumbURL+'[[ (row.picture_preview)?row.picture_preview:\'/assets/images/picturenotavailable.'+$scope.locale+'.png\' ]]" alt="" class="img-thumbnail" />') },
            { field: 'content', title: $filter('translate')('content.list.fields.CONTENT'), sortable: 'pressRelease.content', filter: { 'pressRelease.content': 'text' }, show: $scope.getParamValue('content_show_filed', false), getValue: $scope.textValue },
            { field: 'is_headline', title: $filter('translate')('content.list.fields.ISHEADLINE'), sortable: 'pressRelease.isHeadline', filter: { 'pressRelease.isHeadline': 'select' }, show: $scope.getParamValue('is_headline_show_filed', false), getValue: $scope.interpolatedValue, filterData : $scope.booleanOptions, interpolateExpr: $interpolate('<span my-boolean="[[ row.is_headline ]]"></span>') },
            { field: 'auto_publishing', title: $filter('translate')('content.list.fields.AUTOPUBLISHING'), sortable: 'pressRelease.autoPublishing', filter: { 'pressRelease.autoPublishing': 'select' }, show: $scope.getParamValue('auto_publishing_show_filed', false), getValue: $scope.interpolatedValue, filterData : $scope.booleanOptions, interpolateExpr: $interpolate('<span my-boolean="[[ row.auto_publishing ]]"></span>') },
            { field: 'start_publishing', title: $filter('translate')('content.list.fields.STARTPUBLISHING'), sortable: 'pressRelease.startPublishing', filter: { 'pressRelease.startPublishing': 'text' }, show: $scope.getParamValue('start_publishing_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'end_publishing', title: $filter('translate')('content.list.fields.ENDPUBLISHING'), sortable: 'pressRelease.endPublishing', filter: { 'pressRelease.endPublishing': 'text' }, show: $scope.getParamValue('end_publishing_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'publish_date_time', title: $filter('translate')('content.list.fields.PUBLISHDATETIME'), sortable: 'pressRelease.publishDateTime', filter: { 'pressRelease.publishDateTime': 'text' }, show: $scope.getParamValue('publish_date_time_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'meta_title', title: $filter('translate')('content.list.fields.METATITLE'), sortable: 'pressRelease.metaTitle', filter: { 'pressRelease.metaTitle': 'text' }, show: $scope.getParamValue('meta_title_show_filed', false), getValue: $scope.textValue },
            { field: 'meta_description', title: $filter('translate')('content.list.fields.METADESCRIPTION'), sortable: 'pressRelease.metaDescription', filter: { 'pressRelease.metaDescription': 'text' }, show: $scope.getParamValue('meta_description_show_filed', false), getValue: $scope.textValue },
            { field: 'meta_keywords', title: $filter('translate')('content.list.fields.METAKEYWORDS'), sortable: 'pressRelease.metaKeywords', filter: { 'pressRelease.metaKeywords': 'text' }, show: $scope.getParamValue('meta_keywords_show_filed', false), getValue: $scope.textValue },
            { field: 'status', title: $filter('translate')('content.list.fields.STATUS'), sortable: 'pressRelease.status', filter: { 'pressRelease.status': 'select' }, show: $scope.getParamValue('status_show_filed', false), getValue: $scope.interpolatedValue, filterData : $scope.statuses, interpolateExpr: $interpolate('<span my-enum="[[ row.status ]]" my-enum-list=\'[[ statuses ]]\'></span>') },
            { field: 'total_prints', title: $filter('translate')('content.list.fields.TOTALPRINTS'), sortable: 'pressRelease.totalPrints', filter: { 'pressRelease.totalPrints': 'number' }, show: $scope.getParamValue('total_prints_show_filed', false), getValue: $scope.textValue },
            { field: 'total_hits', title: $filter('translate')('content.list.fields.TOTALHITS'), sortable: 'pressRelease.totalHits', filter: { 'pressRelease.totalHits': 'number' }, show: $scope.getParamValue('total_hits_show_filed', false), getValue: $scope.textValue },
            { field: 'total_comments', title: $filter('translate')('content.list.fields.TOTALCOMMENTS'), sortable: 'pressRelease.totalComments', filter: { 'pressRelease.totalComments': 'number' }, show: $scope.getParamValue('total_comments_show_filed', false), getValue: $scope.textValue },
            { field: 'total_ratings', title: $filter('translate')('content.list.fields.TOTALRATINGS'), sortable: 'pressRelease.totalRatings', filter: { 'pressRelease.totalRatings': 'number' }, show: $scope.getParamValue('total_ratings_show_filed', false), getValue: $scope.textValue },
            { field: 'average_ratings', title: $filter('translate')('content.list.fields.AVERAGERATINGS'), sortable: 'pressRelease.averageRatings', filter: { 'pressRelease.averageRatings': 'number' }, show: $scope.getParamValue('average_ratings_show_filed', false), getValue: $scope.textValue },
            { field: 'total_likes', title: $filter('translate')('content.list.fields.TOTALLIKES'), sortable: 'pressRelease.totalLikes', filter: { 'pressRelease.totalLikes': 'number' }, show: $scope.getParamValue('total_likes_show_filed', false), getValue: $scope.textValue },
            { field: 'total_dislikes', title: $filter('translate')('content.list.fields.TOTALDISLIKES'), sortable: 'pressRelease.totalDislikes', filter: { 'pressRelease.totalDislikes': 'number' }, show: $scope.getParamValue('total_dislikes_show_filed', false), getValue: $scope.textValue },
            { field: 'total_bookmarks', title: $filter('translate')('content.list.fields.TOTALBOOKMARKS'), sortable: 'pressRelease.totalBookmarks', filter: { 'pressRelease.totalBookmarks': 'number' }, show: $scope.getParamValue('total_bookmarks_show_filed', false), getValue: $scope.textValue },
            { field: 'total_shares', title: $filter('translate')('content.list.fields.TOTALSHARES'), sortable: 'pressRelease.totalShares', filter: { 'pressRelease.totalShares': 'number' }, show: $scope.getParamValue('total_shares_show_filed', false), getValue: $scope.textValue },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'pressRelease.createdAt', filter: { 'pressRelease.createdAt': 'number' }, show: $scope.getParamValue('created_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.username', filter: { 'pressRelease.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('creator_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'pressRelease.modifiedAt', filter: { 'pressRelease.modifiedAt': 'number' }, show: $scope.getParamValue('modified_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modifier_user', title: $filter('translate')('content.list.fields.MODIFIERUSER'), sortable: 'modifier_user.username', filter: { 'pressRelease.modifierUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('modifier_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { title: $filter('translate')('content.common.ACTIONS'), show: true, getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<div class="btn-group pull-right">'
            +'<button type="button" class="btn btn-info" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.EDITOR')+'" ng-click="editor(row)"><i class="ti-layout-sidebar-none"></i></button>'
            +'<button type="button" class="btn btn-success" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.EDIT')+'" ng-click="edit(row)"><i class="ti-pencil-alt"></i></button>'
            +'<button type="button" class="btn btn-warning" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.SHOWDETAILS')+'" ng-click="details(row)"><i class="ti-clipboard"></i></button>'
            +'<button type="button" class="btn btn-danger" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.REMOVE')+'" ng-click="delete(row)"><i class="ti-trash"></i></button>'
            +'<button type="button" class="btn btn-info" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.SEND')+'" ng-click="send(row)"><i class="ti-comment-alt"></i></button>'
            +'<button type="button" class="btn btn-success" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.STATS')+'" ng-click="stats(row)"><i class="ti-list-ol"></i></button>'
+'</div>') }
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
        sorting: $scope.getParamValue('sorting', {'pressRelease.createdAt': 'desc'}),
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
            return $pressReleasesDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERPRESSRELEASE'),
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
                $pressReleasesDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.PRESSRELEASEDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.PRESSRELEASENOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.PRESSRELEASENOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.prmanager.pressreleasesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.prmanager.pressreleasesedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.prmanager.pressreleasesdetails', {id: row.id});
    };

    $scope.send = function(row) {
        $state.go('app.prmanager.pressreleasessend', {id: row.id});
    };

    $scope.stats = function(row) {
        $state.go('app.prmanager.pressreleasesstats', {id: row.id});
    };

}]);

