'use strict';

/**
 * Track Press Releases Data Factory
 */
app.factory('$trackPressReleasesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'trackpressreleases', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'trackpressreleases/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'trackpressreleases/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'trackpressreleases/:id' }
    });
   
}]);
