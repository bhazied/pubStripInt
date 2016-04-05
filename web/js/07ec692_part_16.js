'use strict';

/**
 * @ngdoc overview
 * @name urbanApp
 * @description
 * # urbanApp
 *
 * Main module of the application.
 */
angular
  .module('publiPrApp', [
    'ui.router',
    'ngAnimate',
    'ui.bootstrap',
    'oc.lazyLoad',
    'ngStorage',
    'ngSanitize',
    'ui.utils',
    'ngTouch',
    'ngCookies',
    'ngResource',
    'cfp.loadingBar',
    'ncy-angular-breadcrumb',
    'duScroll',
    'pascalprecht.translate',
    'angular-bind-html-compile',
    'slugifier',
    'toaster'
  ])
  .constant('COLORS', {
    'default': '#e2e2e2',
    primary: '#09c',
    success: '#2ECC71',
    warning: '#ffc65d',
    danger: '#d96557',
    info: '#4cc3d9',
    white: 'white',
    dark: '#4C5064',
    border: '#e4e4e4',
    bodyBg: '#e0e8f2',
    textColor: '#6B6B6B',
  });

'use strict';

angular
  .module('urbanApp')
  .controller('AppCtrl', ['$scope', '$http', '$localStorage',
        function AppCtrl($scope, $http, $localStorage) {

      $scope.mobileView = 767;

      $scope.app = {
        name: 'Urban',
        author: 'Nyasha',
        version: '1.0.0',
        year: (new Date()).getFullYear(),
        layout: {
          isSmallSidebar: false,
          isChatOpen: false,
          isFixedHeader: true,
          isFixedFooter: false,
          isBoxed: false,
          isStaticSidebar: false,
          isRightSidebar: false,
          isOffscreenOpen: false,
          isConversationOpen: false,
          isQuickLaunch: false,
          sidebarTheme: '',
          headerTheme: ''
        },
        isMessageOpen: false,
        isConfigOpen: false
      };

      $scope.user = {
        fname: 'Samuel',
        lname: 'Perkins',
        jobDesc: 'Human Resources Guy',
        avatar: 'images/avatar.jpg',
      };

      if (angular.isDefined($localStorage.layout)) {
        $scope.app.layout = $localStorage.layout;
      } else {
        $localStorage.layout = $scope.app.layout;
      }

      $scope.$watch('app.layout', function () {
        $localStorage.layout = $scope.app.layout;
      }, true);

      $scope.getRandomArbitrary = function () {
        return Math.round(Math.random() * 100);
      };
    }
]);

