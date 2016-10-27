angular.module('ReviewfloApp').controller('DashboardController', [
    '$scope',
    '$location',
    '$http',
    '$timeout',
    '$cookies',
    'admin',
    function($scope, $location, $http, $timeout, $cookies, admin){

       var adminList = admin.getAdmins();
       console.log(adminList);
    }
]);