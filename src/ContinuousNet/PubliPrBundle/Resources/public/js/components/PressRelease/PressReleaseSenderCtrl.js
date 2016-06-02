'use strict'
/**
 * Created by dev03 on 10/05/16.
 */
app.controller('PressReleaseSenderCtrl', ['$rootScope','$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter','toaster','SweetAlert', '$q', '$interpolate', '$localStorage', '$pressReleasesDataFactory','$contactGroupsDataFactory','$PressReleaseSenderDataFactory',
     function( $rootScope,$scope, $state, $stateParams, $sce, $timeout, $filter, toaster, SweetAlert, $q, $interpolate, $localStorage, $pressReleasesDataFactory , $contactGroupsDataFactory, $PressReleaseSenderDataFactory){
         $scope.contactGroups = [];
         $scope.contactGroupsLoaded = false;
         if(angular.isDefined($stateParams.id)){
             $pressReleasesDataFactory.get({id: $stateParams.id}).$promise.then(function(data){
                 $scope.pressRelease = data;
             });
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
         $scope.contactSelection = [];
         $scope.toggleSelection = function (contactId) {
             var idx =$scope.contactSelection.indexOf(contactId);
             if(idx > -1){
                 $scope.contactSelection.splice(idx, 1);
             }
             else{
                 $scope.contactSelection.push(contactId);
             }
         }
         $scope.submitForm = function(form){
             var firstError = null;
             if (form.$invalid) {
                 var field = null, firstError = null;
                 for (field in form) {
                     if (field[0] != '$') {
                         if (firstError === null && !form[field].$valid) {
                             firstError = form[field].$name;
                         }
                         if (form[field].$pristine) {
                             form[field].$dirty = true;
                         }
                     }
                 }
                 angular.element('.ng-invalid[name=' + firstError + ']').focus();
                 SweetAlert.swal($filter('translate')('content.form.messages.FORMCANNOTBESUBMITTED'), $filter('translate')('content.form.messages.ERRORSAREMARKED'), "error");
                 return false;
             }
             else {
                 $scope.disableSubmit = true;
                 var def = $q.defer();
                $PressReleaseSenderDataFactory.send({prId : $scope.pressRelease.id, cgIds: $scope.contactSelection}).$promise.then(function(data){
                    $scope.disableSubmit = false;
                    console.log(data);
                    if(data.sent == true){
                        toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PRESSRELEASESNT'));
                    }
                    else {
                        toaster.pop('error', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.PRESSRELEANOTSESNT'));
                    }
                    $scope.list();
                },function (error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PRESSRELEASENOTCREATED'));
                    console.warn(error);
                });
             }
             return false;
         }

         $scope.list = function(){
             $state.go('app.prmanager.pressreleases');
         }
}]);
