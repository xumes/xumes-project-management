/**
 * Created by Reginaldo on 06/06/2016.
 */
angular.module('app.controllers')
    .controller('clientListController', ['$scope', 'Client', function($scope, Client){
        $scope.clients  = Client.query();


    }]);