'use_strict'

app.controller('PressReleaseStatsCtrl', ['$rootScope','$scope', '$state', '$stateParams', '$sce', '$timeout', '$filter','toaster','SweetAlert', '$q', '$interpolate', '$localStorage', '$pressReleasesDataFactory','$PressReleaseStatsDataFactory', 'highchartsNG','$PressReleaseEmailStatsDataFactory','ngTableParams',
    function( $rootScope,$scope, $state, $stateParams, $sce, $timeout, $filter, toaster, SweetAlert, $q, $interpolate, $localStorage, $pressReleasesDataFactory , $PressReleaseStatsDataFactory, highchartsNG, $PressReleaseEmailStatsDataFactory, ngTableParams) {


        $scope.startDateOpened = false;
        $scope.startDateToggle = function($event){
            $event.preventDefault();
            $event.stopPropagation();
            $scope.startDateOpened = !$scope.startDateOpened;
        }
        $scope.endDateOpened = false;
        $scope.endDateToggle = function($event){
            $event.preventDefault();
            $event.stopPropagation();
            $scope.endDateOpened = !$scope.endDateOpened;
        }
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

        if(angular.isDefined($stateParams.id)) {
            $scope.prId = $stateParams.id;
        }
        $scope.sendStats = [];
        $scope.statsLoaded = false;
        $scope.getStats = function(){
            if(angular.isDefined($stateParams.id)){
                $scope.prId = $stateParams.id;
                $timeout(function () {
                    $scope.statsLoaded = true;
                    if($scope.sendStats.length == 0){
                        $scope.sendStats.push({});
                        var def = $q.defer();
                        $PressReleaseStatsDataFactory.stats({
                            prId : $stateParams.id
                        }).$promise.then(function(data){
                            $scope.sendStats = data;
                            $scope.initChart(data);
                            def.resolve($scope.sendStats)
                        });
                        return def;
                    }
                    else {
                        return  $scope.sendStats;
                    }
                });
            }else
            {
                return [];
            }
        }

        $scope.getStats();
        $scope.loadedSearchedData = false;
        $scope.searchStatData = [];
        $scope.submitForm = function(form){
            if(form.$invalid)
            {
                var field = null;
                var firstError = null;
                for(field in form){
                    if(field[0] != '$'){
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
            else{
                $scope.loadedSearchedData = true;
                $scope.disabledSubmit = true;
                $search = {
                    start_date : $scope.start_date,
                    end_date   : $scope.end_date,
                    prId       : $scope.prId
                };
                var def = $q.defer();
                $PressReleaseStatsDataFactory.stats($search).$promise.then(function(data){
                    $scope.disabledSubmit = false;
                    $scope.searchStatData = data;
                    //def.resolve($scope.searchStatData);
                    $scope.searchedChart(data);
                },(function (error)
                {
                    $scope.disabledSubmit = false;
                    toaster.pop('error', $filter('translate')('content.common.ERROR'), $filter('translate')('content.list.PRESSRELEASENOTUPDATED'));
                    console.warn(error);
                }));

            }
        }

        $scope.searchedChart = function(data)
        {

        }

        $scope.initChart = function(data){
            $scope.chartinit = {
                options: {
                    chart: {
                        type: 'column'
                    }
                },
                title: {
                    text: $filter('translate')('content.list.PRESSRELEASESEARSHSTATS')
                },
                xAxis: {
                    //categories: ['semaine A', 'semaine B', 'semaine C', 'semaine D', 'semaine E']
                    categories: data.periode
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: $filter('translate')('content.list.PRESSRELEASELOG')
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                            style: {
                                textShadow: '0 0 3px black'
                            }
                        }
                    }
                },
                series : data.result
            }
        }
        //$scope.seachChart();
       /* $scope.test = function () {
            $PressReleaseEmailStatsDataFactory.statsEmail({prId:$stateParams.id}).$promise.then(function (data) {
                console.log(data);
            });
        }
        $scope.test();*/

        $scope.setEmailStats = function(start_date, end_date){

            $scope.tableParams = new ngTableParams({
                page:1,
                count: 50,
            },
                {
                    getData: function (params) {
                        http_params = {
                            offset : (params.page()-1) * params.count(),
                            limit: params.count()
                        }
                        if(angular.isDefined(start_date)){
                            http_params.start_date = start_date;
                        }
                        if(angular.isDefined(end_date)){
                            http_params.end_date = end_date;
                        }
                        if(angular.isDefined($stateParams.id) || angular.isDefined($scope.prId)){
                            http_params.prId = $scope.prId;
                        }
                        return $PressReleaseEmailStatsDataFactory.statsEmail(http_params).$promise.then(function(){
                            console.log(data);
                        });
                    }
                });
        }
        $scope.setEmailStats();
    }]);