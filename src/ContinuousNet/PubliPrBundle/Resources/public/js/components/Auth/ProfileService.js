'use strict';

/**
 * Register Data Factory
 */
app.factory('$profileDataFactory', ['$resource', '$rootScope', '$rootScope', '$localStorage',
    function($resource, $rootScope, $localStorage) {
        
        var url = $rootScope.app.apiURL + $rootScope.app.apiVersion ;
        return $resource(url, {locale: '@locale'}, {
            getProfile: { method: 'GET', url: '/:locale' + url + 'getProfile'},
            updateProfile: { method: 'PUT', url: '/:locale' + url +'updateProfile'},
            changePassword: { method: 'POST', url: '/:locale' + url + 'changePassword'}
            
        });
    }
]);