app.constant('APP_JS_REQUIRES', {
    //*** Scripts
    scripts: {
        //*** Controllers
        'LoginCtrl': '/bundles/publipr/js/components/Auth/LoginCtrl.js',
        'LockScreenCtrl': '/bundles/publipr/js/components/Auth/LockScreenCtrl.js',
        'RegisterCtrl': '/bundles/publipr/js/components/Auth/RegisterCtrl.js',
        'EmailConfirmCtrl': '/bundles/publipr/js/components/Auth/EmailConfirmCtrl.js',
        'ResetPasswordCtrl': '/bundles/publipr/js/components/Auth/ResetPasswordCtrl.js',
        'ResetCtrl': '/bundles/publipr/js/components/Auth/ResetCtrl.js',
        'DashboardCtrl': '/bundles/publipr/js/components/Main/DashboardCtrl.js',
        'CompaniesCtrl': '/bundles/publipr/js/components/Company/CompaniesCtrl.js',
        'CompanyFormCtrl': '/bundles/publipr/js/components/Company/CompanyFromCtrl.js',
        'CompanyCtrl': '/bundles/publipr/js/components/Company/CompanyCtrl.js',
        'ContactsCtrl': '/bundles/publipr/js/components/Contact/ContactsCtrl.js',
        'ContactFormCtrl': '/bundles/publipr/js/components/Contact/ContactFromCtrl.js',
        'ContactCtrl': '/bundles/publipr/js/components/Contact/ContactCtrl.js',
        'ContactGroupsCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupsCtrl.js',
        'ContactGroupFormCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupFromCtrl.js',
        'ContactGroupCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupCtrl.js',
        'ContentBlocksCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlocksCtrl.js',
        'ContentBlockFormCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockFromCtrl.js',
        'ContentBlockCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockCtrl.js',
        'CountriesCtrl': '/bundles/publipr/js/components/Country/CountriesCtrl.js',
        'CountryFormCtrl': '/bundles/publipr/js/components/Country/CountryFromCtrl.js',
        'CountryCtrl': '/bundles/publipr/js/components/Country/CountryCtrl.js',
        'EmailsCtrl': '/bundles/publipr/js/components/Email/EmailsCtrl.js',
        'EmailFormCtrl': '/bundles/publipr/js/components/Email/EmailFromCtrl.js',
        'EmailCtrl': '/bundles/publipr/js/components/Email/EmailCtrl.js',
        'EmailCampaignsCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignsCtrl.js',
        'EmailCampaignFormCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignFromCtrl.js',
        'EmailCampaignCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignCtrl.js',
        'EmailTemplatesCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplatesCtrl.js',
        'EmailTemplateFormCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateFromCtrl.js',
        'EmailTemplateCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateCtrl.js',
        'FontsCtrl': '/bundles/publipr/js/components/Font/FontsCtrl.js',
        'FontFormCtrl': '/bundles/publipr/js/components/Font/FontFromCtrl.js',
        'FontCtrl': '/bundles/publipr/js/components/Font/FontCtrl.js',
        'LanguagesCtrl': '/bundles/publipr/js/components/Language/LanguagesCtrl.js',
        'LanguageFormCtrl': '/bundles/publipr/js/components/Language/LanguageFromCtrl.js',
        'LanguageCtrl': '/bundles/publipr/js/components/Language/LanguageCtrl.js',
        'LayoutsCtrl': '/bundles/publipr/js/components/Layout/LayoutsCtrl.js',
        'LayoutFormCtrl': '/bundles/publipr/js/components/Layout/LayoutFromCtrl.js',
        'LayoutCtrl': '/bundles/publipr/js/components/Layout/LayoutCtrl.js',
        'LogsCtrl': '/bundles/publipr/js/components/Log/LogsCtrl.js',
        'LogFormCtrl': '/bundles/publipr/js/components/Log/LogFromCtrl.js',
        'LogCtrl': '/bundles/publipr/js/components/Log/LogCtrl.js',
        'NewsroomsCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomsCtrl.js',
        'NewsroomFormCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomFromCtrl.js',
        'NewsroomCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomCtrl.js',
        'NewsroomTemplatesCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplatesCtrl.js',
        'NewsroomTemplateFormCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateFromCtrl.js',
        'NewsroomTemplateCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateCtrl.js',
        'NewsroomsUsersCtrl': '/bundles/publipr/js/components/NewsroomsUsers/NewsroomsUsersCtrl.js',
        'NewsroomsUsersFormCtrl': '/bundles/publipr/js/components/NewsroomsUsers/NewsroomsUsersFromCtrl.js',
        'NewsroomsUsersCtrl': '/bundles/publipr/js/components/NewsroomsUsers/NewsroomsUsersCtrl.js',
        'PaymentsCtrl': '/bundles/publipr/js/components/Payment/PaymentsCtrl.js',
        'PaymentFormCtrl': '/bundles/publipr/js/components/Payment/PaymentFromCtrl.js',
        'PaymentCtrl': '/bundles/publipr/js/components/Payment/PaymentCtrl.js',
        'PressReleasesCtrl': '/bundles/publipr/js/components/PressRelease/PressReleasesCtrl.js',
        'PressReleaseFormCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseFromCtrl.js',
        'PressReleaseCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseCtrl.js',
        'SessionsCtrl': '/bundles/publipr/js/components/Session/SessionsCtrl.js',
        'SessionFormCtrl': '/bundles/publipr/js/components/Session/SessionFromCtrl.js',
        'SessionCtrl': '/bundles/publipr/js/components/Session/SessionCtrl.js',
        'SettingsCtrl': '/bundles/publipr/js/components/Setting/SettingsCtrl.js',
        'SettingFormCtrl': '/bundles/publipr/js/components/Setting/SettingFromCtrl.js',
        'SettingCtrl': '/bundles/publipr/js/components/Setting/SettingCtrl.js',
        'TemplatesCtrl': '/bundles/publipr/js/components/Template/TemplatesCtrl.js',
        'TemplateFormCtrl': '/bundles/publipr/js/components/Template/TemplateFromCtrl.js',
        'TemplateCtrl': '/bundles/publipr/js/components/Template/TemplateCtrl.js',
        'TrackEmailsCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailsCtrl.js',
        'TrackEmailFormCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailFromCtrl.js',
        'TrackEmailCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailCtrl.js',
        'TrackPressReleasesCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleasesCtrl.js',
        'TrackPressReleaseFormCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseFromCtrl.js',
        'TrackPressReleaseCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseCtrl.js',
        'UsersCtrl': '/bundles/publipr/js/components/User/UsersCtrl.js',
        'UserFormCtrl': '/bundles/publipr/js/components/User/UserFromCtrl.js',
        'UserCtrl': '/bundles/publipr/js/components/User/UserCtrl.js'
    },
    modules: [{
        name: 'LoginService',
        files: ['/bundles/publipr/js/components/Auth/LoginService.js']
    },{
        name: 'RegisterService',
        files: ['/bundles/publipr/js/components/Auth/RegisterService.js']
    },{
        name: 'ResetPasswordService',
        files: ['/bundles/publipr/js/components/Auth/ResetPasswordService.js']
    },{
        name: 'DashboardService',
        files: ['/bundles/publipr/js/components/Main/DashboardService.js']
    },{
        name: 'companyService',
        files: ['/bundles/publipr/js/components/Company/CompanyService.js']
    },{
        name: 'contactService',
        files: ['/bundles/publipr/js/components/Contact/ContactService.js']
    },{
        name: 'contactGroupService',
        files: ['/bundles/publipr/js/components/ContactGroup/ContactGroupService.js']
    },{
        name: 'contentBlockService',
        files: ['/bundles/publipr/js/components/ContentBlock/ContentBlockService.js']
    },{
        name: 'countryService',
        files: ['/bundles/publipr/js/components/Country/CountryService.js']
    },{
        name: 'emailService',
        files: ['/bundles/publipr/js/components/Email/EmailService.js']
    },{
        name: 'emailCampaignService',
        files: ['/bundles/publipr/js/components/EmailCampaign/EmailCampaignService.js']
    },{
        name: 'emailTemplateService',
        files: ['/bundles/publipr/js/components/EmailTemplate/EmailTemplateService.js']
    },{
        name: 'fontService',
        files: ['/bundles/publipr/js/components/Font/FontService.js']
    },{
        name: 'languageService',
        files: ['/bundles/publipr/js/components/Language/LanguageService.js']
    },{
        name: 'layoutService',
        files: ['/bundles/publipr/js/components/Layout/LayoutService.js']
    },{
        name: 'logService',
        files: ['/bundles/publipr/js/components/Log/LogService.js']
    },{
        name: 'newsroomService',
        files: ['/bundles/publipr/js/components/Newsroom/NewsroomService.js']
    },{
        name: 'newsroomTemplateService',
        files: ['/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateService.js']
    },{
        name: 'newsroomsUsersService',
        files: ['/bundles/publipr/js/components/NewsroomsUsers/NewsroomsUsersService.js']
    },{
        name: 'paymentService',
        files: ['/bundles/publipr/js/components/Payment/PaymentService.js']
    },{
        name: 'pressReleaseService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseService.js']
    },{
        name: 'sessionService',
        files: ['/bundles/publipr/js/components/Session/SessionService.js']
    },{
        name: 'settingService',
        files: ['/bundles/publipr/js/components/Setting/SettingService.js']
    },{
        name: 'templateService',
        files: ['/bundles/publipr/js/components/Template/TemplateService.js']
    },{
        name: 'trackEmailService',
        files: ['/bundles/publipr/js/components/TrackEmail/TrackEmailService.js']
    },{
        name: 'trackPressReleaseService',
        files: ['/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseService.js']
    },{
        name: 'userService',
        files: ['/bundles/publipr/js/components/User/UserService.js']
    }]
});

'use strict';

