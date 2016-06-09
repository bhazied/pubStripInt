'use strict';

/**
 * Controller for User Payment Plans List
 */

app.controller('UserPaymentPlansCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$usersDataFactory', '$paymentPlansDataFactory', '$userPaymentPlansDataFactory','$purchaseDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $usersDataFactory, $paymentPlansDataFactory, $userPaymentPlansDataFactory, $purchaseDataFactory) {

    $scope.isFiltersVisible = false;

    $scope.statuses = [{
        id: 'Active',
        title: $filter('translate')('content.list.fields.statuses.ACTIVE'),
        css: 'primary'
    }, {
        id: 'Disabled',
        title: $filter('translate')('content.list.fields.statuses.DSABLE'),
        css: 'success'
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

    $scope.paymentPlans = [];
    $scope.paymentPlansLoaded = false;

    $scope.getPaymentPlans = function() {
        $scope.paymentPlansLoaded = true;
        if ($scope.paymentPlans.length == 0) {
            $scope.paymentPlans.push({});
            var def = $q.defer();
            $paymentPlansDataFactory.query({offset: 0, limit: 10000, 'order_by[paymentPlan.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.paymentPlans.length = 0;
                        for (var i in data.results) {
                            $scope.paymentPlans.push({
                                id: data.results[i].id,
                                title: data.results[i].name
                            });
                        }
                        def.resolve($scope.paymentPlans);
                    }
                });
            });
            return def;
        } else {
            return $scope.paymentPlans;
        }
    };

    $scope.getPaymentPlans();


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
        $localStorage.userPaymentPlansParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.userPaymentPlansParams)) {
           $localStorage.userPaymentPlansParams = {};
        }
        if (angular.isDefined($localStorage.userPaymentPlansParams[param])) {
            return $localStorage.userPaymentPlansParams[param];
        } else {
            $localStorage.userPaymentPlansParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'userPaymentPlan.id', filter: { 'userPaymentPlan.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'user', title: $filter('translate')('content.list.fields.USER'), sortable: 'user.username', filter: { 'userPaymentPlan.user': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('user_id_show_filed', true), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'payment_plan', title: $filter('translate')('content.list.fields.PAYMENTPLAN'), sortable: 'payment_plan.name', filter: { 'userPaymentPlan.paymentPlan': 'select' }, getValue: $scope.linkValue, filterData: $scope.getPaymentPlans(), show: $scope.getParamValue('payment_plan_id_show_filed', true), displayField: 'name', state: 'app.billing.paymentplansdetails' },
            { field: 'stripe_reference', title: $filter('translate')('content.list.fields.STRIPEREFERENCE'), sortable: 'userPaymentPlan.stripeReference', filter: { 'userPaymentPlan.stripeReference': 'text' }, show: $scope.getParamValue('stripe_reference_show_filed', true), getValue: $scope.textValue },
            { field: 'status', title: $filter('translate')('content.list.fields.STATUS'), sortable: 'userPaymentPlan.status', filter: { 'userPaymentPlan.status': 'select' }, show: $scope.getParamValue('status_show_filed', true), getValue: $scope.interpolatedValue, filterData : $scope.statuses, interpolateExpr: $interpolate('<span my-enum="[[ row.status ]]" my-enum-list=\'[[ statuses ]]\'></span>') },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'userPaymentPlan.createdAt', filter: { 'userPaymentPlan.createdAt': 'number' }, show: $scope.getParamValue('created_at_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'userPaymentPlan.modifiedAt', filter: { 'userPaymentPlan.modifiedAt': 'number' }, show: $scope.getParamValue('modified_at_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'close_date', title: $filter('translate')('content.list.fields.CLOSEDATE'), sortable: 'userPaymentPlan.closeDate', filter: { 'userPaymentPlan.closeDate': 'number' }, show: $scope.getParamValue('close_date_show_filed', true), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { title: $filter('translate')('content.common.ACTIONS'), show: true, getValue: $scope.interpolatedValue, interpolateExpr: $interpolate('<div class="btn-group pull-right"><button type="button" class="btn btn-info" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.INVOICE')+'" ng-click="invoice(row)"><i class="ti-money"></i></button><button type="button" class="btn btn-danger" tooltip-placement="top" uib-tooltip="'+$filter('translate')('content.common.UNSUBSCRIBE')+'" ng-click="unsubscribe(row)" ng-if="row.status==\'Active\'"><i class="ti-trash"></i></button></div>') }
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
        sorting: $scope.getParamValue('sorting', {'userPaymentPlan.createdAt': 'desc'}),
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
            return $userPaymentPlansDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.unsubscribe = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERRECURRENTPAYMENT'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: $filter('translate')('content.common.YESUNSUBSCRIBE'),
            cancelButtonText: $filter('translate')('content.common.NOCANCEL'),
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {
                $purchaseDataFactory.unsubscribe(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.UNSUBSCRIBED'),
                        text: $filter('translate')('content.list.YOURAREUNSUBSCRIBEDFROMRECURRENTPAYMENT'),
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.RECURRENTUNSUBSCRIBED'),
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.RECURRENTNOTUNSUBSCRIBED'),
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.invoice = function(row) {
        $state.go('app.billing.invoice', {id: row.id});
    };


}]);

