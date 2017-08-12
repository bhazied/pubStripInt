'use strict';

/**
 * Clean Savable Object
 */
app.factory('savable', [function() {

    return function(obj) {
        var savableObj = angular.copy(obj);
        for (var i in savableObj) {
            if (savableObj[i] instanceof Array) {
                for (var j in savableObj[i]) {
                    if (typeof savableObj[i][j].id !== 'undefined') {
                        savableObj[i][j] = savableObj[i][j].id;
                    }
                }
            } else if (typeof savableObj[i] === 'object' && savableObj[i] !== null) {
                if (typeof savableObj[i].id !== 'undefined') {
                    savableObj[i] = savableObj[i].id;
                }
            }
        }
        return savableObj;
    };
   
}]);
