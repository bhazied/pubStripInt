'use strict';

/**
 * Newsroom Templates Data Factory
 */
app.factory('$newsroomTemplatesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'newsroomtemplates', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'newsroomtemplates/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'newsroomtemplates/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'newsroomtemplates/:id' }
    });
   
}]);
