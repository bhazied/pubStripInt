'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.factory('$PressReleaseSenderDataFactory', ['$resource', '$rootScope', function($resource, $rootScope){

    return $resource($rootScope.app.apiURL + 'PrSender' , {}, {
        send: {method: 'POST', isArray: false}
    });
}]);