'use strict';

/**
 * Faqs Data Factory
 */
app.factory('$faqsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'faqs', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'faqs/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'faqs/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'faqs/:id' }
    });
   
}]);
