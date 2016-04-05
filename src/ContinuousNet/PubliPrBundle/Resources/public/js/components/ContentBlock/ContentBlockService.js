'use strict';

/**
 * Content Blocks Data Factory
 */
app.factory('$contentBlocksDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'contentblocks', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'contentblocks/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'contentblocks/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'contentblocks/:id' }
    });
   
}]);
