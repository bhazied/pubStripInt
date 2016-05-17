'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.factory('$PressReleaseEmailStatsDataFactory', ['$resource', '$rootScope', function($resource, $rootScope){

    return $resource($rootScope.app.apiURL + 'PrStatEmail' , {}, {
        statsEmail: {method: 'POST', isArray: false},
    });
}]);