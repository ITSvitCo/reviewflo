var ReviewfloApp = angular.module("ReviewfloApp", ["ngRoute", "ngCookies", "ngSanitize"]);

ReviewfloApp.config(['$routeProvider', '$httpProvider', function($routeProvider, $httpProvider) {
        
    $routeProvider
        .when("/login", {
            templateUrl : "app/template/login.html",
            controller : "LoginController",
        })
        //admin routes
        .when("/dashboard", {
            templateUrl : "app/template/dashboard.html",
            controller : "DashboardController",
        })
        .when("/dashboard/admins", {
            templateUrl : "app/template/admins.html",
            controller : "AdminsController",
        })
        .when("/dashboard/clients", {
            templateUrl : "app/template/clients.html",
            controller : "ClientsController",
        })
        .when("/dashboard/setting", {
            templateUrl : "app/template/setting.html",
            controller : "SettingController",
        })
        //clients routes
        .when("/cabinet", {
            templateUrl : "app/template/cabinet.html",
            controller : "CabinetController",
        })
        .otherwise('/login');

    $httpProvider
        .interceptors.push(['$q', '$location', '$cookies', function ($q, $location, $cookies) {
            return {
                'request': function (config) {
                    config.headers = config.headers || {};
                    var token = $cookies.get('token');
                    if (token) {
                        config.headers.Authorization = 'Bearer ' + token;
                    }
                    return config;
                },
                'responseError': function (response) {
                    if (response.status === 401 || response.status === 403) {
                        $cookies.remove('token');
                        $location.path('/login');
                    }
                    return $q.reject(response);
                }
            };
        }]);
}]);

// Check user authentication, if true login page is not available
ReviewfloApp.run(function($rootScope, $location, $cookies) {

  $rootScope.$on('$locationChangeStart', function(ev, next, current) {

      token= $cookies.get('token');
      if($location.$$path.search('/login') == 0){
          if(token){
              $location.path('/dashboard');
          }
      }
      
      if(!token){
          $location.path('/login');
      }

  });

});





