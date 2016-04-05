'use strict';

/**
 * Contacts Data Factory
 */
app.factory('$contactsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'contacts', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'contacts/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'contacts/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'contacts/:id' }
    });
   
}]);