angular
  .module('urbanApp')
  .run(['$rootScope', '$state', '$stateParams',
        function ($rootScope, $state, $stateParams) {
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;
      $rootScope.$on('$stateChangeSuccess', function () {
        window.scrollTo(0, 0);
      });
      FastClick.attach(document.body);
        },
    ])
  .config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {

      // For unmatched routes
      $urlRouterProvider.otherwise('/');

      // Application routes
      $stateProvider
        .state('app', {
          abstract: true,
          templateUrl: 'views/common/layout.html',
        })


      .state('app.dashboard', {
        url: '/',
        templateUrl: 'views/dashboard.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                insertBefore: '#load_styles_before',
                files: [
                                'styles/climacons-font.css',
                                'vendor/rickshaw/rickshaw.min.css'
                            ]
                        },
              {
                serie: true,
                files: [
                                'vendor/d3/d3.min.js',
                                'vendor/rickshaw/rickshaw.min.js',
                                'vendor/flot/jquery.flot.js',
                                'vendor/flot/jquery.flot.resize.js',
                                'vendor/flot/jquery.flot.pie.js',
                                'vendor/flot/jquery.flot.categories.js',
                            ]
                        },
              {
                  name: 'angular-flot',
                  files: [
                                'vendor/angular-flot/angular-flot.js'
                            ]
                        }]).then(function () {
              return $ocLazyLoad.load('scripts/controllers/dashboard.js');
            });
                    }]
        },
        data: {
          title: 'Dashboard',
        }
      })


      // UI Routes
      .state('app.ui', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/ui',
        })
        .state('app.ui.buttons', {
          url: '/buttons',
          templateUrl: 'views/ui-buttons.html',
          data: {
            title: 'Buttons',
          }
        })
        .state('app.ui.directives', {
          url: '/directives',
          templateUrl: 'views/ui-general.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/checkbo/src/0.1.4/css/checkBo.min.css',
                                'vendor/chosen_v1.4.0/chosen.min.css'
                            ]
                        },
                {
                  files: [
                                'vendor/checkbo/src/0.1.4/js/checkBo.min.js',
                                'vendor/chosen_v1.4.0/chosen.jquery.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/bootstrap.ui.js');
              });
                    }]
          },
          data: {
            title: 'Bootstrap Directives',
          }
        })
        .state('app.ui.tabs_accordion', {
          url: '/tabs_accordions',
          templateUrl: 'views/ui-tabs-accordion.html',
          data: {
            title: 'Nav Tabs',
          }
        })
        .state('app.ui.portlets', {
          url: '/portlets',
          templateUrl: 'views/ui-portlets.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                'vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js',
                                'vendor/jquery.ui/ui/core.js',
                                'vendor/jquery.ui/ui/widget.js',
                                'vendor/jquery.ui/ui/mouse.js',
                                'vendor/jquery.ui/ui/sortable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/draggable.js');
              });
                    }]
          },
          data: {
            title: 'Portlets',
          }
        })
        .state('app.ui.fontawesome', {
          url: '/fontawesome',
          templateUrl: 'views/ui-fontawesome.html',
          data: {
            title: 'Fontawesome Icons',
          }
        })
        .state('app.ui.feather', {
          url: '/feather',
          templateUrl: 'views/ui-feather.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('styles/feather.css');
                    }]
          },
          data: {
            title: 'Feather Icons',
          }
        })
        .state('app.ui.climacon', {
          url: '/climacon',
          templateUrl: 'views/ui-climacon.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('styles/climacons-font.css');
                    }]
          },
          data: {
            title: 'Climacon Icons',
          }
        })
        .state('app.ui.progressbars', {
          url: '/progressbars',
          templateUrl: 'views/ui-progressbars.html',
          data: {
            title: 'Progress Bars',
          }
        })
        .state('app.ui.sliders', {
          url: '/sliders',
          templateUrl: 'views/ui-sliders.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                'vendor/jquery.ui/ui/core.js',
                                'vendor/jquery.ui/ui/widget.js',
                                'vendor/jquery.ui/ui/mouse.js',
                                'vendor/jquery.ui/ui/slider.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/slider.js');
              });
                    }]
          },
          data: {
            title: 'Sliders',
          }
        })
        .state('app.ui.pagination', {
          url: '/pagination',
          templateUrl: 'views/ui-pagination.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/bootstrap.ui.js');
                    }]
          },
          data: {
            title: 'Pagination',
          }
        })
        .state('app.ui.notifications', {
          url: '/notifications',
          templateUrl: 'views/ui-notifications.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: ['vendor/chosen_v1.4.0/chosen.min.css']
                        },
                {
                  serie: true,
                  files: [
                                'vendor/chosen_v1.4.0/chosen.jquery.min.js',
                                'vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js',
                                'scripts/extentions/noty-defaults.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/notifications.js');
              });
                    }]
          },
          data: {
            title: 'Notifications',
          }
        })
        .state('app.ui.alert', {
          url: '/alert',
          templateUrl: 'views/ui-alert.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: ['vendor/sweetalert/dist/sweetalert.css']
                        },
                {
                  name: 'oitozero.ngSweetAlert',
                  files: [
                                'vendor/sweetalert/dist/sweetalert.min.js',
                                'vendor/angular-sweetalert/SweetAlert.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/alert.js');
              });
                    }]
          },
          data: {
            title: 'Alerts',
          }
        })


      // Forms routes
      .state('app.forms', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/forms',
        })
        .state('app.forms.native_forms', {
          url: '/native_forms',
          templateUrl: 'views/form-basic.html',
          data: {
            title: 'Native Form Elements',
          }
        })
        .state('app.forms.advanced_forms', {
          url: '/advanced_forms',
          templateUrl: 'views/form-advanced.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css',
                                'vendor/chosen_v1.4.0/chosen.min.css',
                                'vendor/jquery.tagsinput/src/jquery.tagsinput.css',
                                'vendor/checkbo/src/0.1.4/css/checkBo.min.css',
                                'vendor/intl-tel-input/build/css/intlTelInput.css',
                                'vendor/bootstrap-daterangepicker/daterangepicker-bs3.css',
                                'vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
                                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                                'vendor/clockpicker/dist/bootstrap-clockpicker.min.css',
                                'vendor/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js',
                                'vendor/chosen_v1.4.0/chosen.jquery.min.js',
                                'vendor/jquery.tagsinput/src/jquery.tagsinput.js',
                                'vendor/checkbo/src/0.1.4/js/checkBo.min.js',
                                'vendor/intl-tel-input//build/js/intlTelInput.min.js',
                                'vendor/moment/min/moment.min.js',
                                'vendor/bootstrap-daterangepicker/daterangepicker.js',
                                'vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                                'vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                'vendor/clockpicker/dist/jquery-clockpicker.min.js',
                                'vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/form.js');
              });
                    }]
          },
          data: {
            title: 'Advanced Form Plugins',
          }
        })
        .state('app.forms.validation', {
          url: '/validation',
          templateUrl: 'views/form-validation.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('vendor/jquery-validation/dist/jquery.validate.min.js').then(function () {
                return $ocLazyLoad.load('scripts/controllers/validation.js');
              });
                    }]
          },
          data: {
            title: 'Form Validation',
          }
        })
        .state('app.forms.wizard', {
          url: '/wizard',
          templateUrl: 'views/form-wizard.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/checkbo/src/0.1.4/css/checkBo.min.css',
                                'vendor/chosen_v1.4.0/chosen.min.css'
                            ]
                        },
                {
                  files: [
                                'vendor/checkbo/src/0.1.4/js/checkBo.min.js',
                                'vendor/chosen_v1.4.0/chosen.jquery.min.js',
                                'vendor/card/lib/js/jquery.card.js',
                                'vendor/bootstrap/js/tab.js',
                                'vendor/jquery-validation/dist/jquery.validate.min.js',
                                'vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/wizard.js');
              });
                    }]
          },
          data: {
            title: 'Form Wizards',
          }
        })
        .state('app.forms.editors', {
          url: '/editors',
          templateUrl: 'views/form-editors.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/summernote/dist/summernote.css',
                                'vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css'
                            ]
                        },
                {
                  files: [
                                'vendor/bootstrap/js/tooltip.js',
                                'vendor/bootstrap/js/dropdown.js',
                                'vendor/bootstrap/js/modal.js',
                                'vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js',
                                'vendor/summernote/dist/summernote.min.js'
                            ]
                        },
                {
                  name: 'summernote',
                  files: [
                                'vendor/angular-summernote/dist/angular-summernote.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/editor.js');
              });
                    }]
          },
          data: {
            title: 'Form Editors',
          }
        })
        .state('app.forms.masks', {
          url: '/masks',
          templateUrl: 'views/form-masks.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('vendor/jquery.maskedinput/dist/jquery.maskedinput.min.js').then(function () {
                return $ocLazyLoad.load('scripts/controllers/mask.js');
              });
                    }]
          },
          data: {
            title: 'Input Masks',
          }
        })
        .state('app.forms.upload', {
          url: '/upload',
          templateUrl: 'views/form-upload.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'angularFileUpload',
                  files: [
                                'vendor/angular-file-upload/angular-file-upload.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/upload.js');
              });
                    }]
          },
          data: {
            title: 'Form Upload',
          }
        })


      // Tables routes
      .state('app.tables', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/tables',
        })
        .state('app.tables.table_basic', {
          url: '/table_basic',
          templateUrl: 'views/table-basic.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/sortable/css/sortable-theme-bootstrap.css'
                            ]
                        },
                {
                  files: [
                                'vendor/sortable/js/sortable.min.js'
                            ]
                        }]).then(function () {
                Sortable.init();
              });
                    }]
          },
          data: {
            title: 'Basic Table',
          }
        })
        .state('app.tables.table_responsive', {
          url: '/table_responsive',
          templateUrl: 'views/table-responsive.html',
          data: {
            title: 'Responsive Table',
          }
        })
        .state('app.tables.datatable', {
          url: '/datatable',
          templateUrl: 'views/table-datatable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/chosen_v1.4.0/chosen.min.css',
                                'vendor/datatables/media/css/jquery.dataTables.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/chosen_v1.4.0/chosen.jquery.min.js',
                                'vendor/datatables/media/js/jquery.dataTables.js',
                                'scripts/extentions/bootstrap-datatables.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/table.js');
              });
                    }]
          },
          data: {
            title: 'Datatable',
          }
        })
        .state('app.tables.table_editable', {
          url: '/table_editable',
          templateUrl: 'views/table-editable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/angular-xeditable/dist/css/xeditable.css'
                            ]
                        },
                {
                  name: 'xeditable',
                  files: [
                                'vendor/angular-xeditable/dist/js/xeditable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/editable.js');
              });
                    }]
          },
          data: {
            title: 'Editable Table',
          }
        })


      // Chart routes
      .state('app.charts', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/charts',
        })
        .state('app.charts.flot', {
          url: '/flot',
          templateUrl: 'views/charts-flot.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                'vendor/flot/jquery.flot.js',
                                'vendor/flot/jquery.flot.resize.js',
                                'vendor/flot/jquery.flot.categories.js',
                                'vendor/flot/jquery.flot.stack.js',
                                'vendor/flot/jquery.flot.time.js',
                                'vendor/flot/jquery.flot.pie.js',
                                'vendor/flot-spline/js/jquery.flot.spline.js',
                                'vendor/flot.orderbars/js/jquery.flot.orderBars.js'
                            ]
                        },
                {
                  name: 'angular-flot',
                  files: [
                                'vendor/angular-flot/angular-flot.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/flot.js');
              });
                    }]
          },
          data: {
            title: 'Flot Charts',
          }
        })
        .state('app.charts.easypie', {
          url: '/easypie',
          templateUrl: 'views/charts-easypie.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'easypiechart',
                  files: [
                                'vendor/jquery.easy-pie-chart/dist/angular.easypiechart.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/easychart.js');
              });
                    }]
          },
          data: {
            title: 'Easypie Charts',
          }
        })
        .state('app.charts.chartjs', {
          url: '/chartjs',
          templateUrl: 'views/charts-chartjs.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                 {
                  files: [
                                'vendor/chartjs/Chart.js',
                            ]
                        },
                {
                  name: 'angles',
                  serie: true,
                  files: [
                                'vendor/angles/angles.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/chartjs.js');
              });
                    }]
          },
          data: {
            title: 'Chartjs',
          }
        })
        .state('app.charts.rickshaw', {
          url: '/rickshaw',
          templateUrl: 'views/charts-rickshaw.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/rickshaw/rickshaw.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/d3/d3.min.js',
                                'vendor/rickshaw/rickshaw.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/rickshaw.js');
              });
                    }]
          },
          data: {
            title: 'Rickshaw Charts',
          }
        })
        .state('app.charts.nvd3', {
          url: '/nvd3',
          templateUrl: 'views/charts-nvd3.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/nvd3/nv.d3.min.css'
                            ]
                        },
                {
                  name: 'nvd3',
                  serie: true,
                  files: [
                                'vendor/d3/d3.min.js',
                                'vendor/nvd3/nv.d3.min.js',
                                'vendor/angular-nvd3/dist/angular-nvd3.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/nvd3.js');
              });
                    }]
          },
          data: {
            title: 'Nvd3 Charts',
          }
        })
        .state('app.charts.c3', {
          url: '/c3',
          templateUrl: 'views/charts-c3.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/c3/c3.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/d3/d3.min.js',
                                'vendor/c3/c3.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/c3.js');
              });
                    }]
          },
          data: {
            title: 'C3',
          }
        })


      // Maps routes
      .state('app.maps', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/maps',
        })
        .state('app.maps.google', {
          url: '/google',
          templateUrl: 'views/map-google.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'ui.map',
                  files: [
                                'vendor/angular-ui-map/ui-map.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/google.js');
              });
                    }]
          },
          data: {
            title: 'Google Maps',
            contentClasses: 'no-padding'
          }
        })
        .state('app.maps.vector', {
          url: '/vector',
          templateUrl: 'views/map-vector.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/bower-jvectormap/jquery-jvectormap-1.2.2.min.js',
                                'data/maps/jquery-jvectormap-world-mill-en.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/vector.js');
              });
                    }]
          },
          data: {
            title: 'Vector Maps',
            contentClasses: 'no-padding'
          }
        })


      // Apps routes
      .state('app.apps', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/apps',
        })
        .state('app.apps.calendar', {
          url: '/calendar',
          templateUrl: 'views/app-calendar.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/fullcalendar/dist/fullcalendar.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/jquery.ui/ui/core.js',
                                'vendor/jquery.ui/ui/widget.js',
                                'vendor/jquery.ui/ui/mouse.js',
                                'vendor/jquery.ui/ui/draggable.js',
                                'vendor/moment/moment.js',
                                'vendor/fullcalendar/dist/fullcalendar.min.js',
                                'vendor/fullcalendar/dist/gcal.js'
                            ]
                        },
                {
                  name: 'ui.calendar',
                  files: [
                                'vendor/angular-ui-calendar/src/calendar.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/calendar.js');
              });
                    }]
          },
          data: {
            title: 'Calendar',
          }
        })
        .state('app.apps.gallery', {
          url: '/gallery',
          templateUrl: 'views/app-gallery.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  insertBefore: '#load_styles_before',
                  files: [
                                'vendor/blueimp-gallery/css/blueimp-gallery.min.css',
                                'vendor/blueimp-bootstrap-image-gallery/css/bootstrap-image-gallery.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                'vendor/blueimp-gallery/js/jquery.blueimp-gallery.min.js',
                                'vendor/blueimp-bootstrap-image-gallery/js/bootstrap-image-gallery.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/gallery.js');
              });
                    }]
          },
          data: {
            title: 'Gallery',
          }
        })
        .state('app.apps.messages', {
          url: '/messages',
          templateUrl: 'views/app-messages.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/messages.js').then(function () {
                return $ocLazyLoad.load('scripts/services/messages.js');
              });
                    }]
          },
          data: {
            title: 'Messages',
            appClasses: 'layout-small-menu',
            contentClasses: 'no-padding'
          }
        })
        .state('app.apps.social', {
          url: '/social',
          templateUrl: 'views/app-social.html',
          data: {
            title: 'Social Profile',
          }
        })


      // Apps routes
      .state('app.extras', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/extras',
        })
        .state('app.extras.popup', {
          url: '/popup',
          templateUrl: 'views/extras-popup.html',
          data: {
            title: 'Popup',
          }
        })
        .state('app.extras.invoice', {
          url: '/invoice',
          templateUrl: 'views/extras-invoice.html',
          data: {
            title: 'Invoice',
          }
        })
        .state('app.extras.timeline', {
          url: '/timeline',
          templateUrl: 'views/extras-timeline.html',
          data: {
            title: 'Timeline',
          }
        })
        .state('app.extras.sortable', {
          url: '/sortable',
          templateUrl: 'views/extras-sortable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                'vendor/jquery.ui/ui/core.js',
                                'vendor/jquery.ui/ui/widget.js',
                                'vendor/jquery.ui/ui/mouse.js',
                                'vendor/jquery.ui/ui/sortable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('scripts/controllers/sortable.js');
              });
                    }]
          },
          data: {
            title: 'Sortable',
          }
        })
        .state('app.extras.nestable', {
          url: '/nestable',
          templateUrl: 'views/extras-nestable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('vendor/nestable/jquery.nestable.js');
                    }]
          },
          data: {
            title: 'Nestable',
          }
        })
        .state('app.extras.search', {
          url: '/search',
          templateUrl: 'views/extras-search.html',
          data: {
            title: 'Search',
          }
        })
        .state('app.extras.changelog', {
          url: '/changelog',
          templateUrl: 'views/extras-changelog.html',
          data: {
            title: 'Changelog',
          }
        })
        .state('app.extras.blank', {
          url: '/blank',
          templateUrl: 'views/extras-blank.html',
          data: {
            title: 'Blank Pages',
          }
        })


      .state('app.widgets', {
        url: '/widgets',
        templateUrl: 'views/widgets.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                insertBefore: '#load_styles_before',
                files: [
                                'styles/climacons-font.css',
                                'vendor/checkbo/src/0.1.4/css/checkBo.min.css'
                            ]
                        },
              {
                files: [
                                'vendor/checkbo/src/0.1.4/js/checkBo.min.js'
                            ]
                        }]);
                    }]
        },
        data: {
          title: 'Widgets',
        }
      })


      .state('user', {
          templateUrl: 'views/common/session.html',
        })
        .state('user.signin', {
          url: '/signin',
          templateUrl: 'views/extras-signin.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.signup', {
          url: '/signup',
          templateUrl: 'views/extras-signup.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.forgot', {
          url: '/forgot',
          templateUrl: 'views/extras-forgot.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })

      .state('app.404', {
          url: '/404',
          templateUrl: 'views/extras-404.html',
          data: {
            title: 'Page Not Found',
            contentClasses: 'no-padding',
          }
        })
        .state('user.500', {
          url: '/500',
          templateUrl: 'views/extras-500.html',
          data: {
            appClasses: 'usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.lockscreen', {
          url: '/lockscreen',
          templateUrl: 'views/extras-lockscreen.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'usersession',
            contentClasses: 'full-height'
          }
        })


      .state('app.documentation', {
        url: '/documentation',
        templateUrl: 'views/docs.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                serie: true,
                files: [
                                'vendor/prism/themes/prism.css',
                                'vendor/prism/prism.js',
                            ]
                        }]);
                    }]
        },
        data: {
          title: 'Documentation',
          contentClasses: 'no-padding'
        }
      });
        }
    ])
  .config(['$ocLazyLoadProvider', function ($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
      debug: false,
      events: false
    });
    }]);


