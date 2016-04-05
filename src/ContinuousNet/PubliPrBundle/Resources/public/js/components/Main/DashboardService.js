'use strict';

/**
 * Dashboard Data Factory
 */
app.factory('$dashboardDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'dashboard', {}, {
            getData: { method: 'GET' }
        });

    }
]);
