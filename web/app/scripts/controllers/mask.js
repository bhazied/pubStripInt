'use strict';

function maskCtrl($scope) {
  $scope.maskOpt = {
    autoclear: false
  };
}

angular
  .module('publiPrApp')
  .controller('maskCtrl', ['$scope', maskCtrl]);
