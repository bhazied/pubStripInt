'use strict';

/**
 * Press Releases Data Factory
 */
app.factory('$pressReleasesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'pressreleases', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'pressreleases/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'pressreleases/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'pressreleases/:id' }
    });
   
}]);
