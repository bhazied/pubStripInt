'use strict';
app.controller('PurchaseCtrl',['$scope', '$rootScope', '$sce', '$timeout', '$filter', '$state', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory',
    function($scope, $rootScope, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory){

        $scope.payed = false;
        $scope.hasPayed = function(){
            if($scope.payed){
                $state.go('app.billing.payments');
            }
            else
            {
                
            }
        }
        $scope.hasPayed();
    }
]);