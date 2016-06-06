'use strict';

/**
 * @ngdoc overview
 * @name publiPrApp
 * @description
 * # publiPrApp
 *
 * Main module of the application.
 */
var app = angular
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
    'colorpicker.module',
    'cfp.loadingBar',
    'ncy-angular-breadcrumb',
    'duScroll',
    'pascalprecht.translate',
    'angular-bind-html-compile',
    'slugifier',
    'vcRecaptcha',
    'toaster',
      'highcharts-ng'
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
.module('publiPrApp')
.controller('AppCtrl', ['$scope', '$rootScope', '$http', '$localStorage', '$state', '$timeout',
    function AppCtrl($scope, $rootScope, $http, $localStorage, $state, $timeout) {

        $scope.anonymousStates = ['auth.login', 'auth.register', 'auth.resetpassword', 'auth.reset', 'auth.lockscreen', 'auth.emailconfirm'];

        $timeout(function() {
            if ($scope.anonymousStates.indexOf($state.current.name) == -1 && !angular.isDefined($localStorage.access_token)) {
                $timeout(function() {
                    console.warn('no access token > redirection');
                    $state.go('auth.login');
                });
            }
        }, 2000);

        $scope.mobileView = 767;

        $scope.app = {
            name: 'PUBLI PR',
            author: 'Continuous Net',
            version: '1.0.0',
            year: (new Date()).getFullYear(),
            reCaptchaKey: '6LdZbxwTAAAAAPMYxr2yVuTCSd3ceQxV9HfkOB8b',
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

        if (angular.isDefined($localStorage.user)) {
            $rootScope.user = $rootScope.currentUser = $localStorage.user;
        } else {
            $rootScope.user = {
                name: 'Sahbi KHALFALLAH',
                job: 'Senior Web Consultant',
                picture: '/app/images/avatar.jpg',
                roles: []
            };
        }

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

'use strict';

/**
 * Config constant
 */
app.constant('APP_MEDIAQUERY', {
    'desktopXL': 1200,
    'desktop': 992,
    'tablet': 768,
    'mobile': 480
});


app.constant('JS_REQUIRES', {
    //*** Scripts
    scripts: {
        //*** Javascript Plugins
        'modernizr': ['/bower_components/components-modernizr/modernizr.js'],
        'moment': ['/bower_components/moment/min/moment.min.js'],
        'spin': '/bower_components/spin.js/spin.js',

        //*** jQuery Plugins
        'perfect-scrollbar-plugin': ['/bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js', '/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css'],
        'ladda': ['/bower_components/ladda/dist/ladda.min.js', '/bower_components/ladda/dist/ladda-themeless.min.css'],
        'sweet-alert': ['/bower_components/sweetalert/dist/sweetalert.min.js', '/bower_components/sweetalert/dist/sweetalert.css'],
        'chartjs': '/bower_components/chartjs/Chart.min.js',
        'jquery-sparkline': '/bower_components/jquery.sparkline.build/dist/jquery.sparkline.min.js',
        'ckeditor-plugin': ['/bower_components/ckeditor/ckeditor.js'],
        'jquery-nestable-plugin': ['/bower_components/jquery-nestable/jquery.nestable.js'],
        'touchspin-plugin': ['/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js', '/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],

        //*** Controllers

        //*** Filters
        'htmlToPlaintext': '/app/scripts/filters/htmlToPlaintext.js',
        FileUploader: ['/bower_components/angular-file-upload/angular-file-upload.min.js']
    },
    //*** angularJS Modules
    modules: [{
        name: 'd3',
        files: ['/bower_components/d3/d3.min.js']
    }, {
        name: 'rickshaw',
        files: ['/bower_components/rickshaw/rickshaw.min.js']
    }, {
        name: 'angularMoment',
        files: ['/bower_components/angular-moment/angular-moment.min.js']
    }, {
        name: 'flot',
        files: [
            '/bower_components/flot/jquery.flot.js',
            '/bower_components/flot/jquery.flot.resize.js',
            '/bower_components/flot/jquery.flot.pie.js',
            '/bower_components/flot/jquery.flot.categories.js',
            '/bower_components/angular-flot/angular-flot.js'
        ]
    }, {
        name: 'checkbo',
        files: ['/bower_components/checkbo/src/0.1.4/css/checkBo.min.css', '/bower_components/checkbo/src/0.1.4/js/checkBo.min.js']
    }, {
        name: 'toaster',
        files: ['/bower_components/AngularJS-Toaster/toaster.js', '/bower_components/AngularJS-Toaster/toaster.css']
    }, {
        name: 'angularBootstrapNavTree',
        files: ['/bower_components/angular-bootstrap-nav-tree/dist/abn_tree_directive.js', '/bower_components/angular-bootstrap-nav-tree/dist/abn_tree.css']
    }, {
        name: 'angular-ladda',
        files: ['/bower_components/angular-ladda/dist/angular-ladda.min.js']
    }, {
        name: 'ngTable',
        files: ['/bower_components/ng-table/dist/ng-table.min.js', '/bower_components/ng-table/dist/ng-table.min.css']
    }, {
        name: 'ui.select',
        files: ['/bower_components/angular-ui-select/dist/select.min.js', '/bower_components/angular-ui-select/dist/select.min.css', '/bower_components/select2/dist/css/select2.min.css', '/bower_components/select2-bootstrap-css/select2-bootstrap.min.css', '/bower_components/selectize/dist/css/selectize.bootstrap3.css']
    }, {
        name: 'ngImgCrop',
        files: ['/bower_components/ngImgCrop/compile/minified/ng-img-crop.js', '/bower_components/ngImgCrop/compile/minified/ng-img-crop.css']
    }, {
        name: 'angularFileUpload',
        files: ['/bower_components/angular-file-upload/angular-file-upload.min.js']
    }, {
        name: 'ngAside',
        files: ['/bower_components/angular-aside/dist/js/angular-aside.min.js', '/bower_components/angular-aside/dist/css/angular-aside.min.css']
    }, {
        name: 'truncate',
        files: ['/bower_components/angular-truncate/src/truncate.js']
    }, {
        name: 'oitozero.ngSweetAlert',
        files: ['/bower_components/angular-sweetalert-promised/SweetAlert.min.js']
    }, {
        name: 'monospaced.elastic',
        files: ['/bower_components/angular-elastic/elastic.js']
    }, {
        name: 'ngMap',
        files: ['/bower_components/ngmap/build/scripts/ng-map.min.js']
    }, {
        name: 'tc.chartjs',
        files: ['/bower_components/tc-angular-chartjs/dist/tc-angular-chartjs.min.js']
    }, {
        name: 'flow',
        files: ['/bower_components/ng-flow/dist/ng-flow-standalone.min.js']
    }, {
        name: 'uiSwitch',
        files: ['/bower_components/angular-ui-switch/angular-ui-switch.min.js', '/bower_components/angular-ui-switch/angular-ui-switch.min.css']
    }, {
        name: 'ckeditor',
        files: ['/bower_components/angular-ckeditor/angular-ckeditor.min.js']
    }, {
        name: 'mwl.calendar',
        files: ['/bower_components/angular-bootstrap-calendar/dist/js/angular-bootstrap-calendar-tpls.js', '/bower_components/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.min.css', '/assets/js/config/config-calendar.js']
    }, {
        name: 'ng-nestable',
        files: ['/bower_components/ng-nestable/src/angular-nestable.js']
    }, {
        name: 'vAccordion',
        files: ['/bower_components/v-accordion/dist/v-accordion.min.js', '/bower_components/v-accordion/dist/v-accordion.min.css']
    }, {
        name: 'xeditable',
        files: ['/bower_components/angular-xeditable/dist/js/xeditable.min.js', '/bower_components/angular-xeditable/dist/css/xeditable.css', '/assets/js/config/config-xeditable.js']
    }, {
        name: 'checklist-model',
        files: ['/bower_components/checklist-model/checklist-model.js']
    }, {
        name: 'angular-notification-icons',
        files: ['/bower_components/angular-notification-icons/dist/angular-notification-icons.min.js', '/bower_components/angular-notification-icons/dist/angular-notification-icons.min.css']
    }]
});

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
        'ChangePasswordCtrl': '/bundles/publipr/js/components/Auth/ChangePasswordCtrl.js',
        'ProfileCtrl': '/bundles/publipr/js/components/Auth/ProfileCtrl.js',
        'DashboardCtrl': '/bundles/publipr/js/components/Main/DashboardCtrl.js',
        'CompaniesCtrl': '/bundles/publipr/js/components/Company/CompaniesCtrl.js',
        'CompanyFormCtrl': '/bundles/publipr/js/components/Company/CompanyFormCtrl.js',
        'CompanyCtrl': '/bundles/publipr/js/components/Company/CompanyCtrl.js',
        'ContactsCtrl': '/bundles/publipr/js/components/Contact/ContactsCtrl.js',
        'ContactFormCtrl': '/bundles/publipr/js/components/Contact/ContactFormCtrl.js',
        'ContactCtrl': '/bundles/publipr/js/components/Contact/ContactCtrl.js',
        'ContactImportCtrl': '/bundles/publipr/js/components/Contact/ContactImportCtrl.js',
        'ContactExportCtrl': '/bundles/publipr/js/components/Contact/ContactExportCtrl.js',
        'ContactGroupsCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupsCtrl.js',
        'ContactGroupFormCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupFormCtrl.js',
        'ContactGroupCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupCtrl.js',
        'ContentBlocksCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlocksCtrl.js',
        'ContentBlockFormCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockFormCtrl.js',
        'ContentBlockCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockCtrl.js',
        'CountriesCtrl': '/bundles/publipr/js/components/Country/CountriesCtrl.js',
        'CountryFormCtrl': '/bundles/publipr/js/components/Country/CountryFormCtrl.js',
        'CountryCtrl': '/bundles/publipr/js/components/Country/CountryCtrl.js',
        'EmailsCtrl': '/bundles/publipr/js/components/Email/EmailsCtrl.js',
        'EmailFormCtrl': '/bundles/publipr/js/components/Email/EmailFormCtrl.js',
        'EmailCtrl': '/bundles/publipr/js/components/Email/EmailCtrl.js',
        'EmailCampaignsCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignsCtrl.js',
        'EmailCampaignFormCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignFormCtrl.js',
        'EmailCampaignCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignCtrl.js',
        'EmailTemplatesCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplatesCtrl.js',
        'EmailTemplateFormCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateFormCtrl.js',
        'EmailTemplateCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateCtrl.js',
        'FontsCtrl': '/bundles/publipr/js/components/Font/FontsCtrl.js',
        'FontFormCtrl': '/bundles/publipr/js/components/Font/FontFormCtrl.js',
        'FontCtrl': '/bundles/publipr/js/components/Font/FontCtrl.js',
        'LanguagesCtrl': '/bundles/publipr/js/components/Language/LanguagesCtrl.js',
        'LanguageFormCtrl': '/bundles/publipr/js/components/Language/LanguageFormCtrl.js',
        'LanguageCtrl': '/bundles/publipr/js/components/Language/LanguageCtrl.js',
        'LayoutsCtrl': '/bundles/publipr/js/components/Layout/LayoutsCtrl.js',
        'LayoutFormCtrl': '/bundles/publipr/js/components/Layout/LayoutFormCtrl.js',
        'LayoutCtrl': '/bundles/publipr/js/components/Layout/LayoutCtrl.js',
        'LogsCtrl': '/bundles/publipr/js/components/Log/LogsCtrl.js',
        'LogFormCtrl': '/bundles/publipr/js/components/Log/LogFormCtrl.js',
        'LogCtrl': '/bundles/publipr/js/components/Log/LogCtrl.js',
        'NewsroomsCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomsCtrl.js',
        'NewsroomFormCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomFormCtrl.js',
        'NewsroomCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomCtrl.js',
        'NewsroomTemplatesCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplatesCtrl.js',
        'NewsroomTemplateFormCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateFormCtrl.js',
        'NewsroomTemplateCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateCtrl.js',
        'UsersCtrl': '/bundles/publipr/js/components/User/UsersCtrl.js',
        'UserFormCtrl': '/bundles/publipr/js/components/User/UserFormCtrl.js',
        'UserCtrl': '/bundles/publipr/js/components/User/UserCtrl.js',
        'PaymentsCtrl': '/bundles/publipr/js/components/Payment/PaymentsCtrl.js',
        'PaymentFormCtrl': '/bundles/publipr/js/components/Payment/PaymentFormCtrl.js',
        'PaymentCtrl': '/bundles/publipr/js/components/Payment/PaymentCtrl.js',
        'PurchaseCtrl': '/bundles/publipr/js/components/Payment/PurchaseCtrl.js',
        'PurchaseFormCtrl': '/bundles/publipr/js/components/Payment/PurchaseFormCtrl.js',
        'InvoiceCtrl': '/bundles/publipr/js/components/Invoice/InvoiceCtrl.js',
        'PaymentPlansCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlansCtrl.js',
        'PaymentPlanFormCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlanFormCtrl.js',
        'PaymentPlanCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlanCtrl.js',
        'PressReleasesCtrl': '/bundles/publipr/js/components/PressRelease/PressReleasesCtrl.js',
        'PressReleaseFormCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseFormCtrl.js',
        'PressReleaseCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseCtrl.js',
        'PressReleaseSenderCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseSenderCtrl.js',
        'PressReleaseStatsCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseStatsCtrl.js',
        'PressReleaseEditorCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseEditorCtrl.js',
        'ProductsCtrl': '/bundles/publipr/js/components/Product/ProductsCtrl.js',
        'ProductFormCtrl': '/bundles/publipr/js/components/Product/ProductFormCtrl.js',
        'ProductCtrl': '/bundles/publipr/js/components/Product/ProductCtrl.js',
        'SessionsCtrl': '/bundles/publipr/js/components/Session/SessionsCtrl.js',
        'SessionFormCtrl': '/bundles/publipr/js/components/Session/SessionFormCtrl.js',
        'SessionCtrl': '/bundles/publipr/js/components/Session/SessionCtrl.js',
        'SettingsCtrl': '/bundles/publipr/js/components/Setting/SettingsCtrl.js',
        'SettingFormCtrl': '/bundles/publipr/js/components/Setting/SettingFormCtrl.js',
        'SettingCtrl': '/bundles/publipr/js/components/Setting/SettingCtrl.js',
        'TemplatesCtrl': '/bundles/publipr/js/components/Template/TemplatesCtrl.js',
        'TemplateFormCtrl': '/bundles/publipr/js/components/Template/TemplateFormCtrl.js',
        'TemplateCtrl': '/bundles/publipr/js/components/Template/TemplateCtrl.js',
        'TrackEmailsCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailsCtrl.js',
        'TrackEmailFormCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailFormCtrl.js',
        'TrackEmailCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailCtrl.js',
        'TrackPressReleasesCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleasesCtrl.js',
        'TrackPressReleaseFormCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseFormCtrl.js',
        'TrackPressReleaseCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseCtrl.js',
        'UserPaymentPlansCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlansCtrl.js',
        'UserPaymentPlanFormCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanFormCtrl.js',
        'UserPaymentPlanCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanCtrl.js'
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
        name: 'ProfileService',
        files: ['/bundles/publipr/js/components/Auth/ProfileService.js']
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
        name: 'ContactImportService',
        files: ['/bundles/publipr/js/components/Contact/ContactImportService.js']
    },{
        name: 'ContactExportService',
        files: ['/bundles/publipr/js/components/Contact/ContactExportService.js']
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
        name: 'userService',
        files: ['/bundles/publipr/js/components/User/UserService.js']
    },{
        name: 'paymentService',
        files: ['/bundles/publipr/js/components/Payment/PaymentService.js']
    },{
        name: 'PurchaseService',
        files: ['/bundles/publipr/js/components/Payment/PurchaseService.js']
    },{
        name: 'InvoiceService',
        files: ['/bundles/publipr/js/components/Invoice/InvoiceService.js']
    },{
        name: 'InvoiceDownloadService',
        files: ['/bundles/publipr/js/components/Invoice/InvoiceDownloadService.js']
    },{
        name: 'paymentPlanService',
        files: ['/bundles/publipr/js/components/PaymentPlan/PaymentPlanService.js']
    },{
        name: 'pressReleaseService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseService.js']
    },{
        name: 'PressReleaseEditorService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseEditorService.js']
    },{
        name: 'PressReleaseEmailStatsService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseEmailStatsService.js']
    },{
        name: 'PressReleaseSenderService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseSenderService.js']
    },{
        name: 'PressReleaseStatsService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseStatsService.js']
    },{
        name: 'productService',
        files: ['/bundles/publipr/js/components/Product/ProductService.js']
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
        name: 'userPaymentPlanService',
        files: ['/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanService.js']
    }]
});

