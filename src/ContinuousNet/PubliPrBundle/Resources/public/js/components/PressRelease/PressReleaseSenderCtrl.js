'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.controller('PressReleaseSenderCtrl', ['$rootScope','$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', '$pressReleasesDataFactory','$contactGroupsDataFactory',
     function( $rootScope,$scope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, $pressReleasesDataFactory , $contactGroupsDataFactory){
         $scope.contactGroups = [];
         $scope.contactGroupsLoaded = false;
    $scope.title = 'press release sender';
         if(angular.isDefined($stateParams.id)){
             $pressReleasesDataFactory.get({id: $stateParams.id}).$promise.then(function(data){
                 $scope.pressRelease = data;
             });
             console.log($scope.pressRelease);
         }
         $scope.getContactGroups = function(){
             $timeout(function () {
                 $scope.contactGroupsLoaded = true;
                if($scope.contactGroups.length == 0){
                    $scope.contactGroups.push({});
                    var def = $q.defer();
                    $contactGroupsDataFactory.query({offset: 0, limit: 10000, 'order_by[contactGroup.name]': 'asc'}).$promise.then(function(data){
                        for (var i in data.results) {
                            data.results[i].hidden = false;
                        }
                        $scope.contactGroups = data.results;
                        def.resolve($scope.contactGroups);
                    });
                }
                 else {
                    return $scope.contactGroups;
                }
             });
         }

     $scope.getContactGroups();

         $scope.submitForm = function(form){
             var firstError = null;
             if(form.$invalid){
                 var field = null;
                 firstError = null;
                 for(field in form){
                     console.log(field);
                 }
             }
             else {
                console.log($scope.contactGroups.id);

             }

         }

         $scope.list = function(){
             $state.go('app.prmanager.pressreleases');
         }
}]);
