'use strict';

/**
 * Templates Data Factory
 */
app.factory('$templatesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'templates', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'templates/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'templates/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'templates/:id' }
    });
   
}]);
