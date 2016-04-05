'use strict';

/**
 * Reset password Data Factory
 */
app.factory('$resetPasswordDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {
        var url = $rootScope.app.apiURL + $rootScope.app.apiVersion;
        return $resource(url, {locale: '@locale'}, {
            request: { method: 'POST', url: '/:locale' + url + 'requestResetPassword'},
            checkConfirmationToken: { method: 'POST', url: '/:locale' + url + 'checkConfirmationToken'},
            reset: { method: 'POST', url: '/:locale' + url + 'reset'}
        });
    }
]);
