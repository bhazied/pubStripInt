'use strict';

/**
 * Controller for Logs List
 */

app.controller('LogsCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$sessionsDataFactory', '$usersDataFactory', '$logsDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $sessionsDataFactory, $usersDataFactory, $logsDataFactory) {

    $scope.isFiltersVisible = false;


    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
    $scope.showFieldsMenu = false;

    $scope.sessions = [];
    $scope.sessionsLoaded = false;

    $scope.getSessions = function() {
        $scope.sessionsLoaded = true;
        if ($scope.sessions.length == 0) {
            $scope.sessions.push({});
            var def = $q.defer();
            $sessionsDataFactory.query({offset: 0, limit: 10000, 'order_by[session.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.sessions.length = 0;
                        for (var i in data.results) {
                            $scope.sessions.push({
                                id: data.results[i].id,
                                title: data.results[i].ip
                            });
                        }
                        def.resolve($scope.sessions);
                    }
                });
            });
            return def;
        } else {
            return $scope.sessions;
        }
    };

    $scope.getSessions();

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

    $scope.linkValue = function($scope, row) {
        var value = row[this.field];
        if (value == null || typeof value == 'undefined') {
            return '';
        }
        var html = '<a ui-sref="'+this.state+'({id: ' + row.id + '})">' + value[this.displayField] + '</a>';
        return $sce.trustAsHtml(html);
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
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.logsParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.logsParams)) {
           $localStorage.logsParams = {};
        }
        if (angular.isDefined($localStorage.logsParams[param])) {
            return $localStorage.logsParams[param];
        } else {
            $localStorage.logsParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'log.id', filter: { 'log.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'session', title: $filter('translate')('content.list.fields.SESSION'), sortable: 'session.ip', filter: { 'log.session': 'select' }, getValue: $scope.linkValue, filterData: $scope.getSessions(), show: $scope.getParamValue('session_id_show_filed', true), displayField: 'ip', state: 'app.accesscontrol.sessionsdetails' },
            { field: 'url', title: $filter('translate')('content.list.fields.URL'), sortable: 'log.url', filter: { 'log.url': 'text' }, show: $scope.getParamValue('url_show_filed', true), getValue: $scope.textValue },
            { field: 'method', title: $filter('translate')('content.list.fields.METHOD'), sortable: 'log.method', filter: { 'log.method': 'text' }, show: $scope.getParamValue('method_show_filed', true), getValue: $scope.textValue },
            { field: 'details_before', title: $filter('translate')('content.list.fields.DETAILSBEFORE'), sortable: 'log.detailsBefore', filter: { 'log.detailsBefore': 'text' }, show: $scope.getParamValue('details_before_show_filed', false), getValue: $scope.textValue },
            { field: 'details_after', title: $filter('translate')('content.list.fields.DETAILSAFTER'), sortable: 'log.detailsAfter', filter: { 'log.detailsAfter': 'text' }, show: $scope.getParamValue('details_after_show_filed', false), getValue: $scope.textValue },
            { field: 'note', title: $filter('translate')('content.list.fields.NOTE'), sortable: 'log.note', filter: { 'log.note': 'text' }, show: $scope.getParamValue('note_show_filed', false), getValue: $scope.textValue },
            { field: 'ip_address', title: $filter('translate')('content.list.fields.IPADDRESS'), sortable: 'log.ipAddress', filter: { 'log.ipAddress': 'text' }, show: $scope.getParamValue('ip_address_show_filed', false), getValue: $scope.textValue },
            { field: 'user_agent', title: $filter('translate')('content.list.fields.USERAGENT'), sortable: 'log.userAgent', filter: { 'log.userAgent': 'text' }, show: $scope.getParamValue('user_agent_show_filed', false), getValue: $scope.textValue },
            { field: 'application', title: $filter('translate')('content.list.fields.APPLICATION'), sortable: 'log.application', filter: { 'log.application': 'text' }, show: $scope.getParamValue('application_show_filed', false), getValue: $scope.textValue },
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.username', filter: { 'log.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('creator_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'log.createdAt', filter: { 'log.createdAt': 'text' }, show: $scope.getParamValue('created_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
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
        sorting: $scope.getParamValue('sorting', {'log.createdAt': 'desc'}),
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
            return $logsDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERLOG'),
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
                $logsDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.LOGDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.LOGNOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.LOGNOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.access.logsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.access.logsedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.access.logsdetails', {id: row.id});
    };

}]);

