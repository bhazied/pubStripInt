'use strict';

/**
 * Users Data Factory
 */
app.factory('$usersDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'users', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'users/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'users/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'users/:id' }
    });
   
}]);
