/**
 * Created by Reginaldo on 06/06/2016.
 */
angular.module('app.controllers')
    .controller('clientRemoveController', ['$scope', '$location', '$routeParams', 'Client', function($scope, $location, $routeParams, Client){
        $scope.client = Client.get({id: $routeParams.id })
        $scope.client.$promise.then(function(data) {
            $scope.client = data[0];

            $scope.remove = function () {
                $scope.client.$delete().then(function(){
                    $location.path('/clients');
                });
            }
        });

        
    }]);

