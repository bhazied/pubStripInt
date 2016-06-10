'use strict'
app.controller('recurrentCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert','$userPaymentPlansDataFactory','$paymentPlansDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $userPaymentPlansDataFactory, $paymentPlansDataFactory, $purchaseDataFactory) {

        $scope.recurrentPayments = [];
        $scope.recurrentLoaded = false;
        $scope.paymentPlan = {};
        $scope.loadRecurrentPayments = function () {
            if($scope.recurrentPayments.length == 0){
                var def = $q.defer();
                $paymentPlansDataFactory.query({offset: 0, limit: 10000, 'order_by[paymentPlan.name]': 'asc'}).$promise.then(function (data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                        if(data.results[i].status == "Active"){
                            $scope.recurrentPayments[i] = data.results[i];
                        }

                        def.resolve($scope.recurrentPayments);
                    }
                    return def;
                });
            }
            else {
                return $scope.recurrentPayments;
            }
        }

        $scope.loadRecurrentPayments();

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
            console.log($scope.paymentPlan);
            var def = $q.defer();
            $purchaseDataFactory.sendRecurrent($scope.paymentPlan).$promise.then(function (data) {
                console.log(data);
                if(!data.hasError){
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('payment.SUCCESS'));
                    $state.go("app.billing.userpaymentplans");
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
        template: '<select name="cardYearExpr" id="paymentPlanYearExpr" class="form-control" ng-model="paymentPlan.cardYearExpr" ng-options="y for y in years" ng-required="true"> </select>'
    }
});