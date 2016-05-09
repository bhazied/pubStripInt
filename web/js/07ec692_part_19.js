'use strict';
/**
 * Biody-Xpert Main Controller
 */
app.controller('AppCtrl', ['$rootScope', '$scope', '$state', '$translate', '$localStorage', '$window', '$document', '$timeout', 'cfpLoadingBar', '$filter', '$stateParams',
function($rootScope, $scope, $state, $translate, $localStorage, $window, $document, $timeout, cfpLoadingBar, $filter, $stateParams) {

	$scope.anonymousStates = ['auth.login', 'auth.register', 'auth.resetpassword', 'auth.reset', 'auth.lockscreen', 'auth.emailconfirm'];

	$timeout(function() {
		if ($scope.anonymousStates.indexOf($state.current.name) == -1 && !angular.isDefined($localStorage.access_token)) {
			$timeout(function() {
				console.warn('no access token > redirection');
				$state.go('auth.login');
			});
		}
	}, 2000);

	// Loading bar transition
	// -----------------------------------
	var $win = $($window);

	$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
		//start loading bar on stateChangeStart
		cfpLoadingBar.start();

	});
	
	$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {

		//stop loading bar on stateChangeSuccess
		event.targetScope.$watch("$viewContentLoaded", function() {

			cfpLoadingBar.complete();
		});

		// scroll top the page on change state
		$('#app .main-content').css({
			position : 'relative',
			top : 'auto'
		});
		
		$('footer').show();
		
		window.scrollTo(0, 0);

		if (angular.element('.email-reader').length) {
			angular.element('.email-reader').animate({
				scrollTop : 0
			}, 0);
		}

		// Save the route title
		$rootScope.currTitle = $filter('translate')($state.current.title);
	});

	// State not found
	$rootScope.$on('$stateNotFound', function(event, unfoundState, fromState, fromParams) {
		//$rootScope.loading = false;
		console.log(unfoundState.to);
		// "lazy.state"
		console.log(unfoundState.toParams);
		// {a:1, b:2}
		console.log(unfoundState.options);
		// {inherit:false} + default options
	});

	$rootScope.pageTitle = function() {
		return $rootScope.app.name + ' - ' + ($rootScope.currTitle || $rootScope.app.description);
	};

	// save settings to local storage
	if (angular.isDefined($localStorage.layout)) {
		$scope.app.layout = $localStorage.layout;
	} else {
		$localStorage.layout = $scope.app.layout;
	}
	$scope.$watch('app.layout', function() {
		// save to local storage
		$localStorage.layout = $scope.app.layout;
	}, true);

	//global function to scroll page up
	$scope.toTheTop = function() {

		$document.scrollTopAnimated(0, 600);

	};

	// angular translate
	// ----------------------

	$scope.language = {
		// Handles language dropdown
		listIsOpen : false,
		// list of available languages
		available : {
			'en' : 'English',
			'fr' : 'Français'
		},
		// display always the current ui language
		init : function() {
			if (angular.isDefined($stateParams.language)) {
				$scope.language.selected = $scope.language.available[$stateParams.language];
				$localStorage.language = $stateParams.language;
			} else {
				var proposedLanguage = $translate.proposedLanguage() || $translate.use();
				var preferredLanguage = $translate.preferredLanguage();
				for (var lang in $scope.language.available) {
					if (window.location.hash.endsWith('/'+lang)) {
						proposedLanguage = lang;
					}
				}
				// we know we have set a preferred one in app.config
				$scope.language.selected = $scope.language.available[(proposedLanguage || preferredLanguage)];
				$localStorage.language = (proposedLanguage || preferredLanguage);
			}
		},
		set : function(localeId, ev) {
			$translate.use(localeId);
			$scope.language.selected = $scope.language.available[localeId];
			$scope.language.listIsOpen = !$scope.language.listIsOpen;
			$localStorage.language = localeId;
			$rootScope.$broadcast('languageChange', [localeId]);
		}
	};

	$scope.language.init();

	// Function that find the exact height and width of the viewport in a cross-browser way
	var viewport = function() {
		var e = window, a = 'inner';
		if (!('innerWidth' in window)) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return {
			width : e[a + 'Width'],
			height : e[a + 'Height']
		};
	};
	// function that adds information in a scope of the height and width of the page
	$scope.getWindowDimensions = function() {
		return {
			'h' : viewport().height,
			'w' : viewport().width
		};
	};
	// Detect when window is resized and set some variables
	$scope.$watch($scope.getWindowDimensions, function(newValue, oldValue) {
		$scope.windowHeight = newValue.h;
		$scope.windowWidth = newValue.w;
		
		if (newValue.w >= 992) {
			$scope.isLargeDevice = true;
		} else {
			$scope.isLargeDevice = false;
		}
		if (newValue.w < 992) {
			$scope.isSmallDevice = true;
		} else {
			$scope.isSmallDevice = false;
		}
		if (newValue.w <= 768) {
			$scope.isMobileDevice = true;
		} else {
			$scope.isMobileDevice = false;
		}
	}, true);
	// Apply on resize
	$win.on('resize', function() {
		
		$scope.$apply();
		if ($scope.isLargeDevice) {
			$('#app .main-content').css({
				position : 'relative',
				top : 'auto',
				width: 'auto'
			});
			$('footer').show();
		}
	});
    
}]);

