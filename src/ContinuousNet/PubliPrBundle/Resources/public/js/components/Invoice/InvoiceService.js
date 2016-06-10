'use strict';

/**
 * Invoice Data Factory
 */
app.factory('$invoiceDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL , {} ,{
            invoiceInfos: { method: 'GET', url: $rootScope.app.apiURL+'getInvoice/:paymentId/:isNormal'},
        });

    }]);