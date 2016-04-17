/**
 * Created by Reginaldo on 17/04/2016.
 */
angular.module('app.controllers')
.controller('loginController', ['$scope', function($scope){
    $scope.user  = {
        username: '',
            password: ''
    };

    $scope.login = function(){

    };
}]);