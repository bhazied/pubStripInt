'use strict';

/**
 * Sessions Data Factory
 */
app.factory('$sessionsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'sessions', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'sessions/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'sessions/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'sessions/:id' }
    });
   
}]);
