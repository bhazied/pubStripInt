'use strict';

/**
 * Logs Data Factory
 */
app.factory('$logsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'logs', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'logs/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'logs/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'logs/:id' }
    });
   
}]);
