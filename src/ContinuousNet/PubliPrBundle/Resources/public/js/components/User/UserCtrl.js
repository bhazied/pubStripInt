'use strict';

/**
 * Controller for User Details
 */

app.controller('UserCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$usersDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $usersDataFactory) {

    $scope.types = [{
        id: 'Guest',
        title: $filter('translate')('content.list.fields.types.GUEST'),
        css: 'info'
    }, {
        id: 'Subscriber',
        title: $filter('translate')('content.list.fields.types.SUBSCRIBER'),
        css: 'success'
    }, {
        id: 'Administrator',
        title: $filter('translate')('content.list.fields.types.ADMINISTRATOR'),
        css: 'warning'
    }, {
        id: 'Publisher',
        title: $filter('translate')('content.list.fields.types.PUBLISHER'),
        css: 'inverse'
    }, {
        id: 'ContentProvider',
        title: $filter('translate')('content.list.fields.types.CONTENTPROVIDER'),
        css: 'danger'
    }, {
        id: 'ServiceProvider',
        title: $filter('translate')('content.list.fields.types.SERVICEPROVIDER'),
        css: 'primary'
    }];
    $scope.genders = [{
        id: 'Male',
        title: $filter('translate')('content.list.fields.genders.MALE'),
        css: 'info'
    }, {
        id: 'Female',
        title: $filter('translate')('content.list.fields.genders.FEMALE'),
        css: 'success'
    }];
    $scope.authenticationModes = [{
        id: 'Database',
        title: $filter('translate')('content.list.fields.authenticationmodes.DATABASE'),
        css: 'info'
    }, {
        id: 'ActiveDirectory',
        title: $filter('translate')('content.list.fields.authenticationmodes.ACTIVEDIRECTORY'),
        css: 'success'
    }, {
        id: 'Webservice',
        title: $filter('translate')('content.list.fields.authenticationmodes.WEBSERVICE'),
        css: 'warning'
    }];
    $scope.roles = [{
        id: 'ROLE_API',
        title: $filter('translate')('content.list.fields.roles.ROLE_API'),
        css: 'info'
    }, {
        id: 'ROLE_SUBSCRIBER',
        title: $filter('translate')('content.list.fields.roles.ROLE_SUBSCRIBER'),
        css: 'success'
    }, {
        id: 'ROLE_ADMIN',
        title: $filter('translate')('content.list.fields.roles.ROLE_ADMIN'),
        css: 'warning'
    }, {
        id: 'ROLE_ADMIN_PUBLISHER',
        title: $filter('translate')('content.list.fields.roles.ROLE_ADMIN_PUBLISHER'),
        css: 'inverse'
    }, {
        id: 'ROLE_SUPER_ADMIN',
        title: $filter('translate')('content.list.fields.roles.ROLE_SUPER_ADMIN'),
        css: 'danger'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.access.users');
    };

    $scope.add = function() {
        $state.go('app.access.usersnew');
    };

    $scope.edit = function(row) {
        $state.go('app.access.usersedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $usersDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.user = data;
        });
    }

}]);

