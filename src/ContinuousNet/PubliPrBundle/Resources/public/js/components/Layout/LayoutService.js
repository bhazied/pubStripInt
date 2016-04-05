'use strict';

/**
 * Layouts Data Factory
 */
app.factory('$layoutsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'layouts', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'layouts/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'layouts/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'layouts/:id' }
    });
   
}]);
