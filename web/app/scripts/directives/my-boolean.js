'use strict';
/**
 * Make icon for boolena values
 */
app.directive('myBoolean', [
function ($rootScope, ToggleHelper) {
    return {
        restrict: 'A',
        link: function (scope, elem, attrs) {
            attrs.$observe('myBoolean', function(value) {
                if (value != '') {
                    var css = 'fa ';
                    if (value == 'true') {
                        css += 'fa-check-circle-o text-success';
                    } else {
                        css += 'fa-times-circle-o text-danger';
                    }
                    angular.element(elem).attr('class', css);
                }
            });
        }
    };
}]);