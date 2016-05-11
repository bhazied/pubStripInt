'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.factory('$pressReleaseSenderDataFactory', ['$resouce', '$rootScope', function($resource, $rootScope){

    return $resource($rootScope.app.apiUrl + '' , {id : '@id'}, {
        send: {method: 'POST', isArray: false}
    });
}]);