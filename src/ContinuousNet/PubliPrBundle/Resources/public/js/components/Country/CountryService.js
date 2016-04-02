'use strict';

/**
 * Countries Data Factory
 */
app.factory('$countriesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'countries', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'countries/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'countries/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'countries/:id' }
    });
   
}]);
