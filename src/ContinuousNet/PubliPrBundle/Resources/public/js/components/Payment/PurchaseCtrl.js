'use strict';
app.controller('PurchaseCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory, $purchaseDataFactory){

        $scope.products = [];
        $scope.productLoaded = false;
        $scope.totaleProducts = 0;
        $scope.payed = false;
        $scope.recurrent = false;
        $scope.hasPayed = function() {
            $purchaseDataFactory.checkPayment().$promise.then(function(data){

                $scope.payed = data.validate;
                $scope.payment = data;

                if (!$scope.payed && !$scope.recurrent) {
                    $scope.loadProducts();
                }
                $localStorage.recurrent = $scope.recurrent;
                $localStorage.product = $scope.payed;

            });
        };

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

        $scope.doPayment = function(product) {
            if (angular.isDefined(product)){
                $localStorage.purchaseProduct = product;
                $state.go('app.billing.purchasenew');
            }
        }

        $scope.recurrentPayment = function(){
            $state.go('app.billing.recurrent')
        }
    }
]);