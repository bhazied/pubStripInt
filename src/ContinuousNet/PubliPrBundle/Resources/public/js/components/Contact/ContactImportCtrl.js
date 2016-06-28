'use strict';

/**
 * Controller for Contact Importer
 */

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            element.bind('change', function() {
                scope.$apply(function() {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, data, success, error) {
        var formData = new FormData();
        for (var key in data) {
            formData.append(key, data[key]);
        }
        formData.append('file', file);
        $http.post(uploadUrl, formData, {
            transformRequest: angular.identity,
            headers: {
                'Content-Type': undefined
            }
        })
        .success(success)
        .error(error);
    }
}]);

app.controller('ContactImportCtrl', ['$scope', '$rootScope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$q', '$interpolate', '$localStorage', 'toaster', '$contactsDataFactory', '$contactGroupsDataFactory', 'SweetAlert', 'fileUpload',
    function($scope, $rootScope, $state, $stateParams, $sce, $timeout, $filter, $q, $interpolate, $localStorage, toaster, $contactsDataFactory, $contactGroupsDataFactory, SweetAlert, fileUpload) {

        $scope.allowedExtensions = ['xls', 'xlsx'];
        $scope.contactGroups = [];
        $scope.contactGroupsLoaded = false;
        $scope.file = '';
        $scope.contact = {
            first_name: 1,
            last_name: 2,
            email: 3,
            phone: 4
        };

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
                        data.results.push({
                            id: -1,
                            name: $filter('translate')('content.common.CREATENEW'),
                            hidden: false
                        });
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
            var firstError = null;
            if (form.$invalid || typeof  $scope.file.name == 'undefined') {
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
            } else {

                var fileName = $scope.file.name.toLowerCase();
                var extension = fileName.split('.').pop();
                if (fileName == extension) {
                    extension = '';
                }

                if ($scope.allowedExtensions.indexOf(extension) > -1) {

                    $scope.disableSubmit = true;

                    SweetAlert.swal({
                        title: $filter('translate')('content.common.AREYOUSURE'),
                        text: $filter('translate')('content.list.YOUHAVEPERMISSIONTOSENEMAILSTOTHISCONTACTS'),
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: $filter('translate')('content.common.YESIHAVE'),
                        cancelButtonText: $filter('translate')('content.common.NOCANCEL'),
                        closeOnConfirm: true,
                        closeOnCancel: false,
                        showLoaderOnConfirm: true
                    }, function (isConfirm) {

                        if (isConfirm) {

                            fileUpload.uploadFileToUrl($scope.file, $rootScope.app.apiURL + 'contactsImport', $scope.contact, function (data, status, headers) {
                                $scope.disableSubmit = false;
                                if (status == 200) {
                                    /*SweetAlert.swal({
                                        title: $filter('translate')('content.common.NOTIFICATION'),
                                        text: data.message,
                                        type: 'success'
                                    });*/
                                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), data.message);
                                    $scope.list();
                                } else {
                                    /*SweetAlert.swal({
                                        title: $filter('translate')('content.common.ERROR'),
                                        text: $filter('translate')('content.list.NODATATOIMPORT'),
                                        type: 'error'
                                    });*/
                                    toaster.pop('warning', $filter('translate')('content.common.ERROR'), $filter('translate')('content.form.messages.NODATATOIMPORT'));
                                    $scope.list();
                                }
                            }, function (data, status) {
                                $scope.disableSubmit = false;
                                /*SweetAlert.swal({
                                    title: $filter('translate')('content.common.ERROR'),
                                    text: $filter('translate')('content.list.DATANOTIMPORTED'),
                                    type: 'error'
                                });*/
                                toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.form.messages.DATANOTIMPORTED'));
                                console.warn(error)
                                $scope.list();
                            });

                        } else {
                            $scope.disableSubmit = false;
                            /*SweetAlert.swal({
                                title: $filter('translate')('content.common.CANCELLED'),
                                text: $filter('translate')('content.list.CONTACTSNOTDIMPORTED'),
                                type: 'error',
                                confirmButtonColor: '#007AFF'
                            });*/
                            toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.CONTACTSNOTDIMPORTED'));
                            $scope.list();
                        }
                    });

                } else {
                    toaster.pop('warning', $filter('translate')('content.common.ERROR'), $filter('translate')('content.form.messages.ALLOWEDFILEEXTENSIONS') + ' (' + $scope.allowedExtensions.join(', ') + ')');
                    $scope.list();
                }
                return false;

            }

        };

        $scope.list = function(){
            $state.go('app.contactmanager.contacts');
        }

    }]);

