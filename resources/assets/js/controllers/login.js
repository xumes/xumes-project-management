/**
 * Created by Reginaldo on 17/04/2016.
 */
angular.module('app.controllers')
.controller('loginController', ['$scope', '$location', 'OAuth', function($scope, $location, OAuth){
    $scope.user  = {
        username: '',
            password: ''
    };

    $scope.error = {
        message: '',
        error: false
    }

    $scope.login = function(){

        if($scope.formLogin.$valid){
            OAuth.getAccessToken($scope.user).then(function(){
                $location.path('home');
            }, function(data){
                $scope.error.error=true;
                $scope.error.message = data.data.error_description;
            });
        }
    };
}]);