define(['app'], function(app) {
    app.controller('pageController', function($scope, $routeParams, $controller) {
        if ($routeParams.action == 'new') {
            $controller($routeParams.action + $routeParams.page + 'Controller', {$scope: $scope});
        } else if ($routeParams.action == 'edit' && !$routeParams.edit) {
            $controller($routeParams.action + $routeParams.page + 'Controller', {$scope: $scope, $routeParams: $routeParams});
        } else {
            $controller('list' + $routeParams.page + 'Controller', {$scope: $scope});
        }
    })
});