'use strict';

/**
 * Fonts Data Factory
 */
app.factory('$fontsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'fonts', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'fonts/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'fonts/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'fonts/:id' }
    });
   
}]);
