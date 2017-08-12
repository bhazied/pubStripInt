'use strict';

/**
 * User Payment Plans Data Factory
 */
app.factory('$userPaymentPlansDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'userpaymentplans', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'userpaymentplans/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'userpaymentplans/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'userpaymentplans/:id' }
    });
   
}]);
