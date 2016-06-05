/**
 * Created by Reginaldo on 17/04/2016.
 */
angular.module('app.controllers')
.controller('loginController', ['$scope', '$location', 'OAuth', function($scope, $location, OAuth){
    $scope.user  = {
        username: '',
            password: ''
    };

    $scope.login = function(){

        if($scope.formLogin.$valid){
            OAuth.getAccessToken($scope.user).then(function(){
                $location.path('home');
            }, function(){
                alert('Invalid credentials');
            });
        }
    };
}]);