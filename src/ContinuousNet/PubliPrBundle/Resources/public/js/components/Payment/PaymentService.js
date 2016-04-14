'use strict';

/**
 * Payments Data Factory
 */
app.factory('$paymentsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'payments', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'payments/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'payments/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'payments/:id' }
    });
   
}]);
