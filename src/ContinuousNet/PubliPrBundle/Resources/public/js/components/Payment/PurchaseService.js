'use strict';

/**
 * Payments Data Factory
 */
app.factory('$paymentsDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'purchase', {
            purchases: { method: 'GET'},
        });

    }]);
