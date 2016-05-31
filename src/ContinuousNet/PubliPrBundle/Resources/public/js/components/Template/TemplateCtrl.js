'use strict';

/**
 * Controller for Template Details
 */

app.controller('TemplateCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$templatesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $templatesDataFactory) {

    $scope.types = [{
        id: 'Basic',
        title: $filter('translate')('content.list.fields.types.BASIC'),
        css: 'primary'
    }, {
        id: 'Theme',
        title: $filter('translate')('content.list.fields.types.THEME'),
        css: 'success'
    }, {
        id: 'Custom',
        title: $filter('translate')('content.list.fields.types.CUSTOM'),
        css: 'warning'
    }];
    $scope.statuses = [{
        id: 'Draft',
        title: $filter('translate')('content.list.fields.statuses.DRAFT'),
        css: 'primary'
    }, {
        id: 'Online',
        title: $filter('translate')('content.list.fields.statuses.ONLINE'),
        css: 'success'
    }, {
        id: 'Deactivated',
        title: $filter('translate')('content.list.fields.statuses.DEACTIVATED'),
        css: 'warning'
    }, {
        id: 'Offline',
        title: $filter('translate')('content.list.fields.statuses.OFFLINE'),
        css: 'danger'
    }, {
        id: 'Deleted',
        title: $filter('translate')('content.list.fields.statuses.DELETED'),
        css: 'default'
    }, {
        id: 'Archived',
        title: $filter('translate')('content.list.fields.statuses.ARCHIVED'),
        css: 'info'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.templatemanager.templates');
    };

    $scope.add = function() {
        $state.go('app.templatemanager.templatesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.templatemanager.templatesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $templatesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.template = data;
        });
    }

}]);

