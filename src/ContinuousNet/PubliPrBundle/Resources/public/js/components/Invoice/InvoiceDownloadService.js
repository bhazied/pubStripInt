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
                    accept: 'application/pdf' //or whatever you need
                },
                responseType: 'arraybuffer',
                transformResponse: function (data, headers) {
                    if(data){
                        var pdf = null;
                        pdf = new Blob([data], {type:'application/pdf'});
                    }
                    var fileName = "invoice.pdf";
                    var result = {
                        blob : pdf,
                        fileName : fileName
                    };
                    return result;
                }
            },
        });

    }]);
