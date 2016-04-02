'use strict';

/**
 * Languages Data Factory
 */
app.factory('$languagesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'languages', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'languages/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'languages/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'languages/:id' }
    });
   
}]);