'use strict';

/**
 * File Manager Modal Controller
 */

app.controller('FileManagerCtrl', ['$scope', '$localStorage', '$timeout', '$uibModalInstance', 'field', 'value',
function ($scope, $localStorage, $timeout, $uibModalInstance, field, value) {

    $scope.field = field;
    $scope.value = value;
    $scope.url = '';
    $scope.mode = '';

    $timeout(function(){
        var fileManager = $('#elfinder_'+$scope.field).elfinder({
            url : '/efconnect'+'?mode='+$scope.mode,
            lang : (angular.isDefined($localStorage.language))?$localStorage.language:'en',
            useBrowserHistory: false,
            onlyMimes: ['image', 'video'],
            customHeaders: {
                'Authorization': 'Bearer ' + $localStorage.access_token,
                'BX-Application': 'BackOffice'
            },
            getFileCallback : function(file) {
                var parser = document.createElement('a');
                parser.href = file.url;
                $scope.url = parser.pathname;
            }
        });
    });

    $scope.ok = function () {
        $uibModalInstance.close($scope.url);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

}]);

'use strict';
/**
 * controllers for UI Bootstrap components
 */
app.controller('AlertDemoCtrl', ["$scope", function ($scope) {
    $scope.alerts = [{
        type: 'danger',
        msg: 'Oh snap! Change a few things up and try submitting again.'
    }, {
        type: 'success',
        msg: 'Well done! You successfully read this important alert message.'
    }];

    $scope.addAlert = function () {
        $scope.alerts.push({
            msg: 'Another alert!'
        });
    };

    $scope.closeAlert = function (index) {
        $scope.alerts.splice(index, 1);
    };
}]).controller('ButtonsCtrl', ["$scope", function ($scope) {
    $scope.singleModel = 1;

    $scope.radioModel = 'Middle';

    $scope.checkModel = {
        left: false,
        middle: true,
        right: false
    };
}]).controller('ProgressDemoCtrl', ["$scope", function ($scope) {
    $scope.max = 200;

    $scope.random = function () {
        var value = Math.floor((Math.random() * 100) + 1);
        var type;

        if (value < 25) {
            type = 'success';
        } else if (value < 50) {
            type = 'info';
        } else if (value < 75) {
            type = 'warning';
        } else {
            type = 'danger';
        }

        $scope.showWarning = (type === 'danger' || type === 'warning');

        $scope.dynamic = value;
        $scope.type = type;
    };
    $scope.random();

    $scope.randomStacked = function () {
        $scope.stacked = [];
        var types = ['success', 'info', 'warning', 'danger'];

        for (var i = 0, n = Math.floor((Math.random() * 4) + 1) ; i < n; i++) {
            var index = Math.floor((Math.random() * 4));
            $scope.stacked.push({
                value: Math.floor((Math.random() * 30) + 1),
                type: types[index]
            });
        }
    };
    $scope.randomStacked();
}]).controller('TooltipDemoCtrl', ["$scope", function ($scope) {
    $scope.dynamicTooltip = 'I am a dynamic Tooltip text';
    $scope.dynamicTooltipText = 'I am a dynamic Tooltip Popup text';
    $scope.htmlTooltip = 'I\'ve been made <b>bold</b>!';
}]).controller('PopoverDemoCtrl', ["$scope", function ($scope) {
    $scope.dynamicPopover = 'Hello, World!';
    $scope.dynamicPopoverTitle = 'Title';
    $scope.popoverType = 'bottom';
}]).controller('PaginationDemoCtrl', ["$scope", "$log", function ($scope, $log) {
    $scope.totalItems = 64;
    $scope.currentPage = 4;

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function () {
        $log.log('Page changed to: ' + $scope.currentPage);
    };

    $scope.maxSize = 5;
    $scope.bigTotalItems = 175;
    $scope.bigCurrentPage = 1;
}]).controller('RatingDemoCtrl', ["$scope", function ($scope) {
    $scope.rate = 7;
    $scope.max = 10;
    $scope.isReadonly = false;

    $scope.hoveringOver = function (value) {
        $scope.overStar = value;
        $scope.percent = 100 * (value / $scope.max);
    };

    $scope.ratingStates = [{
        stateOn: 'glyphicon-ok-sign',
        stateOff: 'glyphicon-ok-circle'
    }, {
        stateOn: 'glyphicon-star',
        stateOff: 'glyphicon-star-empty'
    }, {
        stateOn: 'glyphicon-heart',
        stateOff: 'glyphicon-ban-circle'
    }, {
        stateOn: 'glyphicon-heart'
    }, {
        stateOff: 'glyphicon-off'
    }];
}]).controller('DropdownCtrl', ["$scope", "$log", function ($scope, $log) {
    $scope.items = ['The first choice!', 'And another choice for you.', 'but wait! A third!'];

    $scope.status = {
        isopen: false
    };

    $scope.toggled = function (open) {
        $log.log('Dropdown is now: ', open);
    };

    $scope.toggleDropdown = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };
}]).controller('TabsDemoCtrl', ["$scope", "SweetAlert", function ($scope, SweetAlert) {
    $scope.tabs = [{
        title: 'Dynamic Title 1',
        content: 'Dynamic content 1'
    }, {
        title: 'Dynamic Title 2',
        content: 'Dynamic content 2',
        disabled: false
    }];

    $scope.alertMe = function () {
        setTimeout(function () {
            SweetAlert.swal({
	        	title: 'You\'ve selected the alert tab!',
	        	confirmButtonColor: '#007AFF'
        	});
        });
    };
}]).controller('AccordionDemoCtrl', ["$scope", function ($scope) {
    $scope.oneAtATime = true;

    $scope.groups = [{
        title: 'Dynamic Group Header - 1',
        content: 'Dynamic Group Body - 1'
    }, {
        title: 'Dynamic Group Header - 2',
        content: 'Dynamic Group Body - 2'
    }];

    $scope.items = ['Item 1', 'Item 2', 'Item 3'];

    $scope.addItem = function () {
        var newItemNo = $scope.items.length + 1;
        $scope.items.push('Item ' + newItemNo);
    };

    $scope.status = {
        isFirstOpen: true,
        isFirstDisabled: false
    };
}]).controller('DatepickerDemoCtrl', ["$scope", "$log", function ($scope, $log) {
    $scope.today = function () {
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function () {
        $scope.dt = null;
    };

    // Disable weekend selection
    $scope.disabled = function (date, mode) {
        return (mode === 'day' && (date.getDay() === 0 || date.getDay() === 6));
    };

    $scope.toggleMin = function () {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();
 	$scope.maxDate = new Date(2020, 5, 22);
    $scope.open = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = !$scope.opened;
    };
    $scope.endOpen = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.startOpened = false;
        $scope.endOpened = !$scope.endOpened;
    };
    $scope.startOpen = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.endOpened = false;
        $scope.startOpened = !$scope.startOpened;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

    $scope.hstep = 1;
    $scope.mstep = 15;

    // Time Picker
    $scope.options = {
        hstep: [1, 2, 3],
        mstep: [1, 5, 10, 15, 25, 30]
    };

    $scope.ismeridian = true;
    $scope.toggleMode = function () {
        $scope.ismeridian = !$scope.ismeridian;
    };

    $scope.update = function () {
        var d = new Date();
        d.setHours(14);
        d.setMinutes(0);
        $scope.dt = d;
    };

    $scope.changed = function () {
        $log.log('Time changed to: ' + $scope.dt);
    };

    $scope.clear = function () {
        $scope.dt = null;
    };

}]).controller('DropdownCtrl', ["$scope", "$log", function ($scope, $log) {
    $scope.items = ['The first choice!', 'And another choice for you.', 'but wait! A third!'];

    $scope.status = {
        isopen: false
    };

    $scope.toggled = function (open) {
        $log.log('Dropdown is now: ', open);
    };

    $scope.toggleDropdown = function ($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.status.isopen = !$scope.status.isopen;
    };
}]).controller('ModalDemoCtrl', ["$scope", "$uibModal", "$log", function ($scope, $uibModal, $log) {

    $scope.items = ['item1', 'item2', 'item3'];

    $scope.open = function (size) {

        var modalInstance = $uibModal.open({
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function () {
                    return $scope.items;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
}]);

// Please note that $uibModalInstance represents a modal window (instance) dependency.
// It is not the same as the $uibModal service used above.

app.controller('ModalInstanceCtrl', ["$scope", "$uibModalInstance", "items", function ($scope, $uibModalInstance, items) {

    $scope.items = items;
    $scope.selected = {
        item: $scope.items[0]
    };

    $scope.ok = function () {
        $uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}]);