/**
 * Config for the app router
 */
app.config(['$stateProvider',
function ($stateProvider) {

    $stateProvider.state('auth', {
        url: '/auth',
        template: '<div ui-view class="fade-in-right-big smooth"></div>',
        title: 'sidebar.nav.auth.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.auth.MAIN'
        }
    }).state('auth.login', {
        url: '/login',
        templateUrl: '/bundles/publipr/js/components/Auth/login.html',
        title: 'content.list.LOGIN',
        ncyBreadcrumb: {
            label: 'content.list.LOGIN'
        },
        resolve: loadSequence('LoginCtrl', 'LoginService')
    }).state('auth.register', {
        url: '/register',
        templateUrl: '/bundles/publipr/js/components/Auth/register.html',
        title: 'content.list.REGISTER',
        ncyBreadcrumb: {
            label: 'content.list.REGISTER'
        },
        resolve: loadSequence('RegisterCtrl', 'RegisterService')
    }).state('auth.resetpassword', {
        url: '/reset-password',
        templateUrl: '/bundles/publipr/js/components/Auth/reset_password.html',
        title: 'content.list.RESETPAWSSWORD',
        ncyBreadcrumb: {
            label: 'content.list.RESETPAWSSWORD'
        },
        resolve: loadSequence('ResetPasswordCtrl', 'ResetPasswordService')
    }).state('auth.emailconfirm', {
        url: '/email-confirm/:token/:language',
        templateUrl: '/bundles/publipr/js/components/Auth/email_confirm.html',
        title: 'content.list.EMAILCONFIRM',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCONFIRM'
        },
        resolve: loadSequence('EmailConfirmCtrl', 'RegisterService')
    }).state('auth.reset', {
        url: '/reset/:token/:language',
        templateUrl: '/bundles/publipr/js/components/Auth/reset.html',
        title: 'content.list.RESET',
        ncyBreadcrumb: {
            label: 'content.list.RESET'
        },
        resolve: loadSequence('ResetCtrl', 'ResetPasswordService')
    }).state('auth.lockscreen', {
        url: '/lock-screen',
        templateUrl: '/bundles/publipr/js/components/Auth/lock_screen.html',
        title: 'content.list.LOCKSCREEN',
        ncyBreadcrumb: {
            label: 'content.list.LOCKSCREEN'
        },
        resolve: loadSequence('LockScreenCtrl', 'LoginService')
    }).state('app.dashboard', {
        url: '/dashboard',
        templateUrl: '/bundles/publipr/js/components/Main/dashboard.html',
        title: 'content.list.DASHBOARD',
        ncyBreadcrumb: {
            label: 'content.list.DASHBOARD'
        },
        resolve: loadSequence('jquery-sparkline', 'DashboardCtrl', 'DashboardService')
    }).state('app.access', {
        url: '/access',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.access.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.access.MAIN'
        }
    }).state('app.access.users', {
        url: '/users',
        templateUrl: '/bundles/publipr/js/components/User/users.html',
        title: 'content.list.USERS',
        ncyBreadcrumb: {
            label: 'content.list.USERS'
        },
        resolve: loadSequence('ngTable', 'UsersCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersnew', {
        url: '/users/new',
        templateUrl: '/bundles/publipr/js/components/User/user_form.html',
        title: 'content.list.NEWUSER',
        ncyBreadcrumb: {
            label: 'content.list.NEWUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersedit', {
        url: '/users/edit/:id',
        templateUrl: '/bundles/publipr/js/components/User/user_form.html',
        title: 'content.list.EDITUSER',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersdetails', {
        url: '/users/details/:id',
        templateUrl: '/bundles/publipr/js/components/User/user.html',
        ncyBreadcrumb: {
            label: 'content.list.USERDETAILS'
        },
        resolve: loadSequence('UserCtrl', 'userService')
    }).state('app.access.settings', {
        url: '/settings',
        templateUrl: '/bundles/publipr/js/components/Setting/settings.html',
        title: 'content.list.SETTINGS',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGS'
        },
        resolve: loadSequence('ngTable', 'SettingsCtrl', 'settingService', 'userService')
    }).state('app.access.settingsnew', {
        url: '/settings/new',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.NEWSETTING',
        ncyBreadcrumb: {
            label: 'content.list.NEWSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.access.settingsedit', {
        url: '/settings/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.EDITSETTING',
        ncyBreadcrumb: {
            label: 'content.list.EDITSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.access.settingsdetails', {
        url: '/settings/details/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting.html',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGDETAILS'
        },
        resolve: loadSequence('SettingCtrl', 'settingService')
    }).state('app.access.fonts', {
        url: '/fonts',
        templateUrl: '/bundles/publipr/js/components/Font/fonts.html',
        title: 'content.list.FONTS',
        ncyBreadcrumb: {
            label: 'content.list.FONTS'
        },
        resolve: loadSequence('ngTable', 'FontsCtrl', 'fontService', 'userService')
    }).state('app.access.fontsnew', {
        url: '/fonts/new',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.NEWFONT',
        ncyBreadcrumb: {
            label: 'content.list.NEWFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.access.fontsedit', {
        url: '/fonts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.EDITFONT',
        ncyBreadcrumb: {
            label: 'content.list.EDITFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.access.fontsdetails', {
        url: '/fonts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font.html',
        ncyBreadcrumb: {
            label: 'content.list.FONTDETAILS'
        },
        resolve: loadSequence('FontCtrl', 'fontService')
    }).state('app.access.companies', {
        url: '/companies',
        templateUrl: '/bundles/publipr/js/components/Company/companies.html',
        title: 'content.list.COMPANIES',
        ncyBreadcrumb: {
            label: 'content.list.COMPANIES'
        },
        resolve: loadSequence('ngTable', 'CompaniesCtrl', 'companyService', 'userService')
    }).state('app.access.companiesnew', {
        url: '/companies/new',
        templateUrl: '/bundles/publipr/js/components/Company/company_form.html',
        title: 'content.list.NEWCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesedit', {
        url: '/companies/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company_form.html',
        title: 'content.list.EDITCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesdetails', {
        url: '/companies/details/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company.html',
        ncyBreadcrumb: {
            label: 'content.list.COMPANYDETAILS'
        },
        resolve: loadSequence('CompanyCtrl', 'companyService')
    }).state('app.contactmanager', {
        url: '/contact-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.contactmanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.contactmanager.MAIN'
        }
    }).state('app.contactmanager.contactgroups', {
        url: '/contact-groups',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_groups.html',
        title: 'content.list.CONTACTGROUPS',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTGROUPS'
        },
        resolve: loadSequence('ngTable', 'ContactGroupsCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsnew', {
        url: '/contact-groups/new',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group_form.html',
        title: 'content.list.NEWCONTACTGROUP',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTACTGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsedit', {
        url: '/contact-groups/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group_form.html',
        title: 'content.list.EDITCONTACTGROUP',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACTGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsdetails', {
        url: '/contact-groups/details/:id',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTGROUPDETAILS'
        },
        resolve: loadSequence('ContactGroupCtrl', 'contactGroupService')
    }).state('app.contactmanager.contacts', {
        url: '/contacts',
        templateUrl: '/bundles/publipr/js/components/Contact/contacts.html',
        title: 'content.list.CONTACTS',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTS'
        },
        resolve: loadSequence('ngTable', 'ContactsCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsnew', {
        url: '/contacts/new',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_form.html',
        title: 'content.list.NEWCONTACT',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTACT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsedit', {
        url: '/contacts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_form.html',
        title: 'content.list.EDITCONTACT',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsdetails', {
        url: '/contacts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTDETAILS'
        },
        resolve: loadSequence('ContactCtrl', 'contactService')
    }).state('app.templatemanager', {
        url: '/template-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.templatemanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.templatemanager.MAIN'
        }
    }).state('app.templatemanager.templates', {
        url: '/templates',
        templateUrl: '/bundles/publipr/js/components/Template/templates.html',
        title: 'content.list.TEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.TEMPLATES'
        },
        resolve: loadSequence('ngTable', 'TemplatesCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesnew', {
        url: '/templates/new',
        templateUrl: '/bundles/publipr/js/components/Template/template_form.html',
        title: 'content.list.NEWTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesedit', {
        url: '/templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Template/template_form.html',
        title: 'content.list.EDITTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesdetails', {
        url: '/templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/Template/template.html',
        ncyBreadcrumb: {
            label: 'content.list.TEMPLATEDETAILS'
        },
        resolve: loadSequence('TemplateCtrl', 'templateService')
    }).state('app.templatemanager.layouts', {
        url: '/layouts',
        templateUrl: '/bundles/publipr/js/components/Layout/layouts.html',
        title: 'content.list.LAYOUTS',
        ncyBreadcrumb: {
            label: 'content.list.LAYOUTS'
        },
        resolve: loadSequence('ngTable', 'LayoutsCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsnew', {
        url: '/layouts/new',
        templateUrl: '/bundles/publipr/js/components/Layout/layout_form.html',
        title: 'content.list.NEWLAYOUT',
        ncyBreadcrumb: {
            label: 'content.list.NEWLAYOUT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsedit', {
        url: '/layouts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout_form.html',
        title: 'content.list.EDITLAYOUT',
        ncyBreadcrumb: {
            label: 'content.list.EDITLAYOUT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsdetails', {
        url: '/layouts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout.html',
        ncyBreadcrumb: {
            label: 'content.list.LAYOUTDETAILS'
        },
        resolve: loadSequence('LayoutCtrl', 'layoutService')
    }).state('app.templatemanager.emailcampaigns', {
        url: '/email-campaigns',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaigns.html',
        title: 'content.list.EMAILCAMPAIGNS',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNS'
        },
        resolve: loadSequence('ngTable', 'EmailCampaignsCtrl', 'emailCampaignService', 'pressReleaseService', 'userService')
    }).state('app.templatemanager.emailcampaignsnew', {
        url: '/email-campaigns/new',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.NEWEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService')
    }).state('app.templatemanager.emailcampaignsedit', {
        url: '/email-campaigns/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.EDITEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService')
    }).state('app.templatemanager.emailcampaignsdetails', {
        url: '/email-campaigns/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNDETAILS'
        },
        resolve: loadSequence('EmailCampaignCtrl', 'emailCampaignService')
    }).state('app.templatemanager.contentblocks', {
        url: '/content-blocks',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_blocks.html',
        title: 'content.list.CONTENTBLOCKS',
        ncyBreadcrumb: {
            label: 'content.list.CONTENTBLOCKS'
        },
        resolve: loadSequence('ngTable', 'ContentBlocksCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksnew', {
        url: '/content-blocks/new',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block_form.html',
        title: 'content.list.NEWCONTENTBLOCK',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTENTBLOCK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksedit', {
        url: '/content-blocks/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block_form.html',
        title: 'content.list.EDITCONTENTBLOCK',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTENTBLOCK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksdetails', {
        url: '/content-blocks/details/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTENTBLOCKDETAILS'
        },
        resolve: loadSequence('ContentBlockCtrl', 'contentBlockService')
    }).state('app.settings', {
        url: '/settings',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.settings.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.settings.MAIN'
        }
    }).state('app.settings.newsrooms', {
        url: '/newsrooms',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsrooms.html',
        title: 'content.list.NEWSROOMS',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMS'
        },
        resolve: loadSequence('ngTable', 'NewsroomsCtrl', 'newsroomService', 'userService')
    }).state('app.settings.newsroomsnew', {
        url: '/newsrooms/new',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.NEWNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'userService')
    }).state('app.settings.newsroomsedit', {
        url: '/newsrooms/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.EDITNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'userService')
    }).state('app.settings.newsroomsdetails', {
        url: '/newsrooms/details/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMDETAILS'
        },
        resolve: loadSequence('NewsroomCtrl', 'newsroomService')
    }).state('app.settings.languages', {
        url: '/languages',
        templateUrl: '/bundles/publipr/js/components/Language/languages.html',
        title: 'content.list.LANGUAGES',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGES'
        },
        resolve: loadSequence('ngTable', 'LanguagesCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesnew', {
        url: '/languages/new',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.NEWLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesedit', {
        url: '/languages/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.EDITLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesdetails', {
        url: '/languages/details/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language.html',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGEDETAILS'
        },
        resolve: loadSequence('LanguageCtrl', 'languageService')
    }).state('app.settings.emailtemplates', {
        url: '/email-templates',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_templates.html',
        title: 'content.list.EMAILTEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATES'
        },
        resolve: loadSequence('ngTable', 'EmailTemplatesCtrl', 'emailTemplateService', 'userService')
    }).state('app.settings.emailtemplatesnew', {
        url: '/email-templates/new',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.NEWEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.settings.emailtemplatesedit', {
        url: '/email-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.EDITEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.settings.emailtemplatesdetails', {
        url: '/email-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATEDETAILS'
        },
        resolve: loadSequence('EmailTemplateCtrl', 'emailTemplateService')
    }).state('app.settings.newsroomtemplates', {
        url: '/newsroom-templates',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_templates.html',
        title: 'content.list.NEWSROOMTEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMTEMPLATES'
        },
        resolve: loadSequence('ngTable', 'NewsroomTemplatesCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesnew', {
        url: '/newsroom-templates/new',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template_form.html',
        title: 'content.list.NEWNEWSROOMTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOMTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesedit', {
        url: '/newsroom-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template_form.html',
        title: 'content.list.EDITNEWSROOMTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOMTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesdetails', {
        url: '/newsroom-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMTEMPLATEDETAILS'
        },
        resolve: loadSequence('NewsroomTemplateCtrl', 'newsroomTemplateService')
    }).state('app.settings.countries', {
        url: '/countries',
        templateUrl: '/bundles/publipr/js/components/Country/countries.html',
        title: 'content.list.COUNTRIES',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRIES'
        },
        resolve: loadSequence('ngTable', 'CountriesCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesnew', {
        url: '/countries/new',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.NEWCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesedit', {
        url: '/countries/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.EDITCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesdetails', {
        url: '/countries/details/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country.html',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRYDETAILS'
        },
        resolve: loadSequence('CountryCtrl', 'countryService')
    }).state('app.distribution', {
        url: '/distribution',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.distribution.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.distribution.MAIN'
        }
    }).state('app.distribution.emails', {
        url: '/emails',
        templateUrl: '/bundles/publipr/js/components/Email/emails.html',
        title: 'content.list.EMAILS',
        ncyBreadcrumb: {
            label: 'content.list.EMAILS'
        },
        resolve: loadSequence('ngTable', 'EmailsCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsnew', {
        url: '/emails/new',
        templateUrl: '/bundles/publipr/js/components/Email/email_form.html',
        title: 'content.list.NEWEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsedit', {
        url: '/emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email_form.html',
        title: 'content.list.EDITEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsdetails', {
        url: '/emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILDETAILS'
        },
        resolve: loadSequence('EmailCtrl', 'emailService')
    }).state('app.accesscontrol', {
        url: '/access-control',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.accesscontrol.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.accesscontrol.MAIN'
        }
    }).state('app.accesscontrol.sessions', {
        url: '/sessions',
        templateUrl: '/bundles/publipr/js/components/Session/sessions.html',
        title: 'content.list.SESSIONS',
        ncyBreadcrumb: {
            label: 'content.list.SESSIONS'
        },
        resolve: loadSequence('ngTable', 'SessionsCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsnew', {
        url: '/sessions/new',
        templateUrl: '/bundles/publipr/js/components/Session/session_form.html',
        title: 'content.list.NEWSESSION',
        ncyBreadcrumb: {
            label: 'content.list.NEWSESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsedit', {
        url: '/sessions/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session_form.html',
        title: 'content.list.EDITSESSION',
        ncyBreadcrumb: {
            label: 'content.list.EDITSESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsdetails', {
        url: '/sessions/details/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session.html',
        ncyBreadcrumb: {
            label: 'content.list.SESSIONDETAILS'
        },
        resolve: loadSequence('SessionCtrl', 'sessionService')
    }).state('app.accesscontrol.logs', {
        url: '/logs',
        templateUrl: '/bundles/publipr/js/components/Log/logs.html',
        title: 'content.list.LOGS',
        ncyBreadcrumb: {
            label: 'content.list.LOGS'
        },
        resolve: loadSequence('ngTable', 'LogsCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.accesscontrol.logsnew', {
        url: '/logs/new',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.NEWLOG',
        ncyBreadcrumb: {
            label: 'content.list.NEWLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.accesscontrol.logsedit', {
        url: '/logs/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.EDITLOG',
        ncyBreadcrumb: {
            label: 'content.list.EDITLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.accesscontrol.logsdetails', {
        url: '/logs/details/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log.html',
        ncyBreadcrumb: {
            label: 'content.list.LOGDETAILS'
        },
        resolve: loadSequence('LogCtrl', 'logService')
    }).state('app.nogroup', {
        url: '/no-group',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.nogroup.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.nogroup.MAIN'
        }
    }).state('app.nogroup.newsroomsusers', {
        url: '/newsrooms-users',
        templateUrl: '/bundles/publipr/js/components/NewsroomsUsers/newsrooms_users.html',
        title: 'content.list.NEWSROOMSUSERSS',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMSUSERSS'
        },
        resolve: loadSequence('ngTable', 'NewsroomsUsersCtrl', 'newsroomsUsersService', 'userService')
    }).state('app.nogroup.newsroomsusersnew', {
        url: '/newsrooms-users/new',
        templateUrl: '/bundles/publipr/js/components/NewsroomsUsers/newsrooms_users_form.html',
        title: 'content.list.NEWNEWSROOMSUSERS',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOMSUSERS'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomsUsersFormCtrl', 'newsroomsUsersService', 'userService')
    }).state('app.nogroup.newsroomsusersedit', {
        url: '/newsrooms-users/edit/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomsUsers/newsrooms_users_form.html',
        title: 'content.list.EDITNEWSROOMSUSERS',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOMSUSERS'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomsUsersFormCtrl', 'newsroomsUsersService', 'userService')
    }).state('app.nogroup.newsroomsusersdetails', {
        url: '/newsrooms-users/details/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomsUsers/newsrooms_users.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMSUSERSDETAILS'
        },
        resolve: loadSequence('NewsroomsUsersCtrl', 'newsroomsUsersService')
    }).state('app.billing', {
        url: '/billing',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.billing.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.billing.MAIN'
        }
    }).state('app.billing.payments', {
        url: '/payments',
        templateUrl: '/bundles/publipr/js/components/Payment/payments.html',
        title: 'content.list.PAYMENTS',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTS'
        },
        resolve: loadSequence('ngTable', 'PaymentsCtrl', 'paymentService', 'userService')
    }).state('app.billing.paymentsnew', {
        url: '/payments/new',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.NEWPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'userService')
    }).state('app.billing.paymentsedit', {
        url: '/payments/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.EDITPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'userService')
    }).state('app.billing.paymentsdetails', {
        url: '/payments/details/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment.html',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTDETAILS'
        },
        resolve: loadSequence('PaymentCtrl', 'paymentService')
    }).state('app.pressreleasemanager', {
        url: '/press-release-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.pressreleasemanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.pressreleasemanager.MAIN'
        }
    }).state('app.pressreleasemanager.pressreleases', {
        url: '/press-releases',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_releases.html',
        title: 'content.list.PRESSRELEASES',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASES'
        },
        resolve: loadSequence('ngTable', 'PressReleasesCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.pressreleasemanager.pressreleasesnew', {
        url: '/press-releases/new',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.NEWPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.pressreleasemanager.pressreleasesedit', {
        url: '/press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.EDITPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.pressreleasemanager.pressreleasesdetails', {
        url: '/press-releases/details/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASEDETAILS'
        },
        resolve: loadSequence('PressReleaseCtrl', 'pressReleaseService')
    }).state('app.statistics', {
        url: '/statistics',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.statistics.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.statistics.MAIN'
        }
    }).state('app.statistics.trackpressreleases', {
        url: '/track-press-releases',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_releases.html',
        title: 'content.list.TRACKPRESSRELEASES',
        ncyBreadcrumb: {
            label: 'content.list.TRACKPRESSRELEASES'
        },
        resolve: loadSequence('ngTable', 'TrackPressReleasesCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesnew', {
        url: '/track-press-releases/new',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release_form.html',
        title: 'content.list.NEWTRACKPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.NEWTRACKPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesedit', {
        url: '/track-press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release_form.html',
        title: 'content.list.EDITTRACKPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesdetails', {
        url: '/track-press-releases/details/:id',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release.html',
        ncyBreadcrumb: {
            label: 'content.list.TRACKPRESSRELEASEDETAILS'
        },
        resolve: loadSequence('TrackPressReleaseCtrl', 'trackPressReleaseService')
    }).state('app.statistics.trackemails', {
        url: '/track-emails',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_emails.html',
        title: 'content.list.TRACKEMAILS',
        ncyBreadcrumb: {
            label: 'content.list.TRACKEMAILS'
        },
        resolve: loadSequence('ngTable', 'TrackEmailsCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsnew', {
        url: '/track-emails/new',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email_form.html',
        title: 'content.list.NEWTRACKEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.NEWTRACKEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsedit', {
        url: '/track-emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email_form.html',
        title: 'content.list.EDITTRACKEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'ui.mask', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsdetails', {
        url: '/track-emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email.html',
        ncyBreadcrumb: {
            label: 'content.list.TRACKEMAILDETAILS'
        },
        resolve: loadSequence('TrackEmailCtrl', 'trackEmailService')
    });

}]);
