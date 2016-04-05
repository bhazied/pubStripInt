'use strict';

/*
 * anchor-scroll - scroll to id directive
 */

function anchorScroll($anchorScroll, $location) {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      element.bind('click', function() {
        var id = attrs.anchorScroll;
        $location.hash(id);
        $anchorScroll();
      });
    }
  };
}

angular.module('urbanApp')
.run(['$anchorScroll', function($anchorScroll) {
  $anchorScroll.yOffset = 55;
}])
.directive('anchorScroll', anchorScroll);

'use strict';

/*
 * ng-c3 - C3 charts directive
 */

function ngC3() {
  function isEmptyJSON(json) {
    for (var attr in json) {
      return false;
    }
    return true;
  }

  function pluck(arrayObject, attr) {
    return arrayObject.map(function (el) {
      if (!el.hasOwnProperty(attr)) {
        console.error('Inconsistent Data');
        console.error('Verify your data, must be like one of these options \n' +
          'data = [{x: value, y: value},...,{x: value, y: value}] \n' +
          'or data = [[valueX, valueY],...,[valueX, valueY]]');
      }
      return el[attr];
    });
  }

  function merge(firstObject, secondObject) {
    for (var attr in secondObject) {
      if (!firstObject.hasOwnProperty(attr)) {
        firstObject[attr] = secondObject[attr];
      }
    }
  }

  function getData(series) {
    var xs = {},
      types = {},
      columns = [],
      x = [],
      y = [],
      yAxis = {};

    series.forEach(function (s) {
      if (s.yAxis) {
        yAxis[s.name] = s.yAxis;
      }

      if (s.type) {
        types[s.name] = s.type;
      }

      xs[s.name] = 'x' + s.name;

      if (s.data[0] instanceof Array) {
        x = pluck(s.data, 0);
        y = pluck(s.data, 1);
      } else if (s.data[0] instanceof Object) {
        x = pluck(s.data, 'x');
        y = pluck(s.data, 'y');
      } else {
        x = [];
        y = [];
        console.error('Verify your data, must be like one of these options \n' +
          'data = [{x: value, y: value},...,{x: value, y: value}] \n' +
          'or data = [[valueX, valueY],...,[valueX, valueY]]');
      }

      x.unshift('x' + s.name);
      y.unshift(s.name);

      columns.push.apply(columns, [x, y]);

    });

    var data = {
      columns: columns,
      xs: xs
    };

    if (!isEmptyJSON(types)) {
      data.types = types;
    }

    if (!isEmptyJSON(yAxis)) {
      data.axes = yAxis;
    }

    return data;
  }

  function getPiesData(series) {
    var columns = [];

    series.forEach(function (s) {
      var data = s.data.map(function (el) {
        if (el instanceof Array) {
          return el[1];
        } else if (el instanceof Object) {
          return el.y;
        } else {
          return el;
        }
      });
      data.unshift(s.name);
      columns.push(data);
    });

    return columns;
  }

  return {
    restrict: 'AE',
    template: '<div></div>',
    scope: {
      series: '=',
      options: '=',
      chartId: '@'
    },
    link: function (scope, element) {

      var chartElement = element[0].childNodes[0];
      chartElement.id = scope.chartId;

      scope.$watch('[series, options]', function (changes) {
        changes[1] = changes[1] || {};
        var body = {};
        var typeChart = changes[1].type || 'line';

        switch (typeChart) {
        case 'donut':
        case 'pie':
        case 'gauge':
          body.data = {
            type: typeChart,
            columns: getPiesData(changes[0])
          };
          merge(body, changes[1]);
          break;
        default:
          body.data = getData(changes[0]);
          body.data.type = typeChart;
          if (changes[1]) {
            merge(body, changes[1]);
            body.data.groups = changes[1].groups || [];
            /*jslint evil: true */
            body.data.onclick = changes[1].onclick || new Function();
          }
          break;
        }
        body.bindto = scope.chartId ? '#' + scope.chartId : '#chart';
        var chart = c3.generate(body);

      }, true);
    }
  };
}

angular.module('urbanApp').directive('ngC3', ngC3);

'use strict';

/*
 * chosen - chosen select directive alternative to ui-jq
 */

function chosen() {
  return {
    restrict: 'EA',
    link: function (scope, element, attrs) {
      // update the select when data is loaded
      scope.$watch(attrs.chosen, function () {
        element.trigger('chosen:updated');
      });

      // update the select when the model changes
      scope.$watch(attrs.ngModel, function () {
        element.trigger('chosen:updated');
      });

      element.chosen();
    }
  };
}

angular.module('urbanApp').directive('chosen', chosen);

'use strict';

/*
 * side-navigation - Main sidebar navigation directive
 */

function sideNavigation() {
  return {
    //scope: {},
    link: function (scope, element, $window) {
      element.find('a').on('click', function (e) {

        var $this = angular.element(this),
          links = $this.parents('li'),
          parentLink = $this.closest('li'),
          otherLinks = angular.element('.sidebar-panel nav li').not(links),
          subMenu = $this.next();

        if (!subMenu.hasClass('sub-menu')) {
          scope.$apply('checkOffscreen()');
          return;
        }

        if (angular.element('.app').hasClass('layout-small-menu') && parentLink.parent().hasClass('nav') && $window.width() > 768) {
          return;
        }

        otherLinks.removeClass('open');

        if (subMenu.is('ul') && (subMenu.height() === 0)) {
          parentLink.addClass('open');
        } else if (subMenu.is('ul') && (subMenu.height() !== 0)) {
          parentLink.removeClass('open');
        }

        scope.updateScrollbars();

        if (subMenu.is('ul')) {
          return false;
        }

        e.stopPropagation();

        return true;
      });

      element.find('> li > .sub-menu').each(function () {
        if (angular.element(this).find('ul.sub-menu').length > 0) {
          angular.element(this).addClass('multi-level');
        }
      });
      element.find('.sub-menu').each(function () {
        angular.element(this).parent('li').addClass('menu-accordion');
      });
    },
    controller: function ($scope) {

      $scope.checkOffscreen = function () {
        if ($scope.app.layout.isOffscreenOpen) {
          angular.element('.app').removeClass('offscreen move-left move-right');
          $scope.app.layout.isOffscreenOpen = false;
        }
      };

      $scope.winWidth = function() {
        return window.innerWidth;
      };

      var psTarg = angular.element('.sidebar-panel > nav');

      $scope.initScrollbars = function() {
        angular.element('.sidebar-panel > nav').perfectScrollbar({
          wheelPropagation: true,
          suppressScrollX: true
        });
      };

      $scope.destroyScrollbars = function() {
        if (psTarg.hasClass('ps-container')) {
          psTarg.perfectScrollbar('destroy').removeClass('ps-active-y');
        }
      };

      $scope.updateScrollbars = function() {
        if (psTarg.hasClass('ps-container') && !angular.element('.app').hasClass('layout-small-menu')) {
          psTarg.perfectScrollbar('update');
        }
      };

      $scope.$watch($scope.winWidth, function (newValue, oldValue) {
        if ($scope.mobileView >= newValue || angular.element('.app').hasClass('layout-small-menu')) {
          if (psTarg.hasClass('ps-container')) {
            $scope.destroyScrollbars();
          }
          return;
        }
        else {
          if (!psTarg.hasClass('ps-container')) {
            $scope.initScrollbars();
          }
          return;
        }
      }, true);

      $scope.$watch('app.layout', function () {

        if ($scope.mobileView >= $scope.winWidth()) {
          return;
        }

        if ($scope.app.layout.isSmallSidebar || $scope.app.layout.isStaticSidebar || $scope.app.layout.isBoxed && psTarg.hasClass('ps-container')) {
          $scope.destroyScrollbars();
        }
        else {
          if (psTarg.hasClass('ps-container')) {
            $scope.updateScrollbars();
          }
          else {
            $scope.initScrollbars();
          }
        }
      }, true);

      window.onresize = function() {
        $scope.$apply();
      };
    }
  };
}

