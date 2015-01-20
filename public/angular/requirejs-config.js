var requirejsConfig = {
    baseUrl: '.',
    paths: {
        'angular': [
            '//ajax.googleapis.com/ajax/libs/angularjs/1.2.11/angular.min',
            'angular/angular'
        ],
        'angular-route':
                'angular/services/angular-route.min',
        'ui-bootstrap':
                'angular/services/ui-bootstrap-tpls-0.12.0.min'
        ,
    },
    shim: {
        'angular': {
            'exports': 'angular'
        },
        'angular-route': {
            deps: ['angular']
        },
        'ui-bootstrap': {
            deps: ['angular']
        }
    }
};