'use strict';

/**
 * Purchase Data Factory
 */
app.factory('$purchaseDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL , {} ,{
            checkPayment: { method: 'GET', url: $rootScope.app.apiURL+'CheckSubscription'},
            getSettings: {method: 'GET', url: $rootScope.app.apiURL+'Settings'}
        });

    }]);
