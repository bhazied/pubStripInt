'use strict';
app.controller('dashboardCtrl', ['$scope', '$interval', 'COLORS', '$localStorage', '$filter', 'toaster','$q','$state','$dashboardDataFactory', '$faqsDataFactory' ,  function($scope, $interval, COLORS, $localStorage, $filter, toaster, $q, $state, $dashboardDataFactory, $faqsDataFactory){
    $scope.ppr = [];
    $scope.lastppr = [];
    $scope.emails = [];
    $scope.visits = [];
    $scope.profile = {};
    $scope.faqs = [];
    $scope.allPeriode = ['all', 'last_7_days', 'today', 'last_30_days'];
    $scope.visitTotalItems = 0;
    $scope.visitCurrentPage = 1;
    $scope.visitToShow = {};
    $scope.loadPpr = function(){
        var def = $q.defer();
        if($scope.ppr.length == 0) {
            $scope.ppr.push({});
            $dashboardDataFactory.progressPr().$promise.then(function (data) {
                $scope.ppr = data.results;
            });
            def.resolve($scope.ppr);
            return def;
        }
        else{
            return $scope.ppr;
        }


    }

    $scope.loadLastPpr = function(){
        var def = $q.defer();
        if($scope.lastppr.length ==  0){
            $scope.lastppr.push({});
            $dashboardDataFactory.lastPpr().$promise.then(function (data) {
                $scope.lastppr = data.results;
            });
            def.resolve($scope.lastppr);
            return def;
        }
        else
        {
            return $scope.lastppr;
        }
    }
    
    $scope.loadVisits = function (periode) {
        var def = $q.defer();
        var params = {};
        $scope['disableVisits_'+periode] = true;
        angular.forEach($scope.allPeriode, function (value) {
            $scope['currentVisit_'+value] = false;
        });
        $scope['currentVisit_'+periode] = true;
        params.periode = periode;
            $dashboardDataFactory.loadVisits(params).$promise.then(function (data) {
                $scope['disableVisits_'+periode] = false;
                $scope.visitTotalItems = data.newsroom.length;
                $scope.visits = data.newsroom;
                $scope.visitToShow = $scope.visits[$scope.visitCurrentPage - 1];
            });
            def.resolve($scope.visits);
            return def;
    }
    
    $scope.changeNewsroomVisit = function () {
        $scope.visitToShow = $scope.visits[$scope.visitCurrentPage];
    }
    $scope.loadEmails = function (periode) {
        var def = $q.defer();
            var params = {};
            $scope['disableLoad_'+periode] = true;
        angular.forEach($scope.allPeriode, function (value) {
            $scope['currentLoad_'+value] = false;
        })
        $scope['currentLoad_'+periode] = true;
            params.periode = periode;
            $dashboardDataFactory.loadEmails(params).$promise.then(function (data) {
                $scope.emails = data;
                $scope['disableLoad_'+periode] = false;
            });
            def.resolve($scope.emails);
            return  def;
    }

    $scope.loadProfile = function(){
        var def = $q.defer();
        $dashboardDataFactory.loadProfile({locale: $localStorage.language}).$promise.then(function(data){
            $scope.profile = data;
        });
        def.resolve($scope.profile);
        return def;

    }

    $scope.loadFaqs = function () {
        var def = $q.defer();
        var params = {limit : 5};
        $faqsDataFactory.get(params).$promise.then(function (data) {
            $scope.faqs = data.results;
        });
        def.resolve($scope.faqs);
        return def;
    }

    $scope.$watch($scope.ppr, function () {
        $scope.loadLastPpr();
        $scope.loadEmails('all');
        $scope.loadVisits('all');
        $scope.loadPpr();
        $scope.loadProfile();
        $scope.loadFaqs();
    });

    $scope.pressReleaseList = function () {
        $state.go("app.prmanager.pressreleases");
    }

    $scope.editprofile = function(){
        $state.go("app.profile");
    }

}]);
