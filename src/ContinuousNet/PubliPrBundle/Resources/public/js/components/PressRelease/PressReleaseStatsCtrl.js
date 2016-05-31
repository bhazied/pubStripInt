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
                            $scope.pieChart(data);
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
        $scope.resetOn = false;
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
                $scope.resetOn = true;
                $scope.loadedSearchedData = true;
                $scope.disableSubmit = true;
                //var def = $q.defer();
                $scope.setEmailStats($scope.start_date, $scope.end_date);
                //$scope.disableSubmit = false;
                return false;
            }
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

        $scope.pieChart = function(pieData){
            $scope.chartpie = {
                options: {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        height : 350
                    }
                },
                title: {
                    text: $filter('translate')('content.list.PRESSRELEASEPIECHARTTITLE')
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true
                        },
                        showInLegend: true
                    }
                },
                series:[{
                    name: 'Emails',
                    colorByPoint: true,
                    data:[{
                        name : $filter('translate')('content.list.fields.OPENS'),
                        y: pieData.total_opens,
                        sliced: true,
                        selected: true
                    },{
                        name : $filter('translate')('content.list.fields.SENT'),
                        y: pieData.total_sent
                    },{
                        name : $filter('translate')('content.list.fields.CLICKS'),
                        y: pieData.total_clicks
                    }]
                }]
            }
        }
        //$scope.seachChart();
        $scope.setCols = function(){
            $scope.cols = [
                {field: 'email', title:$filter('translate')('content.list.fields.EMAIL'), show:true },
                {field: 'sent_date', title:$filter('translate')('content.list.fields.SENTDATE'), show:true},
                {field: 'opens', title:$filter('translate')('content.list.fields.OPENS'), show:true},
                {field: 'state', title:$filter('translate')('content.list.fields.STATE'), show:true},
                {field: 'clicks', title:$filter('translate')('content.list.fields.CLICKS'), show:true}
            ];
        };
        $scope.setCols();
        $scope.setEmailStats = function(start_date, end_date){
            console.log(start_date, end_date);
            $scope.tableParams = new ngTableParams({
                page:1,
                count: 10,
            },
                {
                    getData: function ($defer, params) {
                        http_params = {
                            offset : (params.page()-1) * params.count(),
                            limit: params.count()
                        }
                        if(angular.isDefined(start_date)){
                            http_params.start_date = start_date;
                        }
                        else{
                            http_params.start_date = $filter('date')(new Date(moment().subtract(1, 'month')), $filter('translate')('formats.DATE'));
                        }
                        if(angular.isDefined(end_date)){
                            http_params.end_date = end_date;
                        }
                        else{
                            http_params.end_date = $filter('date')(new Date(), $filter('translate')('formats.DATE') );
                        }
                        if(angular.isDefined($stateParams.id) || angular.isDefined($scope.prId)){
                            http_params.prId = $scope.prId;
                        }
                        return $PressReleaseEmailStatsDataFactory.statsEmail(http_params).$promise.then(function(data){
                           params.total(data.inlineCount);
                             return data.results;
                        });
                    }
                });
            $scope.disableReset = false;
            $scope.disableSubmit = false;
        }
        $scope.resetSearch = function(){
            if($scope.resetOn){
                $scope.disableReset = true;
                $scope.setEmailStats();
            }
            return false;
        }

        $scope.setEmailStats();
    }]);