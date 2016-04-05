'use strict';

/**
 * Contact Groups Data Factory
 */
app.factory('$contactGroupsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'contactgroups', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'contactgroups/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'contactgroups/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'contactgroups/:id' }
    });
   
}]);
