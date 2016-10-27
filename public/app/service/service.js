angular.module('ReviewfloApp').service('admin', ['$http', function($http) {
    
    var getAdmins = function () {
        return $http.get('/api/admins').success(function(data) {
            return data;
        });
    };
    return {
        getAdmins : getAdmins,
    };
}]);