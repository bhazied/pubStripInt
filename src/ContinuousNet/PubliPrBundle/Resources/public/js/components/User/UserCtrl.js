'use strict';

/**
 * Controller for User Details
 */

app.controller('UserCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$usersDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $usersDataFactory) {

    $scope.types = [{
        id: 'Free',
        title: $filter('translate')('content.list.fields.types.FREE'),
        css: 'primary'
    }, {
        id: 'Manager',
        title: $filter('translate')('content.list.fields.types.MANAGER'),
        css: 'success'
    }, {
        id: 'Contributor',
        title: $filter('translate')('content.list.fields.types.CONTRIBUTOR'),
        css: 'warning'
    }, {
        id: 'Administrator',
        title: $filter('translate')('content.list.fields.types.ADMINISTRATOR'),
        css: 'danger'
    }];
    $scope.genders = [{
        id: 'Male',
        title: $filter('translate')('content.list.fields.genders.MALE'),
        css: 'primary'
    }, {
        id: 'Female',
        title: $filter('translate')('content.list.fields.genders.FEMALE'),
        css: 'success'
    }];
    $scope.authenticationModes = [{
        id: 'Database',
        title: $filter('translate')('content.list.fields.authenticationmodes.DATABASE'),
        css: 'primary'
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
        css: 'primary'
    }, {
        id: 'FREE_ACCOUNT',
        title: $filter('translate')('content.list.fields.roles.FREE_ACCOUNT'),
        css: 'success'
    }, {
        id: 'ROLE_ACCOUNT_USER',
        title: $filter('translate')('content.list.fields.roles.ROLE_ACCOUNT_USER'),
        css: 'warning'
    }, {
        id: 'ROLE_ACCOUNT_MANAGER',
        title: $filter('translate')('content.list.fields.roles.ROLE_ACCOUNT_MANAGER'),
        css: 'danger'
    }, {
        id: 'ROLE_ADMIN',
        title: $filter('translate')('content.list.fields.roles.ROLE_ADMIN'),
        css: 'default'
    }, {
        id: 'ROLE_SUPER_ADMIN',
        title: $filter('translate')('content.list.fields.roles.ROLE_SUPER_ADMIN'),
        css: 'info'
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

