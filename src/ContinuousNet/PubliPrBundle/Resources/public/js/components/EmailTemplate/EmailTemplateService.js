'use strict';

/**
 * Email Templates Data Factory
 */
app.factory('$emailTemplatesDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'emailtemplates', {id: '@id'}, {
        create: { method: 'POST' },
        query: { method: 'GET' },
        get: { method: 'GET', url: $rootScope.app.apiURL + 'emailtemplates/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'emailtemplates/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'emailtemplates/:id' }
    });
   
}]);