angular.module('urbanApp').directive('sideNavigation', sideNavigation);

'use strict';

/*
 * offscreen - Off canvas sidebar directive
 */

function offscreen($rootScope, $timeout) {
  return {
    restrict: 'EA',
    replace: true,
    transclude: true,
    templateUrl: 'views/directives/toggle-offscreen.html',
    link: function (scope, element, attrs) {
      scope.offscreenDirection = attrs.move;
    },
    controller: function ($scope, $element, $timeout) {
      var dir,
        offscreenDirectionClass;

      $scope.offscreen = function () {
        dir = $scope.offscreenDirection ? $scope.offscreenDirection : 'ltr';

        if ($scope.app.layout.isChatOpen) {
          $scope.app.layout.isChatOpen = !$scope.app.layout.isChatOpen;
        }

        if (dir === 'rtl' || angular.element('.app').hasClass('layout-right-sidebar')) {
          offscreenDirectionClass = 'move-right';
        } else {
          offscreenDirectionClass = 'move-left';
        }

        if ($scope.app.layout.isOffscreenOpen) {
          angular.element('.app').removeClass('move-left move-right');
          $timeout(function () {
            angular.element('.app').removeClass('offscreen');
          }, 300);
          $scope.app.layout.isOffscreenOpen = false;
        } else {
          angular.element('.app').addClass('offscreen ' + offscreenDirectionClass);
          $scope.app.layout.isOffscreenOpen = true;
        }
      };
    }
  };
}

angular.module('urbanApp').directive('offscreen', offscreen);

'use strict';

/*
 * panel-control-collapse - panel toolbar collapse directive
 */

function panelControlCollapse() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      element.bind('click', function() {
        var parent = angular.element(element).closest('.panel');
        parent.toggleClass('panel-collapsed');
      });
    }
  };
}

angular.module('urbanApp').directive('panelControlCollapse', panelControlCollapse);

'use strict';

/*
 * panel-control-refresh - panel toolbar refresh directive
 */

function panelControlRefresh($timeout) {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      element.bind('click', function() {
        var parent = angular.element(element).closest('.panel');
        parent.addClass('panel-refreshing');
        $timeout(function () {
          parent.removeClass('panel-refreshing');
        }, 3000);
      });
    }
  };
}

angular.module('urbanApp').directive('panelControlRefresh', panelControlRefresh);

'use strict';

/*
 * panel-control-remove - panel toolbar remove directive
 */

function panelControlRemove() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      element.bind('click', function() {
        var parent = angular.element(element).closest('.panel');
        parent.addClass('animated fadeOut');
        parent.bind('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
          parent.remove();
        });
      });
    }
  };
}

angular.module('urbanApp').directive('panelControlRemove', panelControlRemove);

'use strict';

/*
 * preloader - loading indicator directive
 */
function preloader($rootScope, $timeout) {
  return {
    restrict: 'EA',
    link: function (scope, element) {
      $rootScope.$on('$stateChangeStart', function () {
        $timeout(function () {
          element.removeClass('ng-hide');
        });
      });

      $rootScope.$on('$stateChangeSuccess', function () {
        $rootScope.$watch('$viewContentLoaded', function () {
          $timeout(function () {
            element.addClass('ng-hide');
          }, 1500);
        });
      });
    }
  };
}

angular.module('urbanApp').directive('preloader', preloader);

'use strict';

/*
 * quickLaunch - quick launch panel directive
 */
function quickLaunch($timeout) {
  return {
    restrict: 'EA',
    link: function (scope, element, attrs) {
      var body = angular.element('body');
      element.on('click', function (e) {
        e.preventDefault();
        if (!body.hasClass('layout-quick-launch-panel')) {
          body.css({transition: '300ms cubic-bezier(.7,0,.3,1)'}).addClass('layout-quick-launch-panel stop-scrolling');
        }
        else {
          body.removeClass('layout-quick-launch-panel');
          $timeout(function () {
            body.removeClass('stop-scrolling').css({transition: ''});
          }, 300);
        }
        window.scrollTo(0, 0);
      });
      angular.element('.quick-launch-panel').find('a').on('click', function (e) {
        if (body.hasClass('layout-quick-launch-panel')) {
          body.removeClass('layout-quick-launch-panel');
          $timeout(function () {
            body.removeClass('stop-scrolling').css({transition: ''});
          }, 300);
        }
      });
    }
  };
}

angular.module('urbanApp').directive('quickLaunch', quickLaunch);

'use strict';

/*
 * rickshaw - rickshaw charts directive
 */
function rickshaw($compile, $window) {

  return {
    restrict: 'EA',
    scope: {
      options: '=rickshawOptions',
      series: '=rickshawSeries',
      features: '=rickshawFeatures'
    },
    // replace: true,
    link: function (scope, element) {
      var graphEl;
      var graph;
      var settings;

      function update() {
        if (!graph) {
          var mainEl = angular.element(element);
          mainEl.append(graphEl);
          mainEl.empty();
          graphEl = $compile('<div></div>')(scope);
          mainEl.append(graphEl);

          settings = angular.copy(scope.options);
          settings.element = graphEl[0];
          settings.series = scope.series;

          graph = new Rickshaw.Graph(settings);

          if (scope.features && scope.features.hover) {
            var hoverConfig = {
              graph: graph
            };
            hoverConfig.xFormatter = scope.features.hover.xFormatter;
            hoverConfig.yFormatter = scope.features.hover.yFormatter;
            hoverConfig.formatter = scope.features.hover.formatter;
            var hoverDetail = new Rickshaw.Graph.HoverDetail(hoverConfig);
            mainEl.find('.detail').addClass('inactive');
          }

          if (scope.features && scope.features.palette) {
            var palette = new Rickshaw.Color.Palette({
              scheme: scope.features.palette
            });
            for (var i = 0; i < settings.series.length; i++) {
              settings.series[i].color = palette.color();
            }
          }
          if (scope.features && scope.features.xAxis) {
            var xAxisConfig = {
              graph: graph
            };
            if (scope.features.xAxis.timeUnit) {
              var time = new Rickshaw.Fixtures.Time();
              xAxisConfig.timeUnit = time.unit(scope.features.xAxis.timeUnit);
            }
            var xAxis = new Rickshaw.Graph.Axis.Time(xAxisConfig);
            xAxis.render();
          }
          if (scope.features && scope.features.yAxis) {
            var yAxisConfig = {
              graph: graph
            };
            if (scope.features.yAxis.tickFormat) {
              yAxisConfig.tickFormat = Rickshaw.Fixtures.Number[scope.features.yAxis.tickFormat];
            }

            var yAxis = new Rickshaw.Graph.Axis.Y(yAxisConfig);
            yAxis.render();
          }
          if (scope.features && scope.features.legend) {
            var legendEl = $compile('<div></div>')(scope);
            mainEl.append(legendEl);

            var legend = new Rickshaw.Graph.Legend({
              graph: graph,
              element: legendEl[0]
            });
            if (scope.features.legend.toggle) {
              var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({
                graph: graph,
                legend: legend
              });
            }
            if (scope.features.legend.highlight) {
              var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight({
                graph: graph,
                legend: legend
              });
            }
          }
        } else {
          settings = angular.copy(scope.options, settings);
          settings.element = graphEl[0];
          settings.series = scope.series;

          settings.width = element.parent().width();

          graph.configure(settings);
        }

        graph.render();
      }

      var optionsWatch = scope.$watch('options', function (newValue, oldValue) {
        if (!angular.equals(newValue, oldValue)) {
          update();
        }
      }, true);
      var seriesWatch = scope.$watch(function (scope) {
        if (scope.features && scope.features.directive && scope.features.directive.watchAllSeries) {
          var watches = {};
          for (var i = 0; i < scope.series.length; i++) {
            watches['series' + i] = scope.series[i].data;
          }
          return watches;
        } else {
          return scope.series[0].data;
        }
      }, function (newValue, oldValue) {
        if (!angular.equals(newValue, oldValue)) {
          update();
        }
      }, true);
      var featuresWatch = scope.$watch('features', function (newValue, oldValue) {
        if (!angular.equals(newValue, oldValue)) {
          update();
        }
      }, true);

      scope.$on('$destroy', function () {
        optionsWatch();
        seriesWatch();
        featuresWatch();
      });

      var w = angular.element($window);

      scope.getWidth = function () {
        return window.innerWidth;
      };

      scope.$watch(scope.getWidth, function (newValue, oldValue) {
        update();
      });

      w.bind('resize', function () {
        scope.$apply();
      });

      update();
    },
    controller: function ($scope, $element, $attrs) {}
  };
}

