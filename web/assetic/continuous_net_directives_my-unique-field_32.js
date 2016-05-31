'use strict';
/**
 * Check if field is unique or not
 */
app.directive('myUniqueField', ['$resource', '$rootScope',
function($resource, $rootScope) {
    var timeoutId;
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, elem, attrs, ctrl) {
            //when the scope changes, check the email.
            scope.$watch(attrs.ngModel, function(value) {
                // if there was a previous attempt, stop it.
                if (timeoutId) {
                    clearTimeout(timeoutId);
                }
                // start a new attempt with a delay to keep it from
                // getting too "chatty".
                timeoutId = setTimeout(function() {
                    var fieldName = attrs.myUniqueField;
                    var resourceURL = attrs.myResourceUrl;
                    var currentId = attrs.myCurrentId;
                    var resource = $resource($rootScope.app.apiURL + resourceURL, {id: '@id'}, {
                        query: { method: 'GET' }
                    });
                    var http_params = {
                        offset: 0,
                        limit: 1
                    };
                    http_params['filters['+fieldName+']'] = value;
                    resource.query(http_params).$promise.then(function(data) {
                        var count = data.inlineCount;
                        if (count > 0) {
                            if (data.results[0].id == currentId) {
                                count--;
                            }
                        }
                        ctrl.$setValidity('myUniqueField', (count == 0));
                    });
                }, 500);
            });
        }
    }
}]);