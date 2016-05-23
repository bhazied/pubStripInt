'use strict';
app.controller('PurchaseCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory, $purchaseDataFactory){

        $scope.payed = false;
        $scope.hasPayed = function(){
            $purchaseDataFactory.checkPayment().$promise.then(function(data){
                $scope.payed = data.validate;
            });
            if($scope.payed){
                $state.go('app.billing.payments');
            }
            else
            {
                SweetAlert.swal({
                    title: $filter('translate')('payment.warningTitle'),
                    text: $filter('translate')('payment.warningText'),
                    timer : 2000,
                    type: "info"
            });
            }
        }
        $scope.hasPayed();

        $scope.doPayment = function(period){
            if(angular.isDefined(period)){
                $localStorage.purchasePayment = period;
                $state.go('app.billing.purchasenew');
            }
        }
    }
]);