angular.module('urbanApp').directive('rickshaw', rickshaw);

'use strict';

/*
 * scroll-up - Scroll to top of page directive
 */
function scrollUp() {
  return {
    link: function (scope, element) {
      element.on('click', function () {
        angular.element('body,html').stop().animate({
          scrollTop: 0
        }, 300);
        return false;
      });
    }
  };
}

angular.module('urbanApp').directive('scrollUp', scrollUp);

'use strict';

/*
 * vector - jvectormap directive
 */
function vector() {
  return {
    restrict: 'EA',
    link: function (scope, element, attrs) {
      var chart = null;

      var data = scope[attrs.ngModel];

      scope.$watch('data', function () {
        if (!chart) {
          chart = angular.element(element).vectorMap(data);
        } else {
          chart.vectorMap('get', 'mapObject').series.regions[0].setValues(scope.datamap);
        }
      });
    }
  };
}

angular.module('urbanApp').directive('vector', vector);

'use strict';
/** 
  * A simple but useful and efficient directive to toggle a class to an element.   
*/
app.factory('ToggleHelper', ['$rootScope',
function ($rootScope) {
    return {

        events: {
            toggle: "continuous-net.toggle",
            toggleByClass: "continuous-net.toggleByClass",
            togglerLinked: "continuous-net.linked",
            toggleableToggled: "continuous-net.toggled"
        },

        commands: {
            alternate: "toggle",
            activate: "on",
            deactivate: "off"
        },

        toggle: function (target, command) {
            if (command == null) {
                command = "toggle";
            }
            $rootScope.$emit(this.events.toggle, target, command);
        },

        toggleByClass: function (targetClass, command) {
            if (command == null) {
                command = "toggle";
            }
            $rootScope.$emit(this.events.toggleByClass, targetClass, command);
        },

        notifyToggleState: function (elem, attrs, toggleState) {
            $rootScope.$emit(this.events.toggleableToggled, attrs.id, toggleState, attrs.exclusionGroup);
        },

        toggleStateChanged: function (elem, attrs, toggleState) {
            this.updateElemClasses(elem, attrs, toggleState);
            this.notifyToggleState(elem, attrs, toggleState);
        },

        applyCommand: function (command, oldState) {
            switch (command) {
                case this.commands.activate:
                    return true;
                case this.commands.deactivate:
                    return false;
                case this.commands.alternate:
                    return !oldState;
            }
        },

        updateElemClasses: function (elem, attrs, active) {

            if (active) {
                if (attrs.activeClass) {
                    elem.addClass(attrs.activeClass);
                }
                if (attrs.inactiveClass) {
                    elem.removeClass(attrs.inactiveClass);
                }
                var parent = elem.parent();
                if (attrs.parentActiveClass) {
                    parent.addClass(attrs.parentActiveClass);
                }
                if (attrs.parentInactiveClass) {
                    parent.removeClass(attrs.parentInactiveClass);
                }
            } else {
                if (attrs.inactiveClass) {
                    elem.addClass(attrs.inactiveClass);
                }
                if (attrs.activeClass) {
                    elem.removeClass(attrs.activeClass);
                }
                var parent = elem.parent();
                if (attrs.parentInactiveClass) {
                    parent.addClass(attrs.parentInactiveClass);
                }
                if (attrs.parentActiveClass) {
                    parent.removeClass(attrs.parentActiveClass);
                }
            }
        }
    };
}]).run(["$rootScope", "ToggleHelper",
function ($rootScope, ToggleHelper) {

    $rootScope.toggle = function (target, command) {
        if (command == null) {
            command = "toggle";
        }
        ToggleHelper.toggle(target, command);
    };

    $rootScope.toggleByClass = function (targetClass, command) {
        if (command == null) {
            command = "toggle";
        }
        ToggleHelper.toggleByClass(targetClass, command);
    };
}]).directive('ctToggle', ["$rootScope", "ToggleHelper",
function ($rootScope, ToggleHelper) {
    return {
        restrict: "A",
        link: function (scope, elem, attrs) {
            var command = attrs.ctToggle || ToggleHelper.commands.alternate;
            var target = attrs.target;
            var targetClass = attrs.targetClass;
            var bubble = attrs.bubble === "true" || attrs.bubble === "1" || attrs.bubble === 1 || attrs.bubble === "" || attrs.bubble === "bubble";

            if ((!target) && attrs.href) {
                target = attrs.href.slice(1);
            }

            if (!(target || targetClass)) {
                throw "'target' or 'target-class' attribute required with 'ct-toggle'";
            }
            elem.on("click tap", function (e) {

                var angularElem = angular.element(e.target);
                if (!angularElem.hasClass("disabled")) {
                    if (target != null) {
                        ToggleHelper.toggle(target, command);
                    }
                    if (targetClass != null) {
                        ToggleHelper.toggleByClass(targetClass, command);
                    }
                    if (!bubble) {
                        e.preventDefault();
                        return false;
                    } else {
                        return true;
                    }
                }

            });
            var unbindUpdateElemClasses = $rootScope.$on(ToggleHelper.events.toggleableToggled, function (e, id, newState) {
                if (id === target) {
                    ToggleHelper.updateElemClasses(elem, attrs, newState);
                }
            });

            if (target != null) {
                $rootScope.$emit(ToggleHelper.events.togglerLinked, target);
            }

            scope.$on('$destroy', unbindUpdateElemClasses);
        }
    };
}]).directive('toggleable', ["$rootScope", "ToggleHelper",
function ($rootScope, ToggleHelper) {
    return {
        restrict: "A",
        link: function (scope, elem, attrs) {
            var toggleState = false;

            if (attrs["default"]) {
                switch (attrs["default"]) {
                    case "active":
                        toggleState = true;
                        break;
                    case "inactive":
                        toggleState = false;
                }
                ToggleHelper.toggleStateChanged(elem, attrs, toggleState);
            }

            var unbindToggle = $rootScope.$on(ToggleHelper.events.toggle, function (e, target, command) {
                var oldState;
                if (target === attrs.id) {
                    oldState = toggleState;
                    toggleState = ToggleHelper.applyCommand(command, oldState);
                    if (oldState !== toggleState) {
                        ToggleHelper.toggleStateChanged(elem, attrs, toggleState);
                    }
                }
            });

            var unbindToggleByClass = $rootScope.$on(ToggleHelper.events.toggleByClass, function (e, targetClass, command) {
                var oldState;
                if (elem.hasClass(targetClass)) {
                    oldState = toggleState;
                    toggleState = ToggleHelper.applyCommand(command, oldState);
                    if (oldState !== toggleState) {
                        ToggleHelper.toggleStateChanged(elem, attrs, toggleState);
                    }
                }
            });

            var unbindToggleableToggled = $rootScope.$on(ToggleHelper.events.toggleableToggled, function (e, target, newState, sameGroup) {
                if (newState && (attrs.id !== target) && (attrs.exclusionGroup === sameGroup) && (attrs.exclusionGroup != null)) {
                    toggleState = false;
                    ToggleHelper.toggleStateChanged(elem, attrs, toggleState);
                }
            });

            var unbindTogglerLinked = $rootScope.$on(ToggleHelper.events.togglerLinked, function (e, target) {
                if (attrs.id === target) {
                    ToggleHelper.notifyToggleState(elem, attrs, toggleState);
                }
            });

            scope.$on('$destroy', function () {
                unbindToggle();
                unbindToggleByClass();
                unbindToggleableToggled();
                unbindTogglerLinked();
            });
        }
    };
}]);
app.directive('perfectScrollbar', ['$parse', '$window',
function($parse, $window) {
	var psOptions = ['wheelSpeed', 'wheelPropagation', 'minScrollbarLength', 'useBothWheelAxes', 'useKeyboard', 'suppressScrollX', 'suppressScrollY', 'scrollXMarginOffset', 'scrollYMarginOffset', 'includePadding'//, 'onScroll', 'scrollDown'
	];

	return {
		restrict: 'EA',
		transclude: true,
		template: '<div><div ng-transclude></div></div>',
		replace: true,
		link: function($scope, $elem, $attr) {
			var jqWindow = angular.element($window);
			var options = {};
			if(!$scope.app.isMobile) {
				for(var i = 0, l = psOptions.length; i < l; i++) {
					var opt = psOptions[i];
					if($attr[opt] !== undefined) {
						options[opt] = $parse($attr[opt])();
					}
				}

				$scope.$evalAsync(function() {
					$elem.perfectScrollbar(options);
					var onScrollHandler = $parse($attr.onScroll);
					$elem.scroll(function() {
						var scrollTop = $elem.scrollTop();
						var scrollHeight = $elem.prop('scrollHeight') - $elem.height();
						$scope.$apply(function() {
							onScrollHandler($scope, {
								scrollTop: scrollTop,
								scrollHeight: scrollHeight
							});
						});
					});
				});

				var update = function (event) {
					$scope.$evalAsync(function() {
						if($attr.scrollDown == 'true' && event != 'mouseenter') {
							setTimeout(function() {
								$($elem).scrollTop($($elem).prop("scrollHeight"));
							}, 100);
						}
						$elem.perfectScrollbar('update');
					});
				};

				// This is necessary when you don't watch anything with the scrollbar
				$elem.bind('mousemove', update);

				// Possible future improvement - check the type here and use the appropriate watch for non-arrays
				if($attr.refreshOnChange) {
					$scope.$watchCollection($attr.refreshOnChange, function() {
						update();
					});
				}

				// this is from a pull request - I am not totally sure what the original issue is but seems harmless
				if($attr.refreshOnResize) {
					jqWindow.on('resize', update);
				}

				$elem.bind('$destroy', function() {
					jqWindow.off('resize', update);
					$elem.perfectScrollbar('destroy');
				});
			}
		}
	};
}]);

