'use strict';

/**
 * Email Campaigns Data Factory
 */
app.factory('$emailCampaignsDataFactory', ['$resource', '$rootScope', 
function($resource, $rootScope) {

   return $resource($rootScope.app.apiURL + 'emailcampaigns', {id: '@id'}, {
        create: { method: 'POST', isArray: false},
        query: { method: 'GET'},
        get: { method: 'GET', url: $rootScope.app.apiURL + 'emailcampaigns/:id' },
        remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'emailcampaigns/:id' },
        update: { method: 'PUT', url: $rootScope.app.apiURL + 'emailcampaigns/:id' }
    });
   
}]);
