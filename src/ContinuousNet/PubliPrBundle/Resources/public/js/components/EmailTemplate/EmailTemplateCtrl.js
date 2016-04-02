'use strict';

/**
 * Controller for Email Template Details
 */

app.controller('EmailTemplateCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$emailTemplatesDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $emailTemplatesDataFactory) {

    $scope.statuses = [{
        id: 'Draft',
        title: $filter('translate')('content.list.fields.statuses.DRAFT'),
        css: 'info'
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
        css: 'inverse'
    }, {
        id: 'Deleted',
        title: $filter('translate')('content.list.fields.statuses.DELETED'),
        css: 'danger'
    }, {
        id: 'Archived',
        title: $filter('translate')('content.list.fields.statuses.ARCHIVED'),
        css: 'primary'
    }];

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.datetimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');

    $scope.list = function() {
        $state.go('app.settings.emailtemplates');
    };

    $scope.add = function() {
        $state.go('app.settings.emailtemplatesnew');
    };

    $scope.edit = function(row) {
        $state.go('app.settings.emailtemplatesedit', {id: row.id});
    };

    if (angular.isDefined($stateParams.id)) {
        $emailTemplatesDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $scope.emailTemplate = data;
        });
    }

}]);