'use strict';
/** 
  * Prevent default action on empty links.
*/
app.directive('a', function () {
    return {
        restrict: 'E',
        link: function (scope, elem, attrs) {
            if (attrs.ngClick || attrs.href === '' || attrs.href === '#') {
                elem.on('click', function (e) {
                    e.preventDefault();
                });
            }
        }
    };
});
'use strict';
/**
 * A set of directives for left and right sidebar.
 */
app.directive('sidebar', ['$document', '$rootScope',
function($document, $rootScope) {
	return {
		replace : false,
		restrict : "C",
		link : function(scope, elem, attrs) {
		    
		    scope.user = $rootScope.user;
		    
			var shouldCloseOnOuterClicks = true;

			if (attrs.closeOnOuterClicks == 'false' || attrs.closeOnOuterClicks == '0') {
				shouldCloseOnOuterClicks = false;
			}

			var isAncestorOrSelf = function(element, target) {
				var parent = element;

				while (parent.length > 0) {
					if (parent[0] === target[0]) {
						parent = null;
						return true;
					}
					parent = parent.parent();
				}

				parent = null;
				return false;
			};

			var closeOnOuterClicks = function(e) {
				if(!isAncestorOrSelf(angular.element(e.target), elem)) {
					$("#app .app-content").one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {

						if(!$('#app').hasClass('app-slide-off') && !$('#app').hasClass('app-offsidebar-open')) {
							var $winScrollTop = Math.abs($('#app .main-content').position().top);
							
							$('#app .main-content').css({
								position: 'relative',
								top: 'auto'
							});
							
							window.scrollTo(0, $winScrollTop);
							$('footer').show();
							$("#app .app-content").off("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
						}
					});
					$rootScope.toggle(attrs.id, 'off');
					e.preventDefault();
					return false;
				}
			};

			var clearCb1 = angular.noop();

			if (shouldCloseOnOuterClicks) {
				clearCb1 = $rootScope.$on('continuousnet.toggled', function(e, id, active) {

					if (id == attrs.id) {

						if (active) {
							setTimeout(function() {
								$document.on('click tap', closeOnOuterClicks);
							}, 300);
						} else {
							$document.off('click tap', closeOnOuterClicks);
						}
					}
				});
			}

			scope.$on('$destroy', function() {
				clearCb1();
				$document.off('click tap', closeOnOuterClicks);
			});

		}
	};
}]).directive('searchForm', function() {
	return {
		restrict : 'AC',
		link : function(scope, elem, attrs) {
			var wrap = $('.app-aside');
			var searchForm = elem.children('form');
			var formWrap = elem.parent();

			$(".s-open").on('click', function(e) {
				searchForm.prependTo(wrap);
				e.preventDefault();
				$(document).on("mousedown touchstart", closeForm);
			});
			$(".s-remove").on('click', function(e) {
				searchForm.appendTo(elem);
				e.preventDefault();
			});
			var closeForm = function(e) {
				if (!searchForm.is(e.target) && searchForm.has(e.target).length === 0) {
					$(".s-remove").trigger('click');
					$(document).off("mousedown touchstart", closeForm);
				}
			};
		}
	};
	function isSidebarClosed() {
		return $('.app-sidebar-closed').length;
	}

	function isSidebarFixed() {
		return $('.app-sidebar-fixed').length;
	}

}).directive('appAside', ['$window', '$rootScope', '$timeout', 'APP_MEDIAQUERY',
function($window, $rootScope, $timeout, mq) {
	var $html = $('html'), $win = $($window), _this, wrap = $('.app-aside');
	return {
		restrict : 'AC',

		link : function(scope, elem, attrs, controllers) {
			var eventObject = isTouch() ? 'click' : 'mouseenter';
			var ul = "";
			var menuTitle;
			var wrap = $('.app-aside');
			elem.on('click', 'a', function(e) {

				_this = $(this);
				if (isSidebarClosed() && !isMobile() && !_this.closest("ul").hasClass("sub-menu"))
					return;

				_this.closest("ul").find(".open").not(".active").children("ul").not(_this.next()).slideUp(200).parent('.open').removeClass("open");
				if (_this.next().is('ul') && _this.parent().toggleClass('open')) {

					_this.next().slideToggle(200, function() {
						$win.trigger("resize");

					});
					e.stopPropagation();
					e.preventDefault();
				} else {
					$rootScope.toggle('sidebar', 'off');

				}
			});
			elem.on(eventObject, 'a', function(e) {

				if (!isSidebarClosed() || isMobile())

					return;
				_this = $(this);

				if (!_this.parent().hasClass('hover') && !_this.closest("ul").hasClass("sub-menu")) {

					wrapLeave();
					_this.parent().addClass('hover');
					menuTitle = _this.find(".item-inner").clone();
					if (_this.parent().hasClass('active')) {

						menuTitle.addClass("active");
					}
					var offset = $("#sidebar").position().top;
					var itemTop = isSidebarFixed() ? _this.parent().position().top + offset : (_this.parent().position().top);
					menuTitle.css({
						position : isSidebarFixed() ? 'fixed' : 'absolute',
						height : _this.outerHeight(),
						top : itemTop
					}).appendTo(wrap);
					if (_this.next().is('ul')) {
						ul = _this.next().clone(true);

						ul.appendTo(wrap).css({
							top : itemTop + _this.outerHeight(),
							position : isSidebarFixed() ? 'fixed' : 'absolute',
						});
						if (_this.parent().position().top + _this.outerHeight() + offset + ul.height() > $win.height() && isSidebarFixed()) {
							ul.css('bottom', 0);
						} else {
							ul.css('bottom', 'auto');
						}

						wrap.children().first().scroll(function() {
							if (isSidebarFixed())
								wrapLeave();
						});

						setTimeout(function() {

							if (!wrap.is(':empty')) {
								$(document).on('click tap', wrapLeave);
							}
						}, 300);

					} else {
						ul = "";
						return;
					}

				}
			});
			wrap.on('mouseleave', function(e) {

				$(document).off('click tap', wrapLeave);
				$('.hover', wrap).removeClass('hover');
				$('> .item-inner', wrap).remove();
				$('> ul', wrap).remove();

			});
			function wrapLeave() {
				wrap.trigger('mouseleave');
			}


			$rootScope.$on('$locationChangeSuccess', function() {
				var newPath;
				newPath = window.location.hash;
				angular.forEach(elem.find('.main-navigation-menu a'), function(domLink) {
					var link = angular.element(domLink);
					var menu;
					if (domLink.hash === newPath && (!isSidebarClosed() || isMobile())) {

						if (link.closest("ul").hasClass("sub-menu")) {
							menu = link.closest("ul");
							var activeMenu = menu;
							menu.slideDown(200).parent().siblings().children('.sub-menu').slideUp(200, function() {
								$(this).parent().removeClass("open");
							});
						} else {
							$('.sub-menu').slideUp(200, function() {
								$(this).parent().removeClass("open");
							});
						}

					}
					activeMenu = null;
					menu = null;
				});
			});

		}
	};
	
	function isTouch() {
		return $html.hasClass('touch');
	}

	function isMobile() {
		return $win.width() < mq.desktop;
	}
	
	function isSidebarClosed() {
		return $('.app-sidebar-closed').length;
	}

	function isSidebarFixed() {
		return $('.app-sidebar-fixed').length;
	}

}])
.directive('sidebarMobileToggler', ['$window', '$rootScope', '$timeout', 'APP_MEDIAQUERY',
function($window, $rootScope, $timeout, mq) {
	var $html = $('html'), $win = $($window), _this, $winOffsetTop = 0, $winScrollTop = 0, $appWidth;
	return {
		restrict: 'C',

		link: function(scope, elem, attrs, controllers) {
			elem.on('click', function() {

				if(!$('#app').hasClass('app-slide-off') && !$('#app').hasClass('app-offsidebar-open')) {
					$winOffsetTop = $win.scrollTop();
					$winScrollTop = 0;
					$('footer').hide();
					$appWidth = $('#app .main-content').innerWidth();
					$('#app .main-content').css({
						position: 'absolute',
						top: -$winOffsetTop,
						width: $appWidth
					});
				} else {
					$winScrollTop = $winOffsetTop;
				}
				$("#app .app-content").one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {

					if(!$('#app').hasClass('app-slide-off') && !$('#app').hasClass('app-offsidebar-open')) {
						$('#app .main-content').css({
							position: 'relative',
							top: 'auto',
							width: 'auto'
						});
						
						window.scrollTo(0, $winScrollTop);
						$('footer').show();
						$("#app .app-content").off("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
					}
					
				});
			});

		}
	};
}]);

