'use strict';

/**
 * Newsrooms Data Factory
 */
app.factory('$newsroomsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'newsrooms', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'newsrooms/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'newsrooms/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'newsrooms/:id' }
    });
   
}]);
