'use strict';

/**
 * Controller for Faqs List
 */

app.controller('FaqsCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$creatorUsersDataFactory', '$modifierUsersDataFactory', '$faqsDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $creatorUsersDataFactory, $modifierUsersDataFactory, $faqsDataFactory) {

    $scope.isFiltersVisible = false;


    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';
    $scope.showFieldsMenu = false;

    $scope.creatorUsers = [];
    $scope.creatorUsersLoaded = false;

    $scope.getCreatorUsers = function() {
        $scope.creatorUsersLoaded = true;
        if ($scope.creatorUsers.length == 0) {
            $scope.creatorUsers.push({});
            var def = $q.defer();
            $creatorUsersDataFactory.query({offset: 0, limit: 10000, 'order_by[creatorUser.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.creatorUsers.length = 0;
                        for (var i in data.results) {
                            $scope.creatorUsers.push({
                                id: data.results[i].id,
                                title: data.results[i].
                            });
                        }
                        def.resolve($scope.creatorUsers);
                    }
                });
            });
            return def;
        } else {
            return $scope.creatorUsers;
        }
    };

    $scope.getCreatorUsers();

    $scope.modifierUsers = [];
    $scope.modifierUsersLoaded = false;

    $scope.getModifierUsers = function() {
        $scope.modifierUsersLoaded = true;
        if ($scope.modifierUsers.length == 0) {
            $scope.modifierUsers.push({});
            var def = $q.defer();
            $modifierUsersDataFactory.query({offset: 0, limit: 10000, 'order_by[modifierUser.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.modifierUsers.length = 0;
                        for (var i in data.results) {
                            $scope.modifierUsers.push({
                                id: data.results[i].id,
                                title: data.results[i].
                            });
                        }
                        def.resolve($scope.modifierUsers);
                    }
                });
            });
            return def;
        } else {
            return $scope.modifierUsers;
        }
    };

    $scope.getModifierUsers();


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
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.faqsParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.faqsParams)) {
           $localStorage.faqsParams = {};
        }
        if (angular.isDefined($localStorage.faqsParams[param])) {
            return $localStorage.faqsParams[param];
        } else {
            $localStorage.faqsParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'faq.id', filter: { 'faq.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'question', title: $filter('translate')('content.list.fields.QUESTION'), sortable: 'faq.question', filter: { 'faq.question': 'text' }, show: $scope.getParamValue('question_show_filed', false), getValue: $scope.textValue },
            { field: 'response', title: $filter('translate')('content.list.fields.RESPONSE'), sortable: 'faq.response', filter: { 'faq.response': 'text' }, show: $scope.getParamValue('response_show_filed', false), getValue: $scope.textValue },
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.', filter: { 'faq.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getCreatorUsers(), show: $scope.getParamValue('creator_user_id_show_filed', true), displayField: '', state: 'app..details' },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'faq.createdAt', filter: { 'faq.createdAt': 'text' }, show: $scope.getParamValue('created_at_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modifier_user', title: $filter('translate')('content.list.fields.MODIFIERUSER'), sortable: 'modifier_user.', filter: { 'faq.modifierUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getModifierUsers(), show: $scope.getParamValue('modifier_user_id_show_filed', true), displayField: '', state: 'app..details' },
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'faq.modifiedAt', filter: { 'faq.modifiedAt': 'text' }, show: $scope.getParamValue('modified_at_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { title: $filter('translate')('content.common.ACTIONS'), show: true, getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<div class="btn-group pull-right">'
            +'<button type="button" class="btn btn-success" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.EDIT')+'" ng-click="edit(row)"><i class="ti-pencil-alt"></i></button>'
            +'<button type="button" class="btn btn-warning" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.SHOWDETAILS')+'" ng-click="details(row)"><i class="ti-clipboard"></i></button>'
            +'<button type="button" class="btn btn-danger" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.REMOVE')+'" ng-click="delete(row)"><i class="ti-trash"></i></button>'
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
        sorting: $scope.getParamValue('sorting', {'faq.id': 'asc'}),
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
            return $faqsDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERFAQ'),
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
                $faqsDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.FAQDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.FAQNOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.FAQNOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.settings.faqsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.faqsedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.settings.faqsdetails', {id: row.id});
    };

}]);

