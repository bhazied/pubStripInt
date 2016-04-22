'use strict';

/**
 * Controller for Emails List
 */

app.controller('EmailsCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$pressReleasesDataFactory', '$contactsDataFactory', '$usersDataFactory', '$emailsDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $pressReleasesDataFactory, $contactsDataFactory, $usersDataFactory, $emailsDataFactory) {

    $scope.isFiltersVisible = false;

    $scope.sendingStatuses = [{
        id: 'Initialized',
        title: $filter('translate')('content.list.fields.sendingstatuses.INITIALIZED'),
        css: 'primary'
    }, {
        id: 'Sent',
        title: $filter('translate')('content.list.fields.sendingstatuses.SENT'),
        css: 'success'
    }, {
        id: 'Error',
        title: $filter('translate')('content.list.fields.sendingstatuses.ERROR'),
        css: 'warning'
    }];

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
    $scope.showFieldsMenu = false;

    $scope.pressReleases = [];
    $scope.pressReleasesLoaded = false;

    $scope.getPressReleases = function() {
        $scope.pressReleasesLoaded = true;
        if ($scope.pressReleases.length == 0) {
            $scope.pressReleases.push({});
            var def = $q.defer();
            $pressReleasesDataFactory.query({offset: 0, limit: 10000, 'order_by[pressRelease.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.pressReleases.length = 0;
                        for (var i in data.results) {
                            $scope.pressReleases.push({
                                id: data.results[i].id,
                                title: data.results[i].title
                            });
                        }
                        def.resolve($scope.pressReleases);
                    }
                });
            });
            return def;
        } else {
            return $scope.pressReleases;
        }
    };

    $scope.getPressReleases();

    $scope.contacts = [];
    $scope.contactsLoaded = false;

    $scope.getContacts = function() {
        $scope.contactsLoaded = true;
        if ($scope.contacts.length == 0) {
            $scope.contacts.push({});
            var def = $q.defer();
            $contactsDataFactory.query({offset: 0, limit: 10000, 'order_by[contact.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.contacts.length = 0;
                        for (var i in data.results) {
                            $scope.contacts.push({
                                id: data.results[i].id,
                                title: data.results[i].firstName
                            });
                        }
                        def.resolve($scope.contacts);
                    }
                });
            });
            return def;
        } else {
            return $scope.contacts;
        }
    };

    $scope.getContacts();

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
            sendingStatuses: $scope.sendingStatuses,
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.emailsParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.emailsParams)) {
           $localStorage.emailsParams = {};
        }
        if (angular.isDefined($localStorage.emailsParams[param])) {
            return $localStorage.emailsParams[param];
        } else {
            $localStorage.emailsParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'email.id', filter: { 'email.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'press_release', title: $filter('translate')('content.list.fields.PRESSRELEASE'), sortable: 'press_release.title', filter: { 'email.pressRelease': 'select' }, getValue: $scope.linkValue, filterData: $scope.getPressReleases(), show: $scope.getParamValue('press_release_id_show_filed', true), displayField: 'title', state: 'app.prmanager.pressreleasesdetails' },
            { field: 'contact', title: $filter('translate')('content.list.fields.CONTACT'), sortable: 'contact.firstName', filter: { 'email.contact': 'select' }, getValue: $scope.linkValue, filterData: $scope.getContacts(), show: $scope.getParamValue('contact_id_show_filed', true), displayField: 'firstName', state: 'app.contactmanager.contactsdetails' },
            { field: 'email', title: $filter('translate')('content.list.fields.EMAIL'), sortable: 'email.email', filter: { 'email.email': 'text' }, show: $scope.getParamValue('email_show_filed', true), getValue: $scope.textValue },
            { field: 'section', title: $filter('translate')('content.list.fields.SECTION'), sortable: 'email.section', filter: { 'email.section': 'text' }, show: $scope.getParamValue('section_show_filed', true), getValue: $scope.textValue },
            { field: 'sending_status', title: $filter('translate')('content.list.fields.SENDINGSTATUS'), sortable: 'email.sendingStatus', filter: { 'email.sendingStatus': 'select' }, show: $scope.getParamValue('sending_status_show_filed', true), getValue: $scope.interpolatedValue, filterData : $scope.sendingStatuses, interpolateExpr: $interpolate('<span my-enum="[[ row.sending_status ]]" my-enum-list=\'[[ sendingStatuses ]]\'></span>') },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'email.createdAt', filter: { 'email.createdAt': 'text' }, show: $scope.getParamValue('created_at_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.username', filter: { 'email.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('creator_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'email.modifiedAt', filter: { 'email.modifiedAt': 'text' }, show: $scope.getParamValue('modified_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modifier_user', title: $filter('translate')('content.list.fields.MODIFIERUSER'), sortable: 'modifier_user.username', filter: { 'email.modifierUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('modifier_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
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
        sorting: $scope.getParamValue('sorting', {'email.createdAt': 'desc'}),
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
            return $emailsDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVEREMAIL'),
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
                $emailsDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.EMAILDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.EMAILNOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.EMAILNOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.distribution.emailsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.distribution.emailsedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.distribution.emailsdetails', {id: row.id});
    };

}]);

