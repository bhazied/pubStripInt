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

    $scope.birthDateOpened = false;
    $scope.birthDateToggle = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.birthDateOpened = !$scope.birthDateOpened;
    };
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
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_API'),
        css: 'primary'
    }, {
        id: 'ROLE_ACCOUNT_USER',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_ACCOUNT_USER'),
        css: 'success'
    }, {
        id: 'FREE_ACCOUNT',
        title: $filter('translate')('content.list.fields.rolesoptions.FREE_ACCOUNT'),
        css: 'warning'
    }, {
        id: 'ROLE_ACCOUNT_MANAGER',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_ACCOUNT_MANAGER'),
        css: 'danger'
    }, {
        id: 'ROLE_ADMIN',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_ADMIN'),
        css: 'default'
    }, {
        id: 'ROLE_SUPER_ADMIN',
        title: $filter('translate')('content.list.fields.rolesoptions.ROLE_SUPER_ADMIN'),
        css: 'info'
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
                $companiesDataFactory.query({offset: 0, limit: 10000, 'order_by[company.name]': 'asc'}).$promise.then(function(data) {
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
                $countriesDataFactory.query({offset: 0, limit: 10000, 'order_by[country.name]': 'asc'}).$promise.then(function(data) {
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
                $languagesDataFactory.query({offset: 0, limit: 10000, 'order_by[language.name]': 'asc'}).$promise.then(function(data) {
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
                $usersDataFactory.query({offset: 0, limit: 10000, 'order_by[user.username]': 'asc'}).$promise.then(function(data) {
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
                if ($scope.user.birth_date != null) {
                    $scope.user.birth_date = new Date($scope.user.birth_date);
                }
                if ($scope.user.password_requested_at != null) {
                    $scope.user.password_requested_at = new Date($scope.user.password_requested_at);
                }
                if ($scope.user.expires_at != null) {
                    $scope.user.expires_at = new Date($scope.user.expires_at);
                }
                if ($scope.user.credentials_expire_at != null) {
                    $scope.user.credentials_expire_at = new Date($scope.user.credentials_expire_at);
                }
                if ($scope.user.last_login != null) {
                    $scope.user.last_login = new Date($scope.user.last_login);
                }
                if ($scope.user.last_failed_login != null) {
                    $scope.user.last_failed_login = new Date($scope.user.last_failed_login);
                }
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
                },
                instance: function() {
                    return 'default';
                },
                folder: function() {
                    var company = '00000' + $localStorage.user.company;
                    company = company.substr(company.length - 5);
                    var user_ = '';
                    if ($scope.user.id != 0) {
                        user_ = '00000' + $scope.user.id;
                        user_ = user_.substr(user_.length - 5);
                        user_ = '/user_'+user_;
                    }
                    return 'companies/company_'+company+user_;
                }
            }
        });

        modalInstance.result.then(function (url) {
            $scope.user[field] = url;
        }, function () {
            
        });
    
    };

}]);