'use strict';

angular
  .module('publiPrApp')
  .run(['$rootScope', '$state', '$stateParams', '$localStorage',
    function ($rootScope, $state, $stateParams, $localStorage) {

            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;

            // GLOBAL APP SCOPE
            // set below basic information
            $rootScope.app = {
                name: 'PUBLI PR', // name of your project
                author: 'Continuous Net', // author's name or company name
                description: 'Press Release ', // brief description
                version: '1.0.0', // current version
                reCaptchaKey: '6LdZbxwTAAAAAPMYxr2yVuTCSd3ceQxV9HfkOB8b',
                year: ((new Date()).getFullYear()), // automatic current year (for copyright information)
                isMobile: (function () {// true if the browser is a mobile device
                    var check = false;
                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                        check = true;
                    };
                    return check;
                })(),
                apiURL: '/api/', // rest api url
                apiVersion: 'v1/', // rest version url
                thumbURL: '/thumb?image=' // rest version url
            };

            if (angular.isDefined($localStorage.user)) {
                $rootScope.user = $localStorage.user;
            } else {
                $rootScope.user = {
                    name: 'Sahbi KHALFALLAH',
                    job: 'Senior Web Consultant',
                    picture: '/app/images/avatar.jpg',
                    roles: []
                };
            }

            $rootScope.$on('$stateChangeSuccess', function () {
                window.scrollTo(0, 0);
            });

            FastClick.attach(document.body);

        },
    ])
  .config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {

      // For unmatched routes
      $urlRouterProvider.otherwise('/auth/login');

      // Application routes
      $stateProvider.state('app', {
        url: '/app',
        templateUrl: '/app/views/common/layout.html',
        resolve: loadSequence('modernizr', 'moment', 'angularMoment', 'uiSwitch', 'perfect-scrollbar-plugin', 'toaster', 'ngAside', 'vAccordion', 'chartjs', 'tc.chartjs', 'sweet-alert', 'oitozero.ngSweetAlert', 'truncate', 'htmlToPlaintext', 'angular-notification-icons', 'checkbo', 'd3', 'rickshaw', 'flot'),
        abstract: true
      })

      /*
      .state('app.dashboard', {
        url: '/',
        templateUrl: '/app/views/dashboard.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                insertBefore: '#load_styles_before',
                files: [
                                'styles/climacons-font.css',
                                '/bower_components/rickshaw/rickshaw.min.css'
                            ]
                        },
              {
                serie: true,
                files: [
                                '/bower_components/d3/d3.min.js',
                                '/bower_components/rickshaw/rickshaw.min.js',
                                '/bower_components/flot/jquery.flot.js',
                                '/bower_components/flot/jquery.flot.resize.js',
                                '/bower_components/flot/jquery.flot.pie.js',
                                '/bower_components/flot/jquery.flot.categories.js',
                            ]
                        },
              {
                  name: 'angular-flot',
                  files: [
                                '/bower_components/angular-flot/angular-flot.js'
                            ]
                        }]).then(function () {
              return $ocLazyLoad.load('/app/scripts/controllers/dashboard.js');
            });
                    }]
        },
        data: {
          title: 'Dashboard',
        }
      })
      */

      // UI Routes
      .state('app.ui', {
          template: '<div ui-view></div>',
          abstract: true,
          url: '/ui',
        })
        .state('app.ui.buttons', {
          url: '/buttons',
          templateUrl: '/app/views/ui-buttons.html',
          data: {
            title: 'Buttons',
          }
        })
        .state('app.ui.directives', {
          url: '/directives',
          templateUrl: '/app/views/ui-general.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/checkbo/src/0.1.4/css/checkBo.min.css',
                                '/bower_components/chosen_v1.4.0/chosen.min.css'
                            ]
                        },
                {
                  files: [
                                '/bower_components/checkbo/src/0.1.4/js/checkBo.min.js',
                                '/bower_components/chosen_v1.4.0/chosen.jquery.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/bootstrap.ui.js');
              });
                    }]
          },
          data: {
            title: 'Bootstrap Directives',
          }
        })
        .state('app.ui.tabs_accordion', {
          url: '/tabs_accordions',
          templateUrl: '/app/views/ui-tabs-accordion.html',
          data: {
            title: 'Nav Tabs',
          }
        })
        .state('app.ui.portlets', {
          url: '/portlets',
          templateUrl: '/app/views/ui-portlets.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                '/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.js',
                                '/bower_components/jquery.ui/ui/core.js',
                                '/bower_components/jquery.ui/ui/widget.js',
                                '/bower_components/jquery.ui/ui/mouse.js',
                                '/bower_components/jquery.ui/ui/sortable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/draggable.js');
              });
                    }]
          },
          data: {
            title: 'Portlets',
          }
        })
        .state('app.ui.fontawesome', {
          url: '/fontawesome',
          templateUrl: '/app/views/ui-fontawesome.html',
          data: {
            title: 'Fontawesome Icons',
          }
        })
        .state('app.ui.feather', {
          url: '/feather',
          templateUrl: '/app/views/ui-feather.html',
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
          templateUrl: '/app/views/ui-climacon.html',
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
          templateUrl: '/app/views/ui-progressbars.html',
          data: {
            title: 'Progress Bars',
          }
        })
        .state('app.ui.sliders', {
          url: '/sliders',
          templateUrl: '/app/views/ui-sliders.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                '/bower_components/jquery.ui/ui/core.js',
                                '/bower_components/jquery.ui/ui/widget.js',
                                '/bower_components/jquery.ui/ui/mouse.js',
                                '/bower_components/jquery.ui/ui/slider.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/slider.js');
              });
                    }]
          },
          data: {
            title: 'Sliders',
          }
        })
        .state('app.ui.pagination', {
          url: '/pagination',
          templateUrl: '/app/views/ui-pagination.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/bootstrap.ui.js');
                    }]
          },
          data: {
            title: 'Pagination',
          }
        })
        .state('app.ui.notifications', {
          url: '/notifications',
          templateUrl: '/app/views/ui-notifications.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: ['/bower_components/chosen_v1.4.0/chosen.min.css']
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/chosen_v1.4.0/chosen.jquery.min.js',
                                '/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
                                '/app/scripts/extentions/noty-defaults.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/notifications.js');
              });
                    }]
          },
          data: {
            title: 'Notifications',
          }
        })
        .state('app.ui.alert', {
          url: '/alert',
          templateUrl: '/app/views/ui-alert.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: ['/bower_components/sweetalert/dist/sweetalert.css']
                        },
                {
                  name: 'oitozero.ngSweetAlert',
                  files: [
                                '/bower_components/sweetalert/dist/sweetalert.min.js',
                                '/bower_components/angular-sweetalert/SweetAlert.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/alert.js');
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
          templateUrl: '/app/views/form-basic.html',
          data: {
            title: 'Native Form Elements',
          }
        })
        .state('app.forms.advanced_forms', {
          url: '/advanced_forms',
          templateUrl: '/app/views/form-advanced.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css',
                                '/bower_components/chosen_v1.4.0/chosen.min.css',
                                '/bower_components/jquery.tagsinput/src/jquery.tagsinput.css',
                                '/bower_components/checkbo/src/0.1.4/css/checkBo.min.css',
                                '/bower_components/intl-tel-input/build/css/intlTelInput.css',
                                '/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css',
                                '/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
                                '/bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                                '/bower_components/clockpicker/dist/bootstrap-clockpicker.min.css',
                                '/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js',
                                '/bower_components/chosen_v1.4.0/chosen.jquery.min.js',
                                '/bower_components/jquery.tagsinput/src/jquery.tagsinput.js',
                                '/bower_components/checkbo/src/0.1.4/js/checkBo.min.js',
                                '/bower_components/intl-tel-input//build/js/intlTelInput.min.js',
                                '/bower_components/moment/min/moment.min.js',
                                '/bower_components/bootstrap-daterangepicker/daterangepicker.js',
                                '/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                                '/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                                '/bower_components/clockpicker/dist/jquery-clockpicker.min.js',
                                '/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/form.js');
              });
                    }]
          },
          data: {
            title: 'Advanced Form Plugins',
          }
        })
        .state('app.forms.validation', {
          url: '/validation',
          templateUrl: '/app/views/form-validation.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/bower_components/jquery-validation/dist/jquery.validate.min.js').then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/validation.js');
              });
                    }]
          },
          data: {
            title: 'Form Validation',
          }
        })
        .state('app.forms.wizard', {
          url: '/wizard',
          templateUrl: '/app/views/form-wizard.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/checkbo/src/0.1.4/css/checkBo.min.css',
                                '/bower_components/chosen_v1.4.0/chosen.min.css'
                            ]
                        },
                {
                  files: [
                                '/bower_components/checkbo/src/0.1.4/js/checkBo.min.js',
                                '/bower_components/chosen_v1.4.0/chosen.jquery.min.js',
                                '/bower_components/card/lib/js/jquery.card.js',
                                '/bower_components/bootstrap/js/tab.js',
                                '/bower_components/jquery-validation/dist/jquery.validate.min.js',
                                '/bower_components/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/wizard.js');
              });
                    }]
          },
          data: {
            title: 'Form Wizards',
          }
        })
        .state('app.forms.editors', {
          url: '/editors',
          templateUrl: '/app/views/form-editors.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/summernote/dist/summernote.css',
                                '/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css'
                            ]
                        },
                {
                  files: [
                                '/bower_components/bootstrap/js/tooltip.js',
                                '/bower_components/bootstrap/js/dropdown.js',
                                '/bower_components/bootstrap/js/modal.js',
                                '/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js',
                                '/bower_components/summernote/dist/summernote.min.js'
                            ]
                        },
                {
                  name: 'summernote',
                  files: [
                                '/bower_components/angular-summernote/dist/angular-summernote.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/editor.js');
              });
                    }]
          },
          data: {
            title: 'Form Editors',
          }
        })
        .state('app.forms.masks', {
          url: '/masks',
          templateUrl: '/app/views/form-masks.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js').then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/mask.js');
              });
                    }]
          },
          data: {
            title: 'Input Masks',
          }
        })
        .state('app.forms.upload', {
          url: '/upload',
          templateUrl: '/app/views/form-upload.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'angularFileUpload',
                  files: [
                                '/bower_components/angular-file-upload/angular-file-upload.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/upload.js');
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
          templateUrl: '/app/views/table-basic.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/sortable/css/sortable-theme-bootstrap.css'
                            ]
                        },
                {
                  files: [
                                '/bower_components/sortable/js/sortable.min.js'
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
          templateUrl: '/app/views/table-responsive.html',
          data: {
            title: 'Responsive Table',
          }
        })
        .state('app.tables.datatable', {
          url: '/datatable',
          templateUrl: '/app/views/table-datatable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/chosen_v1.4.0/chosen.min.css',
                                '/bower_components/datatables/media/css/jquery.dataTables.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/chosen_v1.4.0/chosen.jquery.min.js',
                                '/bower_components/datatables/media/js/jquery.dataTables.js',
                                '/app/scripts/extentions/bootstrap-datatables.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/table.js');
              });
                    }]
          },
          data: {
            title: 'Datatable',
          }
        })
        .state('app.tables.table_editable', {
          url: '/table_editable',
          templateUrl: '/app/views/table-editable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/angular-xeditable/dist/css/xeditable.css'
                            ]
                        },
                {
                  name: 'xeditable',
                  files: [
                                '/bower_components/angular-xeditable/dist/js/xeditable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/editable.js');
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
          templateUrl: '/app/views/charts-flot.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                '/bower_components/flot/jquery.flot.js',
                                '/bower_components/flot/jquery.flot.resize.js',
                                '/bower_components/flot/jquery.flot.categories.js',
                                '/bower_components/flot/jquery.flot.stack.js',
                                '/bower_components/flot/jquery.flot.time.js',
                                '/bower_components/flot/jquery.flot.pie.js',
                                '/bower_components/flot-spline/js/jquery.flot.spline.js',
                                '/bower_components/flot.orderbars/js/jquery.flot.orderBars.js'
                            ]
                        },
                {
                  name: 'angular-flot',
                  files: [
                                '/bower_components/angular-flot/angular-flot.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/flot.js');
              });
                    }]
          },
          data: {
            title: 'Flot Charts',
          }
        })
        .state('app.charts.easypie', {
          url: '/easypie',
          templateUrl: '/app/views/charts-easypie.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'easypiechart',
                  files: [
                                '/bower_components/jquery.easy-pie-chart/dist/angular.easypiechart.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/easychart.js');
              });
                    }]
          },
          data: {
            title: 'Easypie Charts',
          }
        })
        .state('app.charts.chartjs', {
          url: '/chartjs',
          templateUrl: '/app/views/charts-chartjs.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                 {
                  files: [
                                '/bower_components/chartjs/Chart.js',
                            ]
                        },
                {
                  name: 'angles',
                  serie: true,
                  files: [
                                '/bower_components/angles/angles.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/chartjs.js');
              });
                    }]
          },
          data: {
            title: 'Chartjs',
          }
        })
        .state('app.charts.rickshaw', {
          url: '/rickshaw',
          templateUrl: '/app/views/charts-rickshaw.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/rickshaw/rickshaw.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/d3/d3.min.js',
                                '/bower_components/rickshaw/rickshaw.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/rickshaw.js');
              });
                    }]
          },
          data: {
            title: 'Rickshaw Charts',
          }
        })
        .state('app.charts.nvd3', {
          url: '/nvd3',
          templateUrl: '/app/views/charts-nvd3.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/nvd3/nv.d3.min.css'
                            ]
                        },
                {
                  name: 'nvd3',
                  serie: true,
                  files: [
                                '/bower_components/d3/d3.min.js',
                                '/bower_components/nvd3/nv.d3.min.js',
                                '/bower_components/angular-nvd3/dist/angular-nvd3.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/nvd3.js');
              });
                    }]
          },
          data: {
            title: 'Nvd3 Charts',
          }
        })
        .state('app.charts.c3', {
          url: '/c3',
          templateUrl: '/app/views/charts-c3.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/c3/c3.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/d3/d3.min.js',
                                '/bower_components/c3/c3.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/c3.js');
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
          templateUrl: '/app/views/map-google.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  name: 'ui.map',
                  files: [
                                '/bower_components/angular-ui-map/ui-map.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/google.js');
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
          templateUrl: '/app/views/map-vector.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/bower-jvectormap/jquery-jvectormap-1.2.2.min.js',
                                'data/maps/jquery-jvectormap-world-mill-en.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/vector.js');
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
          templateUrl: '/app/views/app-calendar.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/fullcalendar/dist/fullcalendar.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/jquery.ui/ui/core.js',
                                '/bower_components/jquery.ui/ui/widget.js',
                                '/bower_components/jquery.ui/ui/mouse.js',
                                '/bower_components/jquery.ui/ui/draggable.js',
                                '/bower_components/moment/moment.js',
                                '/bower_components/fullcalendar/dist/fullcalendar.min.js',
                                '/bower_components/fullcalendar/dist/gcal.js'
                            ]
                        },
                {
                  name: 'ui.calendar',
                  files: [
                                '/bower_components/angular-ui-calendar/src/calendar.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/calendar.js');
              });
                    }]
          },
          data: {
            title: 'Calendar',
          }
        })
        .state('app.apps.gallery', {
          url: '/gallery',
          templateUrl: '/app/views/app-gallery.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  insertBefore: '#load_styles_before',
                  files: [
                                '/bower_components/blueimp-gallery/css/blueimp-gallery.min.css',
                                '/bower_components/blueimp-bootstrap-image-gallery/css/bootstrap-image-gallery.min.css'
                            ]
                        },
                {
                  serie: true,
                  files: [
                                '/bower_components/blueimp-gallery/js/jquery.blueimp-gallery.min.js',
                                '/bower_components/blueimp-bootstrap-image-gallery/js/bootstrap-image-gallery.min.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/gallery.js');
              });
                    }]
          },
          data: {
            title: 'Gallery',
          }
        })
        .state('app.apps.messages', {
          url: '/messages',
          templateUrl: '/app/views/app-messages.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/messages.js').then(function () {
                return $ocLazyLoad.load('/app/scripts/services/messages.js');
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
          templateUrl: '/app/views/app-social.html',
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
          templateUrl: '/app/views/extras-popup.html',
          data: {
            title: 'Popup',
          }
        })
        .state('app.extras.invoice', {
          url: '/invoice',
          templateUrl: '/app/views/extras-invoice.html',
          data: {
            title: 'Invoice',
          }
        })
        .state('app.extras.timeline', {
          url: '/timeline',
          templateUrl: '/app/views/extras-timeline.html',
          data: {
            title: 'Timeline',
          }
        })
        .state('app.extras.sortable', {
          url: '/sortable',
          templateUrl: '/app/views/extras-sortable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load([
                {
                  serie: true,
                  files: [
                                '/bower_components/jquery.ui/ui/core.js',
                                '/bower_components/jquery.ui/ui/widget.js',
                                '/bower_components/jquery.ui/ui/mouse.js',
                                '/bower_components/jquery.ui/ui/sortable.js'
                            ]
                        }]).then(function () {
                return $ocLazyLoad.load('/app/scripts/controllers/sortable.js');
              });
                    }]
          },
          data: {
            title: 'Sortable',
          }
        })
        .state('app.extras.nestable', {
          url: '/nestable',
          templateUrl: '/app/views/extras-nestable.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/bower_components/nestable/jquery.nestable.js');
                    }]
          },
          data: {
            title: 'Nestable',
          }
        })
        .state('app.extras.search', {
          url: '/search',
          templateUrl: '/app/views/extras-search.html',
          data: {
            title: 'Search',
          }
        })
        .state('app.extras.changelog', {
          url: '/changelog',
          templateUrl: '/app/views/extras-changelog.html',
          data: {
            title: 'Changelog',
          }
        })
        .state('app.extras.blank', {
          url: '/blank',
          templateUrl: '/app/views/extras-blank.html',
          data: {
            title: 'Blank Pages',
          }
        })


      .state('app.widgets', {
        url: '/widgets',
        templateUrl: '/app/views/widgets.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                insertBefore: '#load_styles_before',
                files: [
                                'styles/climacons-font.css',
                                '/bower_components/checkbo/src/0.1.4/css/checkBo.min.css'
                            ]
                        },
              {
                files: [
                                '/bower_components/checkbo/src/0.1.4/js/checkBo.min.js'
                            ]
                        }]);
                    }]
        },
        data: {
          title: 'Widgets',
        }
      })


      .state('user', {
          templateUrl: '/app/views/common/session.html',
        })
        .state('user.signin', {
          url: '/signin',
          templateUrl: '/app/views/extras-signin.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.signup', {
          url: '/signup',
          templateUrl: '/app/views/extras-signup.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.forgot', {
          url: '/forgot',
          templateUrl: '/app/views/extras-forgot.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
          }
        })

      .state('app.404', {
          url: '/404',
          templateUrl: '/app/views/extras-404.html',
          data: {
            title: 'Page Not Found',
            contentClasses: 'no-padding',
          }
        })
        .state('user.500', {
          url: '/500',
          templateUrl: '/app/views/extras-500.html',
          data: {
            appClasses: 'usersession',
            contentClasses: 'full-height'
          }
        })
        .state('user.lockscreen', {
          url: '/lockscreen',
          templateUrl: '/app/views/extras-lockscreen.html',
          resolve: {
            deps: ['$ocLazyLoad', function ($ocLazyLoad) {
              return $ocLazyLoad.load('/app/scripts/controllers/session.js');
                    }]
          },
          data: {
            appClasses: 'usersession',
            contentClasses: 'full-height'
          }
        })


      .state('app.documentation', {
        url: '/documentation',
        templateUrl: '/app/views/docs.html',
        resolve: {
          deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([
              {
                serie: true,
                files: [
                                '/bower_components/prism/themes/prism.css',
                                '/bower_components/prism/prism.js',
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
    /*
    .config(['$ocLazyLoadProvider', function ($ocLazyLoadProvider) {
        $ocLazyLoadProvider.config({
          debug: false,
          events: false
        });
     }])
    */
    ;


// translate config
app.config(['$translateProvider',
    function ($translateProvider) {

        // prefix and suffix information  is required to specify a pattern
        // You can simply use the static-files loader with this pattern:
        $translateProvider.useStaticFilesLoader({
            prefix: '/bundles/publipr/js/i18n/',
            suffix: '.json'
        });

        var languages = ['en', 'fr'];
        var currentLanguage = languages[0];
        for (var i in languages) {
            if (window.location.hash.endsWith('/'+languages[i])) {
                currentLanguage = languages[i];
            }
        }
        localStorage['NG_TRANSLATE_LANG_KEY'] = currentLanguage;
        localStorage['ngStorage-language'] = '"'+currentLanguage+'"';

        // Since you've now registered more then one translation table, angular-translate has to know which one to use.
        // This is where preferredLanguage(langKey) comes in.
        $translateProvider.preferredLanguage(currentLanguage);

        // Store the language in the local storage
        $translateProvider.useLocalStorage();

        // Enable sanitize
        $translateProvider.useSanitizeValueStrategy('escape'); // sanitize

    }
]);

// Angular-Loading-Bar
// configuration
app.config(['cfpLoadingBarProvider',
    function (cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeBar = true;
        cfpLoadingBarProvider.includeSpinner = false;

    }]);

//  This binding is brought you by [[ ]] interpolation symbols.
app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.factory('httpRequestInterceptor', ['$q', '$localStorage', '$location', '$filter', '$timeout', 'toaster',
    function ($q, $localStorage, $location, $filter, $timeout, toaster) {
        return {
            request: function (config) {
                if ($localStorage.access_token) {
                    config.headers['Authorization'] = 'Bearer ' + $localStorage.access_token;
                    config.headers['PP-Application'] = 'CustomerCare';
                }
                return config;
            },
            responseError: function (response) {
                if ( response.status === 401) {
                    delete $localStorage.access_token;
                    console.log($location.path())
                    if ($location.path() != '/auth/lock-screen') {
                        $location.path('/auth/login');
                    }
                } else if (response.status === 403) {
                    toaster.pop('warning', $filter('translate')('content.common.WARNING'), $filter('translate')('login.ACCESSDENEID'));
                    $timeout(function(){
                        $location.path('/app/dashboard');
                    }, 1000);
                }
                return $q.reject(response);
            }
        };
    }
]);

// Generates a resolve object previously configured in constant.JS_REQUIRES or in constant.APP_JS_REQUIRES (config.constant.js)
function loadSequence() {
    var _args = arguments;
    return {
        deps: ['$ocLazyLoad', '$q', 'JS_REQUIRES', 'APP_JS_REQUIRES',
            function ($ocLL, $q, jsRequires, appJsRequires) {
                var promise = $q.when(1);
                for (var i = 0, len = _args.length; i < len; i++) {
                    promise = promiseThen(_args[i]);
                }
                return promise;

                function promiseThen(_arg) {
                    if (typeof _arg == 'function')
                        return promise.then(_arg);
                    else
                        return promise.then(function () {
                            var nowLoad = requiredData(_arg);
                            if (!nowLoad)
                                return $.error('Route resolve: Bad resource name [' + _arg + ']');
                            return $ocLL.load(nowLoad);
                        });
                }

                function requiredData(name) {
                    if (jsRequires.modules)
                        for (var m in jsRequires.modules)
                            if (jsRequires.modules[m].name && jsRequires.modules[m].name === name)
                                return jsRequires.modules[m];
                    if (appJsRequires.modules)
                        for (var m in appJsRequires.modules)
                            if (appJsRequires.modules[m].name && appJsRequires.modules[m].name === name)
                                return appJsRequires.modules[m];
                    return (jsRequires.scripts && jsRequires.scripts[name]) || (appJsRequires.scripts && appJsRequires.scripts[name]);
                }
            }]
    };
}

/**
 * Config for the router
 */
app.config(['$stateProvider', '$httpProvider', '$urlRouterProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$ocLazyLoadProvider', 'JS_REQUIRES', 'APP_JS_REQUIRES',
    function ($stateProvider, $httpProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $ocLazyLoadProvider, jsRequires, appJsRequires) {

        app.controller = $controllerProvider.register;
        app.directive = $compileProvider.directive;
        app.filter = $filterProvider.register;
        app.factory = $provide.factory;
        app.service = $provide.service;
        app.constant = $provide.constant;
        app.value = $provide.value;

        $httpProvider.interceptors.push('httpRequestInterceptor');

        // LAZY MODULES
        $ocLazyLoadProvider.config({
            debug: false,
            events: true,
            modules: jsRequires.modules.concat(appJsRequires)
        });


    }
]);

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
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('LoginCtrl', 'LoginService')
    }).state('auth.register', {
        url: '/register',
        templateUrl: '/bundles/publipr/js/components/Auth/register.html',
        title: 'content.list.REGISTER',
        ncyBreadcrumb: {
            label: 'content.list.REGISTER'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('sweet-alert', 'oitozero.ngSweetAlert', 'RegisterCtrl', 'RegisterService')
    }).state('auth.resetpassword', {
        url: '/reset-password',
        templateUrl: '/bundles/publipr/js/components/Auth/reset_password.html',
        title: 'content.list.RESETPAWSSWORD',
        ncyBreadcrumb: {
            label: 'content.list.RESETPAWSSWORD'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('ResetPasswordCtrl', 'ResetPasswordService')
    }).state('auth.emailconfirm', {
        url: '/email-confirm/:token/:language',
        templateUrl: '/bundles/publipr/js/components/Auth/email_confirm.html',
        title: 'content.list.EMAILCONFIRM',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCONFIRM'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('EmailConfirmCtrl', 'RegisterService')
    }).state('auth.reset', {
        url: '/reset/:token/:language',
        templateUrl: '/bundles/publipr/js/components/Auth/reset.html',
        title: 'content.list.RESET',
        ncyBreadcrumb: {
            label: 'content.list.RESET'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('ResetCtrl', 'ResetPasswordService')
    }).state('auth.lockscreen', {
        url: '/lock-screen',
        templateUrl: '/bundles/publipr/js/components/Auth/lock_screen.html',
        title: 'content.list.LOCKSCREEN',
        ncyBreadcrumb: {
            label: 'content.list.LOCKSCREEN'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('LockScreenCtrl', 'LoginService')
    }).state('app.profile', {
        url: '/profile',
        templateUrl: '/bundles/publipr/js/components/Auth/profile.html',
        title: 'topbar.user.PROFILE',
        ncyBreadcrumb: {
            label: 'topbar.user.PROFILE'
        },
        resolve: loadSequence('jquery-sparkline', 'ProfileCtrl', 'ProfileService', 'countryService')
    }).state('app.changepassword', {
        url: '/change-password',
        templateUrl: '/bundles/publipr/js/components/Auth/change_password.html',
        title: 'topbar.user.CHANGEPASSWORD',
        ncyBreadcrumb: {
            label: 'topbar.user.CHANGEPASSWORD'
        },
        resolve: loadSequence('jquery-sparkline', 'ChangePasswordCtrl', 'ProfileService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersedit', {
        url: '/users/edit/:id',
        templateUrl: '/bundles/publipr/js/components/User/user_form.html',
        title: 'content.list.EDITUSER',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersdetails', {
        url: '/users/details/:id',
        templateUrl: '/bundles/publipr/js/components/User/user.html',
        ncyBreadcrumb: {
            label: 'content.list.USERDETAILS'
        },
        resolve: loadSequence('UserCtrl', 'userService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesedit', {
        url: '/companies/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company_form.html',
        title: 'content.list.EDITCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesdetails', {
        url: '/companies/details/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company.html',
        ncyBreadcrumb: {
            label: 'content.list.COMPANYDETAILS'
        },
        resolve: loadSequence('CompanyCtrl', 'companyService')
    }).state('app.access.logs', {
        url: '/logs',
        templateUrl: '/bundles/publipr/js/components/Log/logs.html',
        title: 'content.list.LOGS',
        ncyBreadcrumb: {
            label: 'content.list.LOGS'
        },
        resolve: loadSequence('ngTable', 'LogsCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsnew', {
        url: '/logs/new',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.NEWLOG',
        ncyBreadcrumb: {
            label: 'content.list.NEWLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsedit', {
        url: '/logs/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.EDITLOG',
        ncyBreadcrumb: {
            label: 'content.list.EDITLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsdetails', {
        url: '/logs/details/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log.html',
        ncyBreadcrumb: {
            label: 'content.list.LOGDETAILS'
        },
        resolve: loadSequence('LogCtrl', 'logService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsedit', {
        url: '/contact-groups/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group_form.html',
        title: 'content.list.EDITCONTACTGROUP',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACTGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsedit', {
        url: '/contacts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_form.html',
        title: 'content.list.EDITCONTACT',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsdetails', {
        url: '/contacts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTDETAILS'
        },
        resolve: loadSequence('ContactCtrl', 'contactService')
    }).state('app.contactmanager.contactsimport', {
        url: '/contacts/import',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_import.html',
        ncyBreadcrumb: {
            label: 'content.list.IMPORTCONTACTS'
        },
        resolve: loadSequence('ContactImportCtrl', 'ContactImportService', 'contactService', 'touchspin-plugin', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsexport', {
        url: '/contacts/export',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_export.html',
        ncyBreadcrumb: {
            label: 'content.list.IMPORTCONTACTS'
        },
        resolve: loadSequence('ContactExportCtrl', 'ContactExportService', 'contactService', 'contactGroupService', 'userService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesedit', {
        url: '/templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Template/template_form.html',
        title: 'content.list.EDITTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsedit', {
        url: '/layouts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout_form.html',
        title: 'content.list.EDITLAYOUT',
        ncyBreadcrumb: {
            label: 'content.list.EDITLAYOUT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsdetails', {
        url: '/layouts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout.html',
        ncyBreadcrumb: {
            label: 'content.list.LAYOUTDETAILS'
        },
        resolve: loadSequence('LayoutCtrl', 'layoutService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksedit', {
        url: '/content-blocks/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block_form.html',
        title: 'content.list.EDITCONTENTBLOCK',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTENTBLOCK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksdetails', {
        url: '/content-blocks/details/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTENTBLOCKDETAILS'
        },
        resolve: loadSequence('ContentBlockCtrl', 'contentBlockService')
    }).state('app.templatemanager.fonts', {
        url: '/fonts',
        templateUrl: '/bundles/publipr/js/components/Font/fonts.html',
        title: 'content.list.FONTS',
        ncyBreadcrumb: {
            label: 'content.list.FONTS'
        },
        resolve: loadSequence('ngTable', 'FontsCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsnew', {
        url: '/fonts/new',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.NEWFONT',
        ncyBreadcrumb: {
            label: 'content.list.NEWFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsedit', {
        url: '/fonts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.EDITFONT',
        ncyBreadcrumb: {
            label: 'content.list.EDITFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsdetails', {
        url: '/fonts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font.html',
        ncyBreadcrumb: {
            label: 'content.list.FONTDETAILS'
        },
        resolve: loadSequence('FontCtrl', 'fontService')
    }).state('app.configuration', {
        url: '/configuration',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.configuration.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.configuration.MAIN'
        }
    }).state('app.configuration.languages', {
        url: '/languages',
        templateUrl: '/bundles/publipr/js/components/Language/languages.html',
        title: 'content.list.LANGUAGES',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGES'
        },
        resolve: loadSequence('ngTable', 'LanguagesCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesnew', {
        url: '/languages/new',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.NEWLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesedit', {
        url: '/languages/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.EDITLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesdetails', {
        url: '/languages/details/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language.html',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGEDETAILS'
        },
        resolve: loadSequence('LanguageCtrl', 'languageService')
    }).state('app.configuration.emailtemplates', {
        url: '/email-templates',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_templates.html',
        title: 'content.list.EMAILTEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATES'
        },
        resolve: loadSequence('ngTable', 'EmailTemplatesCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesnew', {
        url: '/email-templates/new',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.NEWEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesedit', {
        url: '/email-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.EDITEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesdetails', {
        url: '/email-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATEDETAILS'
        },
        resolve: loadSequence('EmailTemplateCtrl', 'emailTemplateService')
    }).state('app.configuration.countries', {
        url: '/countries',
        templateUrl: '/bundles/publipr/js/components/Country/countries.html',
        title: 'content.list.COUNTRIES',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRIES'
        },
        resolve: loadSequence('ngTable', 'CountriesCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesnew', {
        url: '/countries/new',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.NEWCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesedit', {
        url: '/countries/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.EDITCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesdetails', {
        url: '/countries/details/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country.html',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRYDETAILS'
        },
        resolve: loadSequence('CountryCtrl', 'countryService')
    }).state('app.configuration.settings', {
        url: '/settings',
        templateUrl: '/bundles/publipr/js/components/Setting/settings.html',
        title: 'content.list.SETTINGS',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGS'
        },
        resolve: loadSequence('ngTable', 'SettingsCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsnew', {
        url: '/settings/new',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.NEWSETTING',
        ncyBreadcrumb: {
            label: 'content.list.NEWSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsedit', {
        url: '/settings/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.EDITSETTING',
        ncyBreadcrumb: {
            label: 'content.list.EDITSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsdetails', {
        url: '/settings/details/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting.html',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGDETAILS'
        },
        resolve: loadSequence('SettingCtrl', 'settingService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsedit', {
        url: '/emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email_form.html',
        title: 'content.list.EDITEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsdetails', {
        url: '/emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILDETAILS'
        },
        resolve: loadSequence('EmailCtrl', 'emailService')
    }).state('app.distribution.emailcampaigns', {
        url: '/email-campaigns',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaigns.html',
        title: 'content.list.EMAILCAMPAIGNS',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNS'
        },
        resolve: loadSequence('ngTable', 'EmailCampaignsCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsnew', {
        url: '/email-campaigns/new',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.NEWEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsedit', {
        url: '/email-campaigns/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.EDITEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsdetails', {
        url: '/email-campaigns/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNDETAILS'
        },
        resolve: loadSequence('EmailCampaignCtrl', 'emailCampaignService')
    }).state('app.prmanager', {
        url: '/p-r-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.prmanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.prmanager.MAIN'
        }
    }).state('app.prmanager.newsrooms', {
        url: '/newsrooms',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsrooms.html',
        title: 'content.list.NEWSROOMS',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMS'
        },
        resolve: loadSequence('ngTable', 'NewsroomsCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsnew', {
        url: '/newsrooms/new',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.NEWNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsedit', {
        url: '/newsrooms/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.EDITNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsdetails', {
        url: '/newsrooms/details/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMDETAILS'
        },
        resolve: loadSequence('NewsroomCtrl', 'newsroomService')
    }).state('app.prmanager.pressreleases', {
        url: '/press-releases',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_releases.html',
        title: 'content.list.PRESSRELEASES',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASES'
        },
        resolve: loadSequence('ngTable', 'PressReleasesCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesnew', {
        url: '/press-releases/new',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.NEWPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesedit', {
        url: '/press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.EDITPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesdetails', {
        url: '/press-releases/details/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASEDETAILS'
        },
        resolve: loadSequence('PressReleaseCtrl', 'pressReleaseService')
    }).state('app.prmanager.pressreleaseseditor', {
        url: '/press-releases/editor/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_editor.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASEEDITOR'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('PressReleaseEditorCtrl', 'contentBlockService', 'layoutService', 'newsroomService', 'templateService', 'pressReleaseService', 'PressReleaseEditorService')
    }).state('app.prmanager.pressreleasessend', {
        url: '/press-releases/send/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_sender.html',
        ncyBreadcrumb: {
            label: 'content.list.SENDPRESSRELEASE'
        },
        resolve: loadSequence('PressReleaseSenderCtrl', 'PressReleaseSenderService', 'pressReleaseService', 'contactGroupService')
    }).state('app.prmanager.pressreleasesstats', {
        url: '/press-releases/stats/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_stats.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASESTATS'
        },
        resolve: loadSequence('ngTable', 'PressReleaseStatsCtrl', 'PressReleaseStatsService', 'pressReleaseService', 'PressReleaseEmailStatsService')
    }).state('app.settings', {
        url: '/settings',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.settings.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.settings.MAIN'
        }
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesedit', {
        url: '/newsroom-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template_form.html',
        title: 'content.list.EDITNEWSROOMTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOMTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesdetails', {
        url: '/newsroom-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMTEMPLATEDETAILS'
        },
        resolve: loadSequence('NewsroomTemplateCtrl', 'newsroomTemplateService')
    }).state('app.billing', {
        url: '/billing',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.billing.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.billing.MAIN'
        }
    }).state('app.billing.products', {
        url: '/products',
        templateUrl: '/bundles/publipr/js/components/Product/products.html',
        title: 'content.list.PRODUCTS',
        ncyBreadcrumb: {
            label: 'content.list.PRODUCTS'
        },
        resolve: loadSequence('ngTable', 'ProductsCtrl', 'productService', 'userService')
    }).state('app.billing.productsnew', {
        url: '/products/new',
        templateUrl: '/bundles/publipr/js/components/Product/product_form.html',
        title: 'content.list.NEWPRODUCT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRODUCT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ProductFormCtrl', 'productService', 'userService')
    }).state('app.billing.productsedit', {
        url: '/products/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Product/product_form.html',
        title: 'content.list.EDITPRODUCT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRODUCT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ProductFormCtrl', 'productService', 'userService')
    }).state('app.billing.productsdetails', {
        url: '/products/details/:id',
        templateUrl: '/bundles/publipr/js/components/Product/product.html',
        ncyBreadcrumb: {
            label: 'content.list.PRODUCTDETAILS'
        },
        resolve: loadSequence('ProductCtrl', 'productService')
    }).state('app.billing.payments', {
        url: '/payments',
        templateUrl: '/bundles/publipr/js/components/Payment/payments.html',
        title: 'content.list.PAYMENTS',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTS'
        },
        resolve: loadSequence('ngTable', 'PaymentsCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsnew', {
        url: '/payments/new',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.NEWPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsedit', {
        url: '/payments/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.EDITPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsdetails', {
        url: '/payments/details/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment.html',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTDETAILS'
        },
        resolve: loadSequence('PaymentCtrl', 'paymentService')
    }).state('app.billing.check_payment',{
        url: '/purchase',
        templateUrl: '/bundles/publipr/js/components/Payment/purchase.html',
        title: 'content.list.PURCHASE',
        ncyBreadcrumb: {
            label:'content.list.PURCHASE'
        },
        resolve: loadSequence('PurchaseCtrl', 'paymentService', 'PurchaseService')
    }).state('app.billing.purchasenew',{
        url: '/purchase/new',
        templateUrl: '/bundles/publipr/js/components/Payment/purchase_form.html',
        title: 'content.list.PURCHASE',
        ncyBreadcrumb: {
            label:'content.list.PURCHASE'
        },
        resolve: loadSequence('PurchaseFormCtrl', 'paymentService', 'PurchaseService', 'productService')
    }).state('app.billing.invoice', {
        url : '/invoice/:id',
        templateUrl: '/bundles/publipr/js/components/Invoice/invoice.html',
        title: 'content.list.INVOICE',
        ncyBreadcrumb: {
            label:'content.list.INVOICE'
        },
        resolve: loadSequence('InvoiceCtrl', 'paymentService', 'InvoiceDownloadService', 'InvoiceService')
    })
.state('app.billing.paymentplans', {
        url: '/payment-plans',
        templateUrl: '/bundles/publipr/js/components/PaymentPlan/payment_plans.html',
        title: 'content.list.PAYMENTPLANS',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTPLANS'
        },
        resolve: loadSequence('ngTable', 'PaymentPlansCtrl', 'paymentPlanService', 'userService')
    }).state('app.billing.paymentplansnew', {
        url: '/payment-plans/new',
        templateUrl: '/bundles/publipr/js/components/PaymentPlan/payment_plan_form.html',
        title: 'content.list.NEWPAYMENTPLAN',
        ncyBreadcrumb: {
            label: 'content.list.NEWPAYMENTPLAN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentPlanFormCtrl', 'paymentPlanService', 'userService')
    }).state('app.billing.paymentplansedit', {
        url: '/payment-plans/edit/:id',
        templateUrl: '/bundles/publipr/js/components/PaymentPlan/payment_plan_form.html',
        title: 'content.list.EDITPAYMENTPLAN',
        ncyBreadcrumb: {
            label: 'content.list.EDITPAYMENTPLAN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentPlanFormCtrl', 'paymentPlanService', 'userService')
    }).state('app.billing.paymentplansdetails', {
        url: '/payment-plans/details/:id',
        templateUrl: '/bundles/publipr/js/components/PaymentPlan/payment_plan.html',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTPLANDETAILS'
        },
        resolve: loadSequence('PaymentPlanCtrl', 'paymentPlanService')
    }).state('app.billing.userpaymentplans', {
        url: '/user-payment-plans',
        templateUrl: '/bundles/publipr/js/components/UserPaymentPlan/user_payment_plans.html',
        title: 'content.list.USERPAYMENTPLANS',
        ncyBreadcrumb: {
            label: 'content.list.USERPAYMENTPLANS'
        },
        resolve: loadSequence('ngTable', 'UserPaymentPlansCtrl', 'userPaymentPlanService', 'userService', 'paymentPlanService')
    }).state('app.billing.userpaymentplansnew', {
        url: '/user-payment-plans/new',
        templateUrl: '/bundles/publipr/js/components/UserPaymentPlan/user_payment_plan_form.html',
        title: 'content.list.NEWUSERPAYMENTPLAN',
        ncyBreadcrumb: {
            label: 'content.list.NEWUSERPAYMENTPLAN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserPaymentPlanFormCtrl', 'userPaymentPlanService', 'userService', 'paymentPlanService')
    }).state('app.billing.userpaymentplansedit', {
        url: '/user-payment-plans/edit/:id',
        templateUrl: '/bundles/publipr/js/components/UserPaymentPlan/user_payment_plan_form.html',
        title: 'content.list.EDITUSERPAYMENTPLAN',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSERPAYMENTPLAN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserPaymentPlanFormCtrl', 'userPaymentPlanService', 'userService', 'paymentPlanService')
    }).state('app.billing.userpaymentplansdetails', {
        url: '/user-payment-plans/details/:id',
        templateUrl: '/bundles/publipr/js/components/UserPaymentPlan/user_payment_plan.html',
        ncyBreadcrumb: {
            label: 'content.list.USERPAYMENTPLANDETAILS'
        },
        resolve: loadSequence('UserPaymentPlanCtrl', 'userPaymentPlanService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsedit', {
        url: '/sessions/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session_form.html',
        title: 'content.list.EDITSESSION',
        ncyBreadcrumb: {
            label: 'content.list.EDITSESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsdetails', {
        url: '/sessions/details/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session.html',
        ncyBreadcrumb: {
            label: 'content.list.SESSIONDETAILS'
        },
        resolve: loadSequence('SessionCtrl', 'sessionService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesedit', {
        url: '/track-press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release_form.html',
        title: 'content.list.EDITTRACKPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
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
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsedit', {
        url: '/track-emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email_form.html',
        title: 'content.list.EDITTRACKEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsdetails', {
        url: '/track-emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email.html',
        ncyBreadcrumb: {
            label: 'content.list.TRACKEMAILDETAILS'
        },
        resolve: loadSequence('TrackEmailCtrl', 'trackEmailService')
    });

}]);
