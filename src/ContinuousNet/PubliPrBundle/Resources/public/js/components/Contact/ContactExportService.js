'use strict';

/**
 * Contact Exporter Service
 */
app.factory('$ContactExporterService', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'contactsExport', {}, {
            download: { method: 'POST', isArray: false}
        });

    }]);
