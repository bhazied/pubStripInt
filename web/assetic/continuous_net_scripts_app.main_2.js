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
            $rootScope.user = $localStorage.user;
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