'use strict';
/** 
  * It's like click, but when you don't click on your element. 
*/
app.directive('offClick', ['$document', '$timeout', function ($document, $timeout) {

    function targetInFilter(target, filter) {
        if (!target || !filter) return false;
        var elms = angular.element(document.querySelectorAll(filter));
        var elmsLen = elms.length;
        for (var i = 0; i < elmsLen; ++i)
            if (elms[i].contains(target)) return true;
        return false;
    }

    return {
        restrict: 'A',
        scope: {
            offClick: '&',
            offClickIf: '&'
        },
        link: function (scope, elm, attr) {

            if (attr.offClickIf) {
                scope.$watch(scope.offClickIf, function (newVal, oldVal) {
                    if (newVal && !oldVal) {
                        $timeout(function () {
                            $document.on('click', handler);
                        });
                    } else if (!newVal) {
                        $document.off('click', handler);
                    }
                }
                );
            } else {
                $document.on('click', handler);
            }

            scope.$on('$destroy', function () {
                $document.off('click', handler);
            });

            function handler(event) {
                // This filters out artificial click events. Example: If you hit enter on a form to submit it, an
                // artificial click event gets triggered on the form's submit button.
                if (event.pageX == 0 && event.pageY == 0) return;

                var target = event.target || event.srcElement;
                if (!(elm[0].contains(target) || targetInFilter(target, attr.offClickFilter))) {
                    scope.$apply(scope.offClick());
                }
            }
        }
    };
}]);

'use strict';
/**
 * Make element 100% height of browser window.
 */
app.directive('ctFullheight', ['$window', '$rootScope', '$timeout', 'APP_MEDIAQUERY',
function ($window, $rootScope, $timeout, mq) {
    return {
        restrict: "AE",
        scope: {
            ctFullheightIf: '&'
        },
        link: function (scope, elem, attrs) {
            var $win = $($window);
            var $document = $(document);
            var exclusionItems;
            var exclusionHeight;
            var setHeight = true;
            var page;

            scope.initializeWindowSize = function () {
                $timeout(function () {
                    exclusionHeight = 0;
                    if (attrs.ctFullheightIf) {
                        scope.$watch(scope.ctFullheightIf, function (newVal, oldVal) {
                            if (newVal && !oldVal) {
                                setHeight = true;
                            } else if (!newVal) {
                                $(elem).css('height', 'auto');
                                setHeight = false;
                            }
                        });
                    }

                    if (attrs.ctFullheightExclusion) {
                        var exclusionItems = attrs.ctFullheightExclusion.split(',');
                        angular.forEach(exclusionItems, function (_element) {
                            exclusionHeight = exclusionHeight + $(_element).outerHeight(true);
                        });
                    }
                    if (attrs.ctFullheight == 'window') {
                        page = $win;
                    } else {
                        page = $document;
                    }

                    scope.$watch(function () {
                        scope.__height = page.height();
                    });
                    if (setHeight) {
                        $(elem).css('height', 'auto');
                        if (page.innerHeight() < $win.innerHeight()) {
                            page = $win;
                        }
                        $(elem).css('height', page.innerHeight() - exclusionHeight);
                    }
                }, 300);
            };

            scope.initializeWindowSize();
            scope.$watch('__height', function (newHeight, oldHeight) {
                scope.initializeWindowSize();
            });
            $win.on('resize', function () {
                scope.initializeWindowSize();
            });

        }
    };
}]);

