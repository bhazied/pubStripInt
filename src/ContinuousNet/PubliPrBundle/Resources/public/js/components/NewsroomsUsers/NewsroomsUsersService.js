'use strict';

/**
 * Newsrooms Users Data Factory
 */
app.factory('$newsroomsUsersDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'newsroomsusers', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'newsroomsusers/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'newsroomsusers/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'newsroomsusers/:id' }
    });
   
}]);
