'use strict';

/**
 * Controller for Contact Importer
 */

app.controller('ContactImportCtrl', ['$scope', '$rootScope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', 'toaster', '$contactsDataFactory', '$contactGroupsDataFactory', '$http',
    function($scope, $rootScope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, toaster, $contactsDataFactory, $contactGroupsDataFactory, $http) {

        $scope.contact = {
            first_name: true,
            last_name: true,
            email: true,
            phone: true,
            active: ''
        };

        $scope.contactGroups = [];
        $scope.contactGroupsLoaded = false;

        $scope.getContactGroups = function() {
            $timeout(function(){
                $scope.contactGroupsLoaded = true;
                if ($scope.contactGroups.length == 0) {
                    $scope.contactGroups.push({});
                    var def = $q.defer();
                    $contactGroupsDataFactory.query({offset: 0, limit: 10000, 'order_by[contactGroup.name]': 'asc'}).$promise.then(function(data) {
                        for (var i in data.results) {
                            data.results[i].hidden = false;
                        }
                        $scope.contactGroups = data.results;
                        def.resolve($scope.contactGroups);
                    });
                    return def;
                } else {
                    return $scope.contactGroups;
                }
            });
        };

        $scope.getContactGroups();

        $scope.submitForm = function(form) {
            var deferred = $q.defer();
            $scope.disableSubmit = true;
            var req = {
                method: 'POST',
                url: $rootScope.app.apiURL + 'contactsExport',
                data: $scope.contact,
                responseType: 'arraybuffer'
            };
            $http(req).success(function(data, status, headers) {
                $scope.disableSubmit = false;
                if (status == 200) {
                    var type = headers('Content-Type');
                    var disposition = headers('Content-Disposition');
                    var defaultFileName = 'contact.xlsx';
                    if (disposition) {
                        var match = disposition.match(/.*filename=\"?([^;\"]+)\"?.*/);
                        if (match[1])
                            defaultFileName = match[1];
                    }
                    var defaultFileName = defaultFileName.replace(/[<>:"\/\\|?*]+/g, '_');
                    var blob = new Blob([data], { type: type });
                    saveAs(blob, defaultFileName);
                    deferred.resolve(defaultFileName);
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.form.messages.DATAEXPORTED'));
                } else {
                    toaster.pop('warning', $filter('translate')('content.common.ERROR'), $filter('translate')('content.form.messages.NODATATOEXPORT'));
                }
            }).error(function (data, status) {
                $scope.disableSubmit = false;
                toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.form.messages.DATANOTEXPORTED'));
                console.warn(error);
            });

        };

    }]);

