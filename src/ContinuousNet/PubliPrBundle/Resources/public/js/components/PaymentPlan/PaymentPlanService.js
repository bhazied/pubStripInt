'use strict';

/**
 * Payment Plans Data Factory
 */
app.factory('$paymentPlansDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'paymentplans', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'paymentplans/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'paymentplans/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'paymentplans/:id' }
    });
   
}]);
