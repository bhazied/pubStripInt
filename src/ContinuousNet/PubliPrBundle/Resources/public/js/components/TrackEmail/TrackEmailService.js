'use strict';

/**
 * Track Emails Data Factory
 */
app.factory('$trackEmailsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'trackemails', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'trackemails/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'trackemails/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'trackemails/:id' }
    });
   
}]);
