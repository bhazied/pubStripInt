'use strict';

/**
 * Controller for Payments List
 */

app.controller('PaymentsCtrl', ['$scope', '$rootScope', '$sce', '$timeout', '$filter', 'ngTableParams', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$productsDataFactory', '$usersDataFactory', '$paymentsDataFactory',
function($scope, $rootScope, $sce, $timeout, $filter, ngTableParams, $state, $q, $interpolate, $localStorage, toaster, SweetAlert, $productsDataFactory, $usersDataFactory, $paymentsDataFactory) {

    $scope.isFiltersVisible = false;


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

    $scope.products = [];
    $scope.productsLoaded = false;

    $scope.getProducts = function() {
        $scope.productsLoaded = true;
        if ($scope.products.length == 0) {
            $scope.products.push({});
            var def = $q.defer();
            $productsDataFactory.query({offset: 0, limit: 10000, 'order_by[product.id]': 'desc'}).$promise.then(function(data) {
                $timeout(function(){
                    if (data.results.length > 0) {
                        $scope.products.length = 0;
                        for (var i in data.results) {
                            $scope.products.push({
                                id: data.results[i].id,
                                title: data.results[i].name
                            });
                        }
                        def.resolve($scope.products);
                    }
                });
            });
            return def;
        } else {
            return $scope.products;
        }
    };

    $scope.getProducts();

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
            field: this.field,
            title: this.title,
            sortable: this.sortable,
            filter: this.filter,
            show: this.show
        });
    };

    $scope.setParamValue = function(param, newValue) {
        $localStorage.paymentsParams[param] = newValue;
    };

    $scope.getParamValue = function(param, defaultValue) {
        if (!angular.isDefined($localStorage.paymentsParams)) {
           $localStorage.paymentsParams = {};
        }
        if (angular.isDefined($localStorage.paymentsParams[param])) {
            return $localStorage.paymentsParams[param];
        } else {
            $localStorage.paymentsParams[param] = defaultValue;
            return defaultValue;
        }
    };

    $scope.setCols = function() {
        $scope.cols = [
            { field: 'id', title: $filter('translate')('content.list.fields.ID'), sortable: 'payment.id', filter: { 'payment.id': 'number' }, show: $scope.getParamValue('id_show_filed', true), getValue: $scope.textValue },
            { field: 'ip', title: $filter('translate')('content.list.fields.IP'), sortable: 'payment.ip', filter: { 'payment.ip': 'text' }, show: $scope.getParamValue('ip_show_filed', true), getValue: $scope.textValue },
            { field: 'amount', title: $filter('translate')('content.list.fields.AMOUNT'), sortable: 'payment.amount', filter: { 'payment.amount': 'number' }, show: $scope.getParamValue('amount_show_filed', true), getValue: $scope.textValue },
            { field: 'currency', title: $filter('translate')('content.list.fields.CURRENCY'), sortable: 'payment.currency', filter: { 'payment.currency': 'text' }, show: $scope.getParamValue('currency_show_filed', true), getValue: $scope.textValue },
            { field: 'status', title: $filter('translate')('content.list.fields.STATUS'), sortable: 'payment.status', filter: { 'payment.status': 'text' }, show: $scope.getParamValue('status_show_filed', true), getValue: $scope.textValue },
            { field: 'discount_code', title: $filter('translate')('content.list.fields.DISCOUNTCODE'), sortable: 'payment.discountCode', filter: { 'payment.discountCode': 'text' }, show: $scope.getParamValue('discount_code_show_filed', true), getValue: $scope.textValue },
            { field: 'invoice_number', title: $filter('translate')('content.list.fields.INVOICENUMBER'), sortable: 'payment.invoiceNumber', filter: { 'payment.invoiceNumber': 'text' }, show: $scope.getParamValue('invoice_number_show_filed', true), getValue: $scope.textValue },
            { field: 'details', title: $filter('translate')('content.list.fields.DETAILS'), sortable: 'payment.details', filter: { 'payment.details': 'text' }, show: $scope.getParamValue('details_show_filed', false), getValue: $scope.textValue },
            { field: 'note', title: $filter('translate')('content.list.fields.NOTE'), sortable: 'payment.note', filter: { 'payment.note': 'text' }, show: $scope.getParamValue('note_show_filed', false), getValue: $scope.textValue },
            { field: 'is_valid', title: $filter('translate')('content.list.fields.ISVALID'), sortable: 'payment.isValid', filter: { 'payment.isValid': 'select' }, show: $scope.getParamValue('is_valid_show_filed', false), getValue: $scope.interpolatedValue, filterData : $scope.booleanOptions, interpolateExpr: $interpolate('<span my-boolean="[[ row.is_valid ]]"></span>') },
            { field: 'product', title: $filter('translate')('content.list.fields.PRODUCT'), sortable: 'product.name', filter: { 'payment.product': 'select' }, getValue: $scope.linkValue, filterData: $scope.getProducts(), show: $scope.getParamValue('product_id_show_filed', false), displayField: 'name', state: 'app.billing.productsdetails' },
            { field: 'start_date', title: $filter('translate')('content.list.fields.STARTDATE'), sortable: 'payment.startDate', filter: { 'payment.startDate': 'text' }, show: $scope.getParamValue('start_date_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'end_date', title: $filter('translate')('content.list.fields.ENDDATE'), sortable: 'payment.endDate', filter: { 'payment.endDate': 'text' }, show: $scope.getParamValue('end_date_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'token', title: $filter('translate')('content.list.fields.TOKEN'), sortable: 'payment.token', filter: { 'payment.token': 'text' }, show: $scope.getParamValue('token_show_filed', false), getValue: $scope.textValue },
            { field: 'creator_user', title: $filter('translate')('content.list.fields.CREATORUSER'), sortable: 'creator_user.username', filter: { 'payment.creatorUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('creator_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'created_at', title: $filter('translate')('content.list.fields.CREATEDAT'), sortable: 'payment.createdAt', filter: { 'payment.createdAt': 'text' }, show: $scope.getParamValue('created_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
            { field: 'modifier_user', title: $filter('translate')('content.list.fields.MODIFIERUSER'), sortable: 'modifier_user.username', filter: { 'payment.modifierUser': 'select' }, getValue: $scope.linkValue, filterData: $scope.getUsers(), show: $scope.getParamValue('modifier_user_id_show_filed', false), displayField: 'username', state: 'app.access.usersdetails' },
            { field: 'modified_at', title: $filter('translate')('content.list.fields.MODIFIEDAT'), sortable: 'payment.modifiedAt', filter: { 'payment.modifiedAt': 'text' }, show: $scope.getParamValue('modified_at_show_filed', false), getValue: $scope.evaluatedValue, valueFormatter: 'date:\''+$filter('translate')('formats.DATETIME')+'\''},
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
        sorting: $scope.getParamValue('sorting', {'payment.createdAt': 'desc'}),
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
            return $paymentsDataFactory.query(http_params).$promise.then(function(data) {
                params.total(data.inlineCount);
                return data.results;
            });
        }
    });

    $scope.delete = function(row) {
        SweetAlert.swal({
            title: $filter('translate')('content.common.AREYOUSURE'),
            text: $filter('translate')('content.list.YOUWILLNOTBEABLETORECOVERPAYMENT'),
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
                $paymentsDataFactory.remove(row).$promise.then(function(data) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.DELETED'), 
                        text: $filter('translate')('content.list.PAYMENTDELETED'), 
                        type: 'success',
                        confirmButtonColor: '#007AFF'
                    });
                    $scope.tableParams.reload();
                }, function(error) {
                    SweetAlert.swal({
                        title: $filter('translate')('content.common.ERROR'), 
                        text: $filter('translate')('content.list.PAYMENTNOTDELETED'), 
                        type: 'warning',
                        confirmButtonColor: '#007AFF'
                    });
                });
            } else {
                SweetAlert.swal({
                    title: $filter('translate')('content.common.CANCELLED'), 
                    text: $filter('translate')('content.list.PAYMENTNOTDELETED'), 
                    type: 'error',
                    confirmButtonColor: '#007AFF'
                });
            }
        });
    };

    $scope.add = function() {
        $state.go('app.billing.paymentsnew');
    };

    $scope.edit = function(row) {
        $state.go('app.billing.paymentsedit', {id: row.id});
    };

    $scope.details = function(row) {
        $state.go('app.billing.paymentsdetails', {id: row.id});
    };

}]);

