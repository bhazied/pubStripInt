'use strict';

/**
 * Purchase Data Factory
 */
app.factory('$purchaseDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL , {} ,{
            checkPayment: { method: 'GET', url: $rootScope.app.apiURL+'CheckSubscription'},
            getSettings: {method: 'GET', url: $rootScope.app.apiURL+'Settings/:product'},
            sendPurchase : {method: 'POST', url: $rootScope.app.apiURL+'SendPurchase', isArray:false},
            getProducts : {method: 'GET', url:$rootScope.app.apiURL+'Products', isArray:false},
            checkUser: {method: 'POST', url:$rootScope.app.apiURL+'CheckUser', isArray:false}
        });

    }]);
