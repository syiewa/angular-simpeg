// public/js/services/commentService.js
define(['angularAMD'], function(angularAMD) {
    angularAMD.factory('SessionService', function() {
        return{
            get: function(key) {
                return sessionStorage.getItem(key);
            },
            set: function(key, val) {
                return sessionStorage.setItem(key, JSON.stringify(val));
            },
            unset: function(key) {
                return sessionStorage.removeItem(key);
            }
        }
    });
});

	