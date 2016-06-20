'use strict';
app.controller('dashboardCtrl', ['$scope', '$interval', 'COLORS', '$localStorage', '$filter', 'toaster','$q','$state','$dashboardDataFactory', function($scope, $interval, COLORS, $localStorage, $filter, toaster, $q, $state, $dashboardDataFactory){
    $scope.ppr = [];
    $scope.lastppr = [];
    $scope.emails = [];
    $scope.visits = [];
    $scope.profilInformation = {};

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
        if(periode != 'all')
        {
            $scope['disableVisits_'+periode] = true;
        }
        params.periode = periode;
            $dashboardDataFactory.loadVisits(params).$promise.then(function (data) {
                $scope.visits = data;
                $scope['disableVisits_'+periode] = false;
            });
            def.resolve($scope.visits);
            return def;
    }
    
    $scope.loadEmails = function (periode) {
        var def = $q.defer();
            var params = {};
            if(periode != 'all')
            {
                $scope['disableLoad_'+periode] = true;
            }
            params.periode = periode;
            $dashboardDataFactory.loadEmails(params).$promise.then(function (data) {
                $scope.emails = data;
                $scope['disableLoad_'+periode] = false;
            });
            def.resolve($scope.emails);
            return  def;
    }

    $scope.$watch($scope.ppr, function () {
        $scope.loadLastPpr();
        $scope.loadEmails('all');
        $scope.loadVisits('all');
    })
    $scope.loadPpr();

    $scope.pressReleaseList = function () {
        $state.go("app.prmanager.pressreleases");
    }

}]);
