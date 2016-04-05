'use strict';

/**
 * Login Data Factory
 */
app.factory('$loginDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'login_check', {}, {
            check: { method: 'POST' }
        });

    }
]);
