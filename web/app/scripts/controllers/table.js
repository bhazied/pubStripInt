'use strict';

function tableCtrl($scope) {
  $scope.dataTableOpt = {
    'ajax': 'data/datatables-arrays.json'
  };
}

angular
  .module('publiPrApp')
  .controller('tableCtrl', ['$scope', tableCtrl]);
