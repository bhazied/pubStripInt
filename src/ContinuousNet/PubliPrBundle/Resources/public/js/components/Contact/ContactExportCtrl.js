'use strict';

/**
 * Controller for Contact Importer
 */

app.controller('ContactImportCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$contactsDataFactory', '$ContactExporterService',
    function($scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $contactsDataFactory, $ContactExporterService) {

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



    }]);

