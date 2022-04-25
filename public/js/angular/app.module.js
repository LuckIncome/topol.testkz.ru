var topol = angular.module('topol', [
    'ui.bootstrap'
])
    .config(function ($locationProvider) {
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false,
            rewriteLinks: false
        });
    }).run(function ($http) {
        $http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
        $http.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
    });
