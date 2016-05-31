'use strict';

/**
 * Emails Data Factory
 */
app.factory('$emailsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'emails', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'emails/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'emails/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'emails/:id' }
    });
   
}]);
