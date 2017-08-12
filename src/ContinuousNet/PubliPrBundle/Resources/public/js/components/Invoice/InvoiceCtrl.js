/**
 * Created by dev03 on 26/05/16.
 */
'use strict';
app.controller('InvoiceCtrl',['$scope', '$rootScope','$stateParams', '$sce', '$timeout', '$filter', '$state', '$q', '$localStorage', 'toaster', 'SweetAlert', '$paymentsDataFactory','$invoiceDownloadFactory','$invoiceDataFactory',
    function($scope, $rootScope, $stateParams, $sce, $timeout, $filter, $state, $q, $localStorage, toaster,SweetAlert,  $paymentsDataFactory, $invoiceDownloadFactory, $invoiceDataFactory) {

        $scope.invoice = {};
        $scope.normalPayment = $localStorage.normal_payment ? 1 : 0;
        if(angular.isDefined($stateParams.id)){
            var def = $q.defer();
            $invoiceDataFactory.invoiceInfos({paymentId: $stateParams.id, isNormal: $scope.normalPayment}).$promise.then(function (data) {
                $scope.invoice = data;
                def.resolve($scope.invoice);
            });

        }

        $scope.exportInvoice = function (paymentId) {
            $scope.disableExport = true;
            var deferred = $q.defer();
            var url = $state.href("pdf", {}, {absolute: true});
            console.log(url);
            var params = {url : url, paymentId : paymentId, isNormal: $scope.normalPayment};
            $invoiceDownloadFactory.download(params).$promise.then(function(data){
        if(data.blob.size > 0){
                    saveAs(data.blob, data.fileName);
                    deferred.resolve(data.fileName);
                    $scope.disableExport = false;
                }else{
                    SweetAlert.swal(
                        $filter('translate')('payment.invoice.DOWNLOADERRORTITLE'),
                        $filter('translate')('payment.invoice.DOWNLOADERRORBODY'),
                        "error"
                    );
                    $scope.disableExport = false;
                    return false;
                }
            });
        }
    }
]);
