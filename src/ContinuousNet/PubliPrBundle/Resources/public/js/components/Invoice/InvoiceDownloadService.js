'use strict';

/**
 * Press Releases Data Factory
 */
app.factory('$invoiceDownloadFactory', ['$resource', '$rootScope',
    function($resource, $rootScope) {

        return $resource($rootScope.app.apiURL, {},  {
            download: { method: 'POST',
                url: $rootScope.app.apiURL + 'downloadInvoice',
                headers: {
                    accept: 'application/pdf'
                },
                responseType: 'arraybuffer',
                transformResponse: function (data, headers) {
                    if(data){
                        var pdf = null;
                        pdf = new Blob([data], {type:'application/pdf'});
                    }
                    var fileName = 'Invoice.pdf';
                    var disposition = headers('Content-Disposition');
                    if (disposition) {
                        var match = disposition.match(/.*filename=\"?([^;\"]+)\"?.*/);
                        if (match[1])
                            fileName = match[1];
                    }
                    var fileName = fileName.replace(/[<>:"\/\\|?*]+/g, '_');
                    var result = {
                        blob : pdf,
                        fileName : fileName
                    };
                    return result;
                }
            },
        });

    }]);
