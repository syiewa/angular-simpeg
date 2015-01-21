//var app = angular.module("myApp", ['routes','filter','statusPegawaiModul','golonganModul']); // load aplikasi dengan nama myApp dan plugin ngRoute dan ui.bootstrap
define(['angularAMD', 'angular-route', 'ui-bootstrap', 'services/dataServices'], function(angularAMD) {
    var app = angular.module("webapp", ['ngRoute', 'ui.bootstrap']);
    app.config(function($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(true);
        $routeProvider
                .when("/", angularAMD.route({
                    templateUrl: "view/statuspegawai/list.html",
                    controller: "liststatuspegawaiController",
                    controllerUrl: 'statuspegawai/statusPegawaiModul'
                }))
                .when("/:page", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/list.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices'
                }))
                .when("/:page/:action", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices'
                }))
                .when("/:page/:action/:id", angularAMD.route({
                    templateUrl: function(page) {
                        return "view/" + page.page + "/new.html";
                    },
                    controller: 'pageController',
                    controllerUrl: 'services/pageServices'
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