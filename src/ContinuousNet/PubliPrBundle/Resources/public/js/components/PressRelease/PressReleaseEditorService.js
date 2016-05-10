'use strict';

/**
 * Press Releases Editor Data Factory
 */
app.factory('$pressReleasesEditorDataFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'pressreleases', {id: '@id'}, {
            create: { method: 'POST', isArray: false},
            query: { method: 'GET'},
            get: { method: 'GET', url: $rootScope.app.apiURL + 'pressreleases/:id' },
            remove: { method: 'DELETE', url: $rootScope.app.apiURL + 'pressreleases/:id' },
            update: { method: 'PUT', url: $rootScope.app.apiURL + 'pressreleases/:id' }
        });

    }]);
