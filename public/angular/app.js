//var app = angular.module("myApp", ['routes','filter','statusPegawaiModul','golonganModul']); // load aplikasi dengan nama myApp dan plugin ngRoute dan ui.bootstrap
define(['angularAMD', 'angular-route', 'ui-bootstrap', 'ngScrollSpy', 'services/dataServices'], function(angularAMD) {
    var app = angular.module("webapp", ['ngRoute', 'ui.bootstrap', 'ngScrollSpy']);
    var loginRequired = function($location, $q) {
        var deferred = $q.defer();
        var userIsAuthenticated = function() {
            return true;
        }

        if (!userIsAuthenticated()) {
            deferred.reject()
            $location.path('/');
        } else {
            deferred.resolve()
        }

        return deferred.promise;
    }
    app.config(function($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(true);
        $routeProvider
                .when("/", angularAMD.route({
                    templateUrl: "view/pegawai/list.html",
                    controller: "listpegawaiController",
                    controllerUrl: 'pegawai/pegawaiModul'
                }))
                .when("/backend/pegawai/edit/:id/:data", angularAMD.route({
                    templateUrl: "view/pegawai/new.html",
                    controller: 'editpegawaiController',
                    controllerUrl: 'services/pegawai'
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
    app.directive('ngHeader', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/templates/header.html'
        }
    });
    app.directive('ngFooter', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/templates/footer.html'
        }
    });
    return angularAMD.bootstrap(app);
});