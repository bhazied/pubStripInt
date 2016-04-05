'use strict';
/**
 * Set label & css for enum values
 */
app.directive('myEnum', [
function ($rootScope, ToggleHelper) {
    return {
        restrict: 'A',
        link: function (scope, elem, attrs) {
            attrs.$observe('myEnum', function(value) {
                if (value != '') {
                    var list = angular.fromJson(attrs.myEnumList);
                    var title = value;
                    var css = 'label label-sm label-';
                    for (var i in list) {
                        if (list[i].id == value) {
                            title = list[i].title;
                            css += list[i].css;
                        }
                    }
                    angular.element(elem).text(title);
                    angular.element(elem).attr('class', css);
                }
            });
        }
    };
}]);