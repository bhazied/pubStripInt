'use strict';

/**
 * Contact Exporter Service
 */
app.factory('$ContactExporterService', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'contactsExport', {}, {
            downlaod: { method: 'POST', isArray: false}
        });

    }]);
