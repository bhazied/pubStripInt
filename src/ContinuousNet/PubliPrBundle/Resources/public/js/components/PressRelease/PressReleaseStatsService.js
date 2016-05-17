'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.factory('$PressReleaseStatsDataFactory', ['$resource', '$rootScope', function($resource, $rootScope){

    return $resource($rootScope.app.apiURL + 'PrStat' , {}, {
        stats: {method: 'POST', isArray: false},
    });
}]);