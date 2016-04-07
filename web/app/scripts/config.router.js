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
                    firstName: 'User',
                    job: 'Webmaster',
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