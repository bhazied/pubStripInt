'use strict';

/**
 * Settings Data Factory
 */
app.factory('$settingsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'settings', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'settings/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'settings/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'settings/:id' }
    });
   
}]);
