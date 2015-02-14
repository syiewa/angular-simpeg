//var app = angular.module("myApp", ['routes','filter','statusPegawaiModul','golonganModul']); // load aplikasi dengan nama myApp dan plugin ngRoute dan ui.bootstrap
define(['angularAMD', 'angular-route', 'ui-bootstrap', 'ngScrollSpy', 'angularFileUploadShim', 'angularFileUpload', 'services/dataServices', 'services/Login', 'services/SessionServices'], function(angularAMD) {
    var app = angular.module("webapp", ['ngRoute', 'ui.bootstrap', 'ngScrollSpy', 'angularFileUpload']);
    var loginRequired = function($location, $q, SessionService) {
        var deferred = $q.defer();
        var userIsAuthenticated = function() {
            return SessionService.get('auth');
        }
        if (!userIsAuthenticated()) {
            deferred.reject()
            $location.path('/');
        } else {
            deferred.resolve();
        }
        return deferred.promise;
    }
    app.config(function($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(true);
        $routeProvider
                .when("/", angularAMD.route({
                    templateUrl: "view/templates/home.html",
                    controller: "homeController",
                    controllerUrl: 'home/homeModul',
                }))
                .when("/backend/pegawai/edit/:id/:data", angularAMD.route({
                    templateUrl: "view/pegawai/new.html",
                    controller: 'editpegawaiController',
                    controllerUrl: 'services/pegawai',
                    resolve: {loginRequired: loginRequired}
                }))
                .when("/backend/:page", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/list.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices',
                    resolve: {loginRequired: loginRequired}
                }))
                .when("/backend/:page/:action", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices',
                    resolve: {loginRequired: loginRequired}
                }))
                .when("/backend/:page/:action/:id", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices',
                    resolve: {loginRequired: loginRequired}
                }))
                .when("/backend/:page/:action/:id/:subaction", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices',
                    resolve: {loginRequired: loginRequired}
                }))
                .when("/backend/:page/:action/:id/:subaction/:subid", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices',
                    resolve: {loginRequired: loginRequired}
                }))
                .otherwise({
                    redirectTo: "/"
                });
    });

    app.filter('labelCase', function() {
        return function(input) {
            input = input.replace(/_/g, ' ');
            return input[0].toUpperCase() + input.slice(1);
        };
    });
    app.directive('ngHeader', function(SessionService, $location, Login, $templateCache) {
        return {
            restrict: 'E',
            templateUrl: 'view/templates/header.html',
            controller: function($scope, $location, Login, SessionService, $window) {
                $scope.auth = SessionService.get('auth');
                $scope.user = JSON.parse(SessionService.get('data'));

                $scope.logout = function() {
                    Login.logout().success(function(response) {
                        if (response.success) {
                            SessionService.unset('auth');
                            SessionService.unset('data');
                            $templateCache.removeAll();
                            window.location.replace('/');
                        }
                    });
                }
            },
        }
    });
    app.directive('ngFooter', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/templates/footer.html',
        }
    });
    return angularAMD.bootstrap(app);
});