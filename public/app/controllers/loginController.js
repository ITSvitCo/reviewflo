angular.module('ReviewfloApp').controller('LoginController', [
    '$scope',
    '$location',
    '$http',
    '$cookies',
    function($scope, $location, $http, $cookies){
        var loginBody = angular.element( document.body );
        loginBody.addClass('login');
    }
]);