'use strict';

/**
 * Contact Importer Service
 */
app.factory('$ContactImporterService', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL + 'contactsImport', {}, {
            uplaod: { method: 'POST', isArray: false}
        });

    }]);
