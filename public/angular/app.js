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
//                .when("/statuspegawai", angularAMD.route({
//                    templateUrl: "view/statuspegawai/list.html",
//                    controller: "listStatusController",
//                    controllerUrl: 'statuspegawai/statusPegawaiModul'
//                }))
//                // route url untuk menambahkan data baru
//                .when("/statuspegawai/new", angularAMD.route({
//                    templateUrl: "view/statuspegawai/new.html",
//                    controller: "newStatusController",
//                    controllerUrl: 'statuspegawai/statusPegawaiModul'
//                }))
//                // route url untuk edit data dengan parameter statusId
//                .when("/statuspegawai/edit/:statusId", angularAMD.route({
//                    templateUrl: "view/statuspegawai/new.html",
//                    controller: "editStatusController",
//                    controllerUrl: 'statuspegawai/statusPegawaiModul'
//                }))
//                .when("/golongan", angularAMD.route({
//                    templateUrl: "view/golongan/list.html",
//                    controller: "listGolonganController",
//                    controllerUrl: 'golongan/golonganModul'
//                }))
//                // route url untuk menambahkan data baru
//                .when("/golongan/new", angularAMD.route({
//                    templateUrl: "view/golongan/new.html",
//                    controller: "newGolonganController",
//                    controllerUrl: 'golongan/golonganModul'
//                }))
//                // route url untuk edit data dengan parameter statusId
//                .when("/golongan/edit/:statusId", angularAMD.route({
//                    templateUrl: "view/golongan/new.html",
//                    controller: "editGolonganController",
//                    controllerUrl: 'golongan/golonganModul'
//                }))
//                .when("/eselon", angularAMD.route({
//                    templateUrl: "view/eselon/list.html",
//                    controller: "listEselonController",
//                    controllerUrl: 'eselon/eselonModul'
//                }))
//                // route url untuk menambahkan data baru
//                .when("/eselon/new", angularAMD.route({
//                    templateUrl: "view/eselon/new.html",
//                    controller: "newEselonController",
//                    controllerUrl: 'eselon/eselonModul'
//                }))
//                // route url untuk edit data dengan parameter statusId
//                .when("/eselon/edit/:statusId", angularAMD.route({
//                    templateUrl: "view/eselon/new.html",
//                    controller: "editEselonController",
//                    controllerUrl: 'eselon/eselonModul'
//                }))
//                .when("/unitkerja", angularAMD.route({
//                    templateUrl: "view/satker/list.html",
//                    controller: "listUnitKerjaController",
//                    controllerUrl: 'unitkerja/unitkerjaModul'
//                }))
//                // route url untuk menambahkan data baru
//                .when("/unitkerja/new", angularAMD.route({
//                    templateUrl: "view/unitkerja/new.html",
//                    controller: "newUnitKerjaController",
//                    controllerUrl: 'unitkerja/unitkerjaModul'
//                }))
//                // route url untuk edit data dengan parameter statusId
//                .when("/unitkerja/edit/:statusId", angularAMD.route({
//                    templateUrl: "view/unitkerja/new.html",
//                    controller: "editUnitKerjaController",
//                    controllerUrl: 'unitkerja/unitkerjaModul'
//                }))
//                .when("/satker", angularAMD.route({
//                    templateUrl: "view/satker/list.html",
//                    controller: "listSatkerController",
//                    controllerUrl: 'satker/satkerModul'
//                }))
//                // route url untuk menambahkan data baru
//                .when("/satker/new", angularAMD.route({
//                    templateUrl: "view/satker/new.html",
//                    controller: "newSatkerController",
//                    controllerUrl: 'satker/satkerModul'
//                }))
//                // route url untuk edit data dengan parameter statusId
//                .when("/satker/edit/:statusId", angularAMD.route({
//                    templateUrl: "view/satker/new.html",
//                    controller: "editSatkerController",
//                    controllerUrl: 'satker/satkerModul'
//                }))
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