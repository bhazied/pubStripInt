'use strict';

/**
 * Companies Data Factory
 */
app.factory('$companiesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'companies', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'companies/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'companies/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'companies/:id' }
    });
   
}]);
