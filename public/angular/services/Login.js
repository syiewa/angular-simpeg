// public/js/services/commentService.js
define(['angularAMD'], function(angularAMD) {
    angularAMD.factory('Login', function($http) {
        return{
            auth: function(credentials) {
                var authUser = $http({method: 'POST', url: 'login/auth', params: credentials});
                return authUser;
            },
            logout: function(){
                var logout = $http({method:'GET',url: 'login/destroy'});
                return logout;
            }
        }
    });
});

	