'use strict';
/** 
  * Add several features to panels.  
*/
app.directive('ctPaneltool', function () {
    var templates = {
        /* jshint multistr: true */
        collapse: "<a href='#' class='btn btn-transparent btn-sm' panel-collapse='' tooltip-placement='top' uib-tooltip='Collapse' ng-click='{{panelId}} = !{{panelId}}' ng-init='{{panelId}}=false'>" + "<i ng-if='{{panelId}}' class='ti-plus'></i>" + "<i ng-if='!{{panelId}}' class='ti-minus'></i>" + "</a>",
        dismiss: "<a href='#' class='btn btn-transparent btn-sm' panel-dismiss='' tooltip-placement='top' uib-tooltip='Close'>" + "<i class='ti-close'></i>" + "</a>",
        refresh: "<a href='#' class='btn btn-transparent btn-sm' panel-refresh='' tooltip-placement='top' uib-tooltip='Refresh' data-spinner='{{spinner}}'>" + "<i class='ti-reload'></i>" + "</a>"
    };

    return {
        restrict: 'E',
        template: function (elem, attrs) {
            var temp = '';
            if (attrs.toolCollapse)
                temp += templates.collapse.replace(/{{panelId}}/g, (elem.parent().parent().attr('id')));
            if (attrs.toolDismiss)
                temp += templates.dismiss;
            if (attrs.toolRefresh)
                temp += templates.refresh.replace(/{{spinner}}/g, attrs.toolRefresh);
            return temp;
        }
    };
});
app.directive('panelDismiss', function () {
    'use strict';
    return {
        restrict: 'A',
        controller: ["$scope", "$element", function ($scope, $element) {
            var removeEvent = 'panel-remove', removedEvent = 'panel-removed';

            $element.on('click', function () {

                var parent = $(this).closest('.panel');

                destroyPanel();

                function destroyPanel() {
                    var col = parent.parent();
                    parent.fadeOut(300, function () {
                        $(this).remove();
                        if (col.is('[class*="col-"]') && col.children('*').length === 0) {
                            col.remove();
                        }
                    });
                }

            });
        }]
    };
})

.directive('panelRefresh', function () {
    'use strict';

    return {
        restrict: 'A',
        controller: ["$scope", "$element", function ($scope, $element) {

            var refreshEvent = 'panel-refresh', csspinnerClass = 'csspinner', defaultSpinner = 'load1';

            // method to clear the spinner when done
            function removeSpinner() {
                this.removeClass(csspinnerClass);
            }

            // catch clicks to toggle panel refresh
            $element.on('click', function () {
                var $this = $(this), panel = $this.parents('.panel').eq(0), spinner = $this.data('spinner') || defaultSpinner;

                // start showing the spinner
                panel.addClass(csspinnerClass + ' ' + spinner);

                // attach as public method
                panel.removeSpinner = removeSpinner;

                // Trigger the event and send the panel object
                $this.trigger(refreshEvent, [panel]);

            });

        }]
    };
});

(function ($, window, document) {
    'use strict';

    $(document).on('panel-refresh', '.panel', function (e, panel) {

        // perform any action when a .panel triggers a the refresh event
        setTimeout(function () {
            // when the action is done, just remove the spinner class
            panel.removeSpinner();
        }, 3000);

    });

}(jQuery, window, document));
'use strict';
app.directive('maxlength', function () {
    return {
        restrict: 'A',
        link: function ($scope, $element, $attributes) {

            var limit = $attributes.maxlength;
            $element.bind('keyup', function (event) {
                var element = $element.closest(".form-group");

                element.toggleClass('has-warning', limit - $element.val().length <= 10);
                element.toggleClass('has-error', $element.val().length >= limit);
            });

            $element.bind('keypress', function (event) {
                // Once the limit has been met or exceeded, prevent all keypresses from working
                if ($element.val().length >= limit) {
                    // Except backspace
                    if (event.keyCode != 8) {
                        event.preventDefault();
                    }
                }
            });
        }
    };
});

'use strict';
/** 
  * A directive used for "close buttons" (eg: alert box).
  * It hides its parent node that has the class with the name of its value.
*/
app.directive('ctDismiss', function () {
    return {
        restrict: 'A',
        link: function (scope, elem, attrs) {
            elem.on('click', function (e) {
                elem.parent('.' + attrs.ctDismiss).hide();
                e.preventDefault();
            });

        }
    };
});
'use strict';
/** 
  * Password-check directive.
*/
app.directive('compareTo', function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {

            ngModel.$validators.compareTo = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    };
});
'use strict';
/**
 * Create a custom CSS3 Select Elements.
 * You must use it as a class.
 * Combined with the class .cs-skin-slide it creates a slide <select>
 */
