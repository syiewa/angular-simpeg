// public/js/services/commentService.js
define(['angularAMD'], function(angularAMD) {
    angularAMD.factory('dataService', function($http) {
        return {
            // get all the comments
            get: function(url) {
                return $http.get(url);
            },
            edit: function(url, id) {
                return $http.get(url + '/' + id + '/edit');
            },
            // save a comment (pass in comment data)
            save: function(url, data) {
                return $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },
            // update 
            update: function(url, id, data) {
                return $http.patch(url + '/' + id, data);

            },
            // destroy a comment
            destroy: function(url, id) {
                return $http.delete(url + '/' + id);
            }
        }

    });
});

	