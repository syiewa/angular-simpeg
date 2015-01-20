var app = angular.module('filter',[]);
app.filter('labelCase', function() {
    return function(input) {
        input = input.replace(/_/g, ' ');
        return input[0].toUpperCase() + input.slice(1);
    };
});