app.factory('SelectFx', ["$http",
function($http) {
	function hasParent(e, p) {
		if (!e)
			return false;
		var el = e.target || e.srcElement || e || false;
		while (el && el != p) {
			el = el.parentNode || false;
		}
		return (el !== false);
	};

	/**
	 * extend obj function
	 */
	function extend(a, b) {
		for (var key in b) {
			if (b.hasOwnProperty(key)) {
				a[key] = b[key];
			}
		}
		return a;
	}

	/**
	 * SelectFx function
	 */
	function SelectFx(el, options) {
		this.el = el[0];
		this.options = extend({}, this.options);
		extend(this.options, options);
		this._init();
	}

	function classReg(className) {
		return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}

	// classList support for class management
	// altho to be fair, the api sucks because it won't accept multiple classes at once
	var hasClass, addClass, removeClass;

	if ('classList' in document.documentElement) {
		hasClass = function(elem, c) {
			return elem.classList.contains(c);
		};
		addClass = function(elem, c) {
			elem.classList.add(c);
		};
		removeClass = function(elem, c) {
			elem.classList.remove(c);
		};
	} else {
		hasClass = function(elem, c) {
			return classReg(c).test(elem.className);
		};
		addClass = function(elem, c) {
			if (!hasClass(elem, c)) {
				elem.className = elem.className + ' ' + c;
			}
		};
		removeClass = function(elem, c) {
			elem.className = elem.className.replace(classReg(c), ' ');
		};
	}

	function toggleClass(elem, c) {
		var fn = hasClass(elem, c) ? removeClass : addClass;
		fn(elem, c);
	}

	var classie = {
		// full names
		hasClass : hasClass,
		addClass : addClass,
		removeClass : removeClass,
		toggleClass : toggleClass,
		// short names
		has : hasClass,
		add : addClass,
		remove : removeClass,
		toggle : toggleClass
	};

	// transport
	if ( typeof define === 'function' && define.amd) {
		// AMD
		define(classie);
	} else {
		// browser global
		window.classie = classie;
	}

	/**
	 * SelectFx options
	 */
	SelectFx.prototype.options = {
		// if true all the links will open in a new tab.
		// if we want to be redirected when we click an option, we need to define a data-link attr on the option of the native select element
		newTab : true,
		// when opening the select element, the default placeholder (if any) is shown
		stickyPlaceholder : true,
		// callback when changing the value
		onChange : function(val) {
			return false;
		}
	};

	/**
	 * init function
	 * initialize and cache some vars
	 */
	SelectFx.prototype._init = function() {

		var selectDisabled = false;
		var createSelect = true;
		if (this.el.hasAttribute("disabled")) {
			this.el.className = this.el.className + " disabled";
			selectDisabled = true;
		};

		if (this._styleExist(this.el.previousSibling)) {
			createSelect = false;
		}
		// check if we are using a placeholder for the native select box
		// we assume the placeholder is disabled and selected by default
		var selectedOpt = this.el.querySelectorAll('option[selected]')[this.el.querySelectorAll('option[selected]').length- 1];

		
		this.hasDefaultPlaceholder = selectedOpt && selectedOpt.disabled;
		
		// get selected option (either the first option with attr selected or just the first option)
		this.selectedOpt = selectedOpt || this.el.querySelector('option');

		// create structure
		this._createSelectEl();

		// all options
		this.selOpts = [].slice.call(this.selEl.querySelectorAll('li[data-option]'));

		// total options
		this.selOptsCount = this.selOpts.length;

		// current index
		this.current = this.selOpts.indexOf(this.selEl.querySelector('li.cs-selected')) || -1;

		// placeholder elem
		this.selPlaceholder = this.selEl.querySelector('span.cs-placeholder');

		if (!selectDisabled) {
			// init events
			this._initEvents(createSelect);
		}

	};
	/**
	 * creates the structure for the select element
	 */
	SelectFx.prototype._createSelectEl = function() {
		
		var self = this, options = '', createOptionHTML = function(el) {
			var optclass = '', classes = '', link = '';

			if (el.getAttribute('selected')) {
				
				classes += 'cs-selected ';
				
			}
			// extra classes
			if (el.getAttribute('data-class')) {
				classes += el.getAttribute('data-class');
			}
			// link options
			if (el.getAttribute('data-link')) {
				link = 'data-link=' + el.getAttribute('data-link');
			}

			if (classes !== '') {
				optclass = 'class="' + classes + '" ';
			}

			return '<li ' + optclass + link + ' data-option data-value="' + el.value + '"><span>' + el.textContent + '</span></li>';
		};

		[].slice.call(this.el.children).forEach(function(el) {
			if (el.disabled) {
				return;
			}

			var tag = el.tagName.toLowerCase();

			if (tag === 'option') {
				options += createOptionHTML(el);
			} else if (tag === 'optgroup') {
				options += '<li class="cs-optgroup"><span>' + el.label + '</span><ul>';
				[].slice.call(el.children).forEach(function(opt) {
					options += createOptionHTML(opt);
				});
				options += '</ul></li>';
			}
		});

		if (this._styleExist(this.el.previousSibling)) {
			this.selEl = this.el.parentNode;
			this.selEl.tabIndex = this.el.tabIndex;

			this.el.previousSibling.innerHTML = '<ul>' + options + '</ul>';

			return;
		} else {
			
			var opts_el = '<div class="cs-options"><ul>' + options + '</ul></div>';
			this.selEl = document.createElement('div');
			this.selEl.className = this.el.className;
			this.selEl.tabIndex = this.el.tabIndex;
			this.selEl.innerHTML = '<span class="cs-placeholder">' + this.selectedOpt.textContent + '</span>' + opts_el;
			this.el.parentNode.appendChild(this.selEl);
			this.selEl.appendChild(this.el);
		}

	};
	/**
	 * initialize the events
	 */
	SelectFx.prototype._initEvents = function(a) {

		var self = this;
		if (a) {
			// open/close select
			this.selPlaceholder.addEventListener('click', function() {
				self._toggleSelect();
			});
		}
		// clicking the options
		this.selOpts.forEach(function(opt, idx) {
			opt.addEventListener('click', function() {
				self.current = idx;
				self._changeOption();
				// close select elem
				self._toggleSelect();
			});
		});

		// close the select element if the target itÂ´s not the select element or one of its descendants..
		document.addEventListener('click', function(ev) {
			var target = ev.target;
			if (self._isOpen() && target !== self.selEl && !hasParent(target, self.selEl)) {
				self._toggleSelect();
			}
		});

		// keyboard navigation events
		this.selEl.addEventListener('keydown', function(ev) {
			var keyCode = ev.keyCode || ev.which;

			switch (keyCode) {
				// up key
				case 38:
					ev.preventDefault();
					self._navigateOpts('prev');
					break;
				// down key
				case 40:
					ev.preventDefault();
					self._navigateOpts('next');
					break;
				// space key
				case 32:
					ev.preventDefault();
					if (self._isOpen() && typeof self.preSelCurrent != 'undefined' && self.preSelCurrent !== -1) {
						self._changeOption();
					}
					self._toggleSelect();
					break;
				// enter key
				case 13:
					ev.preventDefault();
					if (self._isOpen() && typeof self.preSelCurrent != 'undefined' && self.preSelCurrent !== -1) {
						self._changeOption();
						self._toggleSelect();
					}
					break;
				// esc key
				case 27:
					ev.preventDefault();
					if (self._isOpen()) {
						self._toggleSelect();
					}
					break;
			}
		});
	};
	/**
	 * navigate with up/dpwn keys
	 */
	SelectFx.prototype._navigateOpts = function(dir) {
		if (!this._isOpen()) {
			this._toggleSelect();
		}

		var tmpcurrent = typeof this.preSelCurrent != 'undefined' && this.preSelCurrent !== -1 ? this.preSelCurrent : this.current;

		if (dir === 'prev' && tmpcurrent > 0 || dir === 'next' && tmpcurrent < this.selOptsCount - 1) {
			// save pre selected current - if we click on option, or press enter, or press space this is going to be the index of the current option
			this.preSelCurrent = dir === 'next' ? tmpcurrent + 1 : tmpcurrent - 1;
			// remove focus class if any..
			this._removeFocus();
			// add class focus - track which option we are navigating
			classie.add(this.selOpts[this.preSelCurrent], 'cs-focus');
		}
	};
	/**
	 * open/close select
	 * when opened show the default placeholder if any
	 */
	SelectFx.prototype._toggleSelect = function() {
		// remove focus class if any..
		this._removeFocus();

		if (this._isOpen()) {
			if (this.current !== -1) {
				// update placeholder text
				this.selPlaceholder.textContent = this.selOpts[this.current].textContent;
			}
			classie.remove(this.selEl, 'cs-active');
		} else {
			if (this.hasDefaultPlaceholder && this.options.stickyPlaceholder) {
				// everytime we open we wanna see the default placeholder text
				this.selPlaceholder.textContent = this.selectedOpt.textContent;
			}
			classie.add(this.selEl, 'cs-active');
		}
	};
	/**
	 * detect if .cs-options wrapper is active for each select
	 */
	SelectFx.prototype._styleExist = function(e) {
		return (' ' + e.className + ' ').indexOf(' cs-options ') > -1;
	};
	/**
	 * change option - the new value is set
	 */
	SelectFx.prototype._changeOption = function() {

		// if pre selected current (if we navigate with the keyboard)...
		if ( typeof this.preSelCurrent != 'undefined' && this.preSelCurrent !== -1) {
			this.current = this.preSelCurrent;
			this.preSelCurrent = -1;
		}

		// current option
		var opt = this.selOpts[this.current];

		// update current selected value
		this.selPlaceholder.textContent = opt.textContent;

		// change native select elementÂ´s value
		this.el.value = opt.getAttribute('data-value');
		var event = new Event('change');
		this.el.dispatchEvent(event);

		// remove class cs-selected from old selected option and add it to current selected option
		var oldOpt = this.selEl.querySelector('li.cs-selected');
		if (oldOpt) {
			classie.remove(oldOpt, 'cs-selected');
		}
		classie.add(opt, 'cs-selected');

		// if thereÂ´s a link defined
		if (opt.getAttribute('data-link')) {
			// open in new tab?
			if (this.options.newTab) {
				window.open(opt.getAttribute('data-link'), '_blank');
			} else {
				window.location = opt.getAttribute('data-link');
			}
		}

		// callback
		this.options.onChange(this.el.value);
	};
	/**
	 * returns true if select element is opened
	 */
	SelectFx.prototype._isOpen = function(opt) {
		return classie.has(this.selEl, 'cs-active');
	};
	/**
	 * removes the focus class from the option
	 */
	SelectFx.prototype._removeFocus = function(opt) {
		var focusEl = this.selEl.querySelector('li.cs-focus')
		if (focusEl) {
			classie.remove(focusEl, 'cs-focus');
		}
	};

	return SelectFx;
}]);

app.directive('csSelect', ["SelectFx", "$timeout",
function(SelectFx, $timeout) {
	return {
		restrict : 'AC',
		link : function($scope, $element, $attributes) {
			
			$scope.$watch(function() {
				return $element.find('option').length;
			}, function(newValue, oldValue) {
				if (newValue !== oldValue) {

					new SelectFx($element);
				}
			});
			$timeout( function(){ new SelectFx($element); });
			

		}
	};
}]);

'use strict';
/** 
  * Returns the id of the selected e-mail. 
*/
app.directive('messageItem', ['$location', function ($location) {
    return {
        restrict: 'EA',
        link: function (scope, elem, attrs) {
            elem.on("click tap", function (e) {
                var id = attrs.messageItem;
            });
        }
    };
}]);

(function () {
    'use strict';
    app.directive('continuousChat', ContinuousChat);

    function ContinuousChat() {
        var chatTemplate = '<div>' + '<ol class="discussion">' + '<li class="messages-date" ng-repeat-start="message in newChatArray()" ng-if="displayDate($index) || $index == 0">{{message.date | amDateFormat:\'dddd, MMM D, h:mm a\'}}</li>' + '<li ng-class="{\'self\' : message.idUser == idSelf, \'other\' : message.idUser !== idSelf, \'nextSame\': newChatArray()[$index+1].idUser == message.idUser && !nextDate($index)}" ng-repeat-end>' + '<div class="message">' + '<div class="message-name" ng-if="newChatArray()[$index-1].idUser !== message.idUser || displayDate($index)">{{  message.user }}</div>' + '<div class="message-text">{{ message.content }}</div>' + '<div class="message-avatar"><img ng-src="{{ message.avatar }}" alt=""></div>' + '</div>' + '</li>' + '</ol>';
        var directive = {
            restrict: 'EA',
            template: chatTemplate,
            replace: true,
            scope: {
                messages: "=",
                idSelf: "=",
                idOther: "="
            },
            link: function ($scope, $element, $attrs) {
                $scope.newChatArray = function () {
                    var filtered = [];
                    for (var i = 0; i < $scope.messages.length; i++) {
                        var item = $scope.messages[i];
                        if ((item.idUser == $scope.idSelf || item.idOther == $scope.idSelf) && (item.idUser == $scope.idOther || item.idOther == $scope.idOther)) {
                            filtered.push(item);
                        }
                    }

                    return filtered;
                };

                $scope.displayDate = function (i) {
                    var prevDate, nextDate, diffMs, diffMins;
                    var messages = $scope.newChatArray();
                    if (i === 0) {


                        if (messages.length > 1) {
                            prevDate = new Date(messages[i].date);
                            nextDate = new Date(messages[i + 1].date);
                            diffMs = (nextDate - prevDate);
                            diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000);
                        } else {
                            return true
                        }
                    } else {
                        prevDate = new Date(messages[i - 1].date);
                        nextDate = new Date(messages[i].date);
                        diffMs = (nextDate - prevDate);
                        diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000);

                    }
                    if (diffMins > 1) {
                        return true;
                    } else {
                        return false;
                    }
                };
                $scope.nextDate = function (i) {
                    var prevDate, nextDate, diffMs, diffMins;
                    var messages = $scope.newChatArray();
                    if (i < messages.length - 1) {

                        prevDate = new Date(messages[i].date);
                        nextDate = new Date(messages[i + 1].date);
                        diffMs = (nextDate - prevDate);
                        diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000);

                    }
                    if (diffMins > 1) {
                        return true;
                    } else {
                        return false;
                    }
                };

            }
        };

        return directive;
    }
    app.directive('chatSubmit', SubmitChat);

    function SubmitChat() {
        var submitTemplate = '<form ng-submit="submitChat()">' + '<div class="message-bar">' + '<div class="message-inner">' + '<a href="#" class="link icon-only"><i class="fa fa-camera"></i></a>' + '<div class="message-area"><input placeholder="Message" ng-model="ngModel" /></div>' + '<a translate="offsidebar.chat.SEND" href="#" class="link ng-scope" ng-click="submitChat()">Send</a>' + '</div>' + '</div>' + '</form>' + '</div>';
        var directive = {
            restrict: 'EA',
            template: submitTemplate,
            replace: true,
            scope: {
                submitFunction: "=",
                ngModel: "="
            },
            link: function ($scope, $element, $attrs) {

                $scope.submitChat = function () {
                    $scope.submitFunction();


                    if (typeof $attrs.scrollElement !== "undefined") {
                        var scrlEl = angular.element($attrs.scrollElement);
                        var lastElement = scrlEl.find('.discussion > li:last');
                        if (lastElement.length)
                            scrlEl.scrollToElementAnimated(lastElement);
                    }

                };
            }
        };

        return directive;
    }


})();

'use strict';
app.directive('jqSparkline', [
function() {'use strict';
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, elem, attrs, ngModel) {
			var opts = {};
			//TODO: Use $eval to get the object
			opts.type = attrs.type || 'line';
			opts.barColor = attrs.barColor || '#000000';
			opts.height = attrs.height || '35px';
			opts.width = attrs.width || '35px';
			opts.barWidth = attrs.barWidth || '5px';
			opts.barSpacing = attrs.barSpacing || '2px';
			opts.zeroAxis = attrs.zeroAxis || 'true';
			opts.resize = attrs.resize || false;
			opts.fillColor = attrs.fillColor || '#cdf';
			opts.lineWidth = attrs.lineWidth || 1;
			opts.lineColor = attrs.lineColor || '#00f';
			opts.spotColor = attrs.spotColor || '#f80';
			opts.spotRadius = attrs.spotRadius || 1.5;
			opts.minSpotColor = attrs.minSpotColor || '#f80';
			opts.maxSpotColor = attrs.maxSpotColor || '#f80';
			opts.highlightSpotColor = attrs.highlightSpotColor || '#5f5';
			opts.highlightLineColor = attrs.highlightLineColor || '#f22';
			
			

			scope.$watch(attrs.ngModel, function() {
				render();
			});
			scope.$watch(attrs.opts, function() {
				render();
			});
			var render = function() {
				var model;
				if(attrs.opts)
					angular.extend(opts, angular.fromJson(attrs.opts));
				// Trim trailing comma if we are a string
				angular.isString(ngModel.$viewValue) ? model = ngModel.$viewValue.replace(/(^,)|(,$)/g, "") : model = ngModel.$viewValue;
				var data;
				// Make sure we have an array of numbers
				angular.isArray(model) ? data = model : data = model.split(',');
				$(elem).sparkline(data, opts);
			};

			// function to initiate Sparkline
			var sparkResize;
			$(window).resize(function(e) {
				if (opts.resize) {
					clearTimeout(sparkResize);
					sparkResize = setTimeout(render, 500);
				}
			});
		}
	};
}]);

'use strict';
app.directive('touchspin', function() {
	return {
		restrict: 'EA',
		link: function(scope, elem, attr) {
			var tsOptions = [
				'initval', 
				'min', 
				'max', 
				'step', 
				'forcestepdivisibility', 
				'decimals', 
				'stepinterval', 
				'stepintervaldelay', 
				'verticalbuttons', 
				'verticalupclass',
				'verticaldownclass',
				'prefix',
				'postfix',
				'prefix_extraclass',
				'postfix_extraclass',
				'booster',
				'boostat',
				'maxboostedstep',
				'mousewheel',
				'buttondown_class',
				'buttonup_class'				
				];
			var options = {};
			for(var i = 0, l = tsOptions.length; i < l; i++) {
				var opt = tsOptions[i];
				if(attr[opt] !== undefined) {
					options[opt] = attr[opt];
				}
			}
			elem.TouchSpin(options);
		}
	};
}); 
'use strict';


app


    // Angular File Upload module does not include this directive
    // Only for example


    /**
    * The ng-thumb directive
    * @author: nerv
    * @version: 0.1.2, 2014-01-09
    */
    .directive('ngThumb', ['$window', function($window) {
        var helper = {
            support: !!($window.FileReader && $window.CanvasRenderingContext2D),
            isFile: function(item) {
                return angular.isObject(item) && item instanceof $window.File;
            },
            isImage: function(file) {
                var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        };

        return {
            restrict: 'A',
            template: '<canvas/>',
            link: function(scope, element, attributes) {
                if (!helper.support) return;

                var params = scope.$eval(attributes.ngThumb);

                if (!helper.isFile(params.file)) return;
                if (!helper.isImage(params.file)) return;

                var canvas = element.find('canvas');
                var reader = new FileReader();

                reader.onload = onLoadFile;
                reader.readAsDataURL(params.file);

                function onLoadFile(event) {
                    var img = new Image();
                    img.onload = onLoadImage;
                    img.src = event.target.result;
                }

                function onLoadImage() {
                    var width = params.width || this.width / this.height * params.height;
                    var height = params.height || this.height / this.width * params.width;
                    canvas.attr({ width: width, height: height });
                    canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
                }
            }
        };
    }]);

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