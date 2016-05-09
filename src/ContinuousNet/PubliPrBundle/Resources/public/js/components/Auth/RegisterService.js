'use strict';

/**
 * Register Data Factory
 */
app.factory('$registerDataFactory', ['$resource', '$rootScope', '$rootScope', '$localStorage',
    function($resource, $rootScope, $localStorage) {
        var url = $rootScope.app.apiURL + $rootScope.app.apiVersion;
        return $resource(url, {locale: '@locale'}, {
            register: { method: 'POST', url: '/:locale' + url + 'register'},
            checkLicenceKey: { method: 'POST', url: '/:locale' + url + 'checkLicenceKey'},
            checkEmail: { method: 'POST', url: '/:locale' + url + 'checkEmail'},
            countries: { method: 'GET', url: '/:locale' + url + 'countries', isArray:true},
            emailConfirm: { method: 'POST', url: '/:locale' + url + 'emailConfirm'}
        });
    }
]);
