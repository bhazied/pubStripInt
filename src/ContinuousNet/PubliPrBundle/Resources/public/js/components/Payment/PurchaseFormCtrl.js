'use strict';
app.controller('PurchaseFormCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$purchaseDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory, $purchaseDataFactory){
        $scope.purchase = {};
        $scope.initPurchase = function(){
            var def = $q.defer();
            $scope.purchase.currency = '';
            $purchaseDataFactory.getSettings().$promise.then(function(data){
                $scope.purchase.currency = data.default_currency;
                //def.resolve( $scope.purchase.currency )
            });
        }

        $scope.initPurchase();
    }
]);