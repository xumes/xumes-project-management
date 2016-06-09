/**
 * Created by Reginaldo on 06/06/2016.
 */
angular.module('app.controllers')
    .controller('clientEditController', ['$scope', '$location', '$routeParams', 'Client', function($scope, $location, $routeParams, Client){
        $scope.client = Client.get({id: $routeParams.id })
        $scope.client.$promise.then(function(data) {
            $scope.client = data[0];

            $scope.save = function () {
                if($scope.form.$valid){
                    Client.update({id: $scope.client.id}, $scope.client, function() {
                        $location.path('/clients');
                    });

                }
            }
        });

        
    }]);

