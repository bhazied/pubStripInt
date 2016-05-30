/**
 * Created by dev03 on 26/05/16.
 */
'use strict';
app.controller('InvoiceCtrl',['$scope', '$rootScope','$stateParams', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', '$paymentsDataFactory','$invoiceDownloadFactory',
    function($scope, $rootScope, $stateParams, $sce, $timeout, $filter, $state, $q, $localStorage, toaster,  $paymentsDataFactory, $invoiceDownloadFactory) {

        $scope.invoice = {};
        if(angular.isDefined($stateParams.id)){
            var def = $q.defer();
            $paymentsDataFactory.get({id: $stateParams.id}).$promise.then(function (data) {
                $scope.invoice = data;
                def.resolve($scope.invoice);
            })
        }

        $scope.exportInvoice = function (paymentId) {
            var deferred = $q.defer();
            var url = $state.href("pdf", {}, {absolute: true});
            console.log(url);
            var params = {url : url, paymentId : paymentId};
            $invoiceDownloadFactory.download(params).$promise.then(function(data){
                saveAs(data.blob, data.fileName);
                deferred.resolve(data.fileName);
            });
        }
    }
]);
