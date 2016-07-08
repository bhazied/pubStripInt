'use strict';

/**
 * Dashboard Data Factory
 */
app.factory('$dashboardDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'dashboard', { periode: '@periode', locale: '@locale'}, {
            getData: { method: 'GET' },
            progressPr: { method : 'GET', url: $rootScope.app.apiURL+ 'progressPr', isArray:false},
            lastPpr: { method : 'GET', url: $rootScope.app.apiURL+ 'lastPpr', isArray:false},
            loadEmails: {method: 'GET',url: $rootScope.app.apiURL+ 'loadEmails/:periode', isArray: false},
            loadVisits: {method: 'GET',url: $rootScope.app.apiURL+ 'loadVisits/:periode', isArray: false},
            loadProfile: {method: "GET", url: '/:locale' +$rootScope.app.apiURL+ $rootScope.app.apiVersion+ 'getProfile', isArray: false },
        });

    }
]);
