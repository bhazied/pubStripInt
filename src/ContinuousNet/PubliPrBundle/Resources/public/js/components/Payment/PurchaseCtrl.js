'use strict';
app.controller('PurchaseCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory, $purchaseDataFactory){

        $scope.products = [];
        $scope.productLoaded = false;
        $scope.totaleProducts = 0;
        $scope.payed = false;
        $scope.hasPayed = function(){
            $purchaseDataFactory.checkPayment().$promise.then(function(data){
                $scope.payed = data.validate;
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
            });
        }


        $scope.hasPayed();

        $scope.loadProducts = function(){
            $scope.productLoaded = true;
                if($scope.products.length == 0){
                    var def = $q.defer();
                    $scope.products.push({});
                    $purchaseDataFactory.getProducts().$promise.then(function (data) {
                        $scope.products = data.results;
                        def.resolve($scope.products);
                    });
                }
        }
        if(!$scope.payed){
            $scope.loadProducts();
        }

        $scope.doPayment = function(product){
            if(angular.isDefined(product)){
                $localStorage.purchaseProduct = product;
                $state.go('app.billing.purchasenew');
            }
        }
    }
]);