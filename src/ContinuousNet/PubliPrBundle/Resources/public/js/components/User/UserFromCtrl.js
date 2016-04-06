'use strict';

/**
 * Controller for User Form
 */

app.controller('UserFormCtrl', ['$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter', '$uibModal', '$q', '$interpolate', '$localStorage', 'toaster', 'SweetAlert', 'savable', '$companiesDataFactory', '$countriesDataFactory', '$languagesDataFactory', '$usersDataFactory',
function($scope, $state, $stateParams, $sce, $timeout, $filter, $uibModal, $q, $interpolate, $localStorage, toaster, SweetAlert, savable, $companiesDataFactory, $countriesDataFactory, $languagesDataFactory, $usersDataFactory) {

    $scope.locale = (angular.isDefined($localStorage.language))?$localStorage.language:'en';

    $scope.disableSubmit = false;

    // Editor options.
    $scope.editorOptions = {
        language: $scope.locale,
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReadyEditor = function () {
        
    };

    $scope.types = [{
        id: 'Free',
        title: $filter('translate')('content.list.fields.types.FREE'),
        css: 'info'
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
        css: 'inverse'
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

    $scope.birthDateOpened = false;
    $scope.birthDateToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.birthDateOpened = !$scope.birthDateOpened;
    };
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
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_API'),
        css: 'info'
    }, {
        id: 'FREE_ACCOUNT',
        title: $filter('translate')('content.list.fields.rolesoptions.FREE_ACCOUNT'),
        css: 'success'
    }, {
        id: 'ROLE_ACCOUNT_MANAGER',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_ACCOUNT_MANAGER'),
        css: 'warning'
    }, {
        id: 'ROLE_CONTRIBUTOR_ACCOUNT',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_CONTRIBUTOR_ACCOUNT'),
        css: 'inverse'
    }, {
        id: 'ROLE_SUPER_ADMIN',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_SUPER_ADMIN'),
        css: 'danger'
    }];

    $scope.passwordRequestedAtOpened = false;
    $scope.passwordRequestedAtToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.passwordRequestedAtOpened = !$scope.passwordRequestedAtOpened;
    };

    $scope.expiresAtOpened = false;
    $scope.expiresAtToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.expiresAtOpened = !$scope.expiresAtOpened;
    };

    $scope.credentialsExpireAtOpened = false;
    $scope.credentialsExpireAtToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.credentialsExpireAtOpened = !$scope.credentialsExpireAtOpened;
    };

    $scope.lastLoginOpened = false;
    $scope.lastLoginToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.lastLoginOpened = !$scope.lastLoginOpened;
    };

    $scope.lastFailedLoginOpened = false;
    $scope.lastFailedLoginToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.lastFailedLoginOpened = !$scope.lastFailedLoginOpened;
    };

    $scope.dateFormat = $filter('translate')('formats.DATE');
    $scope.dateTimeFormat = $filter('translate')('formats.DATETIME');
    $scope.timeFormat = $filter('translate')('formats.TIME');
    $scope.minDate = new Date(2010, 0, 1);
    $scope.maxDate = new Date(2050, 11, 31);
    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    $scope.disabled = function (date, mode) {
        return (mode === 'day' && (date.getDay() === -1));
    };
    $scope.companies = [];
    $scope.companiesLoaded = false;

    $scope.getCompanies = function() {
        $timeout(function(){
            $scope.companiesLoaded = true;
            if ($scope.companies.length == 0) {
                $scope.companies.push({});
                var def = $q.defer();
                $companiesDataFactory.query({offset: 0, limit: 10000, 'order_by[company.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.companies = data.results;
                    def.resolve($scope.companies);
                });
                return def;
            } else {
                return $scope.companies;
            }
        });
    };

    $scope.getCompanies();

    $scope.countries = [];
    $scope.countriesLoaded = false;

    $scope.getCountries = function() {
        $timeout(function(){
            $scope.countriesLoaded = true;
            if ($scope.countries.length == 0) {
                $scope.countries.push({});
                var def = $q.defer();
                $countriesDataFactory.query({offset: 0, limit: 10000, 'order_by[country.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.countries = data.results;
                    def.resolve($scope.countries);
                });
                return def;
            } else {
                return $scope.countries;
            }
        });
    };

    $scope.getCountries();

    $scope.changeCountry = function() {
        for (var i=0;i<$scope.cities.length;i++) {
            for (var j=0;j<$scope.countries.length;j++) {
                if ($scope.countries[j].id == $scope.user.country) {
                    if (($scope.cities[i].country != null && $scope.cities[i].country.id == $scope.countries[j].id)) {
                        $scope.cities[i].hidden = false;
                    } else {
                        $scope.cities[i].hidden = true;
                    }
                }
            }
        }
    };
    
    $scope.languages = [];
    $scope.languagesLoaded = false;

    $scope.getLanguages = function() {
        $timeout(function(){
            $scope.languagesLoaded = true;
            if ($scope.languages.length == 0) {
                $scope.languages.push({});
                var def = $q.defer();
                $languagesDataFactory.query({offset: 0, limit: 10000, 'order_by[language.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.languages = data.results;
                    def.resolve($scope.languages);
                });
                return def;
            } else {
                return $scope.languages;
            }
        });
    };

    $scope.getLanguages();

    $scope.users = [];
    $scope.usersLoaded = false;

    $scope.getUsers = function() {
        $timeout(function(){
            $scope.usersLoaded = true;
            if ($scope.users.length == 0) {
                $scope.users.push({});
                var def = $q.defer();
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.id]': 'desc'}).$promise.then(function(data) {
                    for (var i in data.results) {
                        data.results[i].hidden = false;
                    }
                    $scope.users = data.results;
                    def.resolve($scope.users);
                });
                return def;
            } else {
                return $scope.users;
            }
        });
    };

    $scope.getUsers();



    $scope.submitForm = function(form) {
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
        } else {
            if ($scope.user.id > 0) {
                $scope.disableSubmit = true;
                $usersDataFactory.update($scope.user).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.USERUPDATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.USERNOTUPDATED'));
                    console.warn(error);
                });
            } else {
                $scope.disableSubmit = true;
                $usersDataFactory.create($scope.user).$promise.then(function(data) {
                    $scope.disableSubmit = false;
                    toaster.pop('success', $filter('translate')('content.common.NOTIFICATION'), $filter('translate')('content.list.USERCREATED'));
                    $scope.list();
                }, function(error) {
                    $scope.disableSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.USERNOTCREATED'));
                    console.warn(error);
                });
            }
            return false;
        }
    };

    $scope.list = function() {
        $state.go('app.access.users');
    };
    
    if (angular.isDefined($stateParams.id)) {
        $usersDataFactory.get({id: $stateParams.id}).$promise.then(function(data) {
            $timeout(function(){
                $scope.user = savable(data);
                //console.warn($scope.user);
            });
        });
    } else {
        $scope.user = {id: 0, type: 'Free', gender: 'Male', authentication_mode: 'Database'};

    }

    $scope.showFileManager = function(field) {
    
        var modalInstance = $uibModal.open({
            templateUrl: '/bundles/publipr/js/common/FileManager/modal_content.html',
            controller: 'FileManagerCtrl',
            size: 'lg',
            resolve: {
                field: function() {
                    return field;
                },
                value: function() {
                    return $scope.user[field];
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.user[field] = url;
        }, function () {
            
        });
    
    };

}]);

