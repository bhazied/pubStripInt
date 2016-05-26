/**
 * Created by dev03 on 26/05/16.
 */
'use strict';
app.controller('InvoiceCtrl',['$scope', '$rootScope','$stateParams', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory',
    function($scope, $rootScope, $stateParams, $sce, $timeout, $filter, $state, $q, $localStorage, toaster, SweetAlert, $paymentsDataFactory) {

        $scope.invoice = {};
        console.log($stateParams.id);
        if(angular.isDefined($stateParams.id)){
            var def = $q.defer();
            $paymentsDataFactory.get({id: $stateParams.id}).$promise.then(function (data) {
                $scope.invoice = data;
                def.resolve($scope.invoice);
            })
        }
        
        $scope.printInvoice = function (id) {
            
        }
    }
]);
