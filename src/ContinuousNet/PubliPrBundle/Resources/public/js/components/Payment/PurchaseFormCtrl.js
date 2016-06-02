'use strict';
app.controller('PurchaseFormCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory, $purchaseDataFactory){
        $scope.purchase = {};
        $scope.settingsLoaded = false;
        
        $scope.checkUser = function () {
            var def = $q.defer();
            $purchaseDataFactory.checkUser().$promise.then(function (data) {
                if(!data.checked){
                    SweetAlert.swal({
                        title: $filter('translate')('payment.PROFILENOTCOMPLETE'),
                        text:  $filter('translate')('payment.PROFILENOTCOMPLETETEXT'),
                        //timer : 2000,
                        type: 'warning'
                    });
                    $state.go('app.profile');
                }
            });
        }
        $scope.checkUser();

        $scope.initPurchase = function(){
            var def = $q.defer();
            $scope.purchase.currency = '';
            if(angular.isDefined($localStorage.purchaseProduct)){
                var params = {product: $localStorage.purchaseProduct};
                $purchaseDataFactory.getSettings(params).$promise.then(function(data){
                    $scope.purchase.currency = data.defaultCurrency;
                    $scope.purchase.price = data.sku.price;
                    $scope.purchase.skuId = data.sku.id;
                    $scope.purchase.productStripeId = $localStorage.purchaseProduct;
                    $scope.sku = data.sku;
                });
            }
        }

        $scope.initPurchase();

        $scope.CardMonthExpr = [
           // {id : '',   value: $filter('translate')('payment.MONTHS.SELECTMONTH')},
            {id : '01', text: $filter('translate')('payment.MONTHS.JANURAY')},
            {id : '02', text: $filter('translate')('payment.MONTHS.FEBRUARY')},
            {id : '03', text: $filter('translate')('payment.MONTHS.MARCH')},
            {id : '04', text: $filter('translate')('payment.MONTHS.APRIL')},
            {id : '05', text: $filter('translate')('payment.MONTHS.MAY')},
            {id : '06', text: $filter('translate')('payment.MONTHS.JUNE')},
            {id : '07', text: $filter('translate')('payment.MONTHS.JULY')},
            {id : '08', text: $filter('translate')('payment.MONTHS.AUGUST')},
            {id : '09', text: $filter('translate')('payment.MONTHS.SEPTEMBER')},
            {id : '10', text: $filter('translate')('payment.MONTHS.OCTOBER')},
            {id : '11', text: $filter('translate')('payment.MONTHS.NOVEMBER')},
            {id : '12', text: $filter('translate')('payment.MONTHS.DECEMBER')},
        ];

        $scope.submitForm = function(form){
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
            }
            else {
                $scope.disableSubmit = true;
                var def = $q.defer();
                $purchaseDataFactory.sendPurchase($scope.purchase).$promise.then(function (data) {
                  if(!data.hasError){
                      $scope.disableSubmit = false;
                      $state.go("app.billing.invoice", {id: data.paymentId});
                  }
                    else{
                       SweetAlert.swal({
                           title: 'Error',
                           text: data.message,
                           type : 'error'
                       });
                      $scope.disableSubmit = false;
                  }
                });
                return false;
            }
        }
    }
]);

app.directive('yearDrop',function(){
    function getYears(offset, range){
        var currentYear = new Date().getFullYear();
        var years = [];
        for (var i = 0; i < range + 1; i++){
            years.push(currentYear + offset + i);
        }
        return years;
    }
    return {
        link: function(scope,element,attrs){
            scope.years = getYears(+attrs.offset, +attrs.range);
            scope.selected = scope.years[0];
        },
        template: '<select name="cardYearExpr" id="purchaseCardYearExpr" class="form-control" ng-model="purchase.cardYearExpr" ng-options="y for y in years" ng-required="true"> </select>'
    }
});