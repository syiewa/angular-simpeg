define(['app'], function(app) {
    app.controller('homeController', function($scope, Login, SessionService, $location, $window) {
        $scope.loginSubmit = function() {
            var auth = Login.auth($scope.loginData);
            auth.success(function(response) {
                if (response.id) {
                    SessionService.set('auth', true); //This sets our session key/val pair as authenticated
                    SessionService.set('data', response);
                    window.location.replace('backend/pegawai');
                } else
                    alert(response);
            });
        }
    });
});