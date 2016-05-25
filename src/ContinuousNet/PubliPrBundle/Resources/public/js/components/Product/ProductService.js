'use strict';

/**
 * Products Data Factory
 */
app.factory('$productsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'products', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'products/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'products/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'products/:id' }
    });
   
}]);
