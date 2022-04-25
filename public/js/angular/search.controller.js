(function (topol) {
    "use strict";
    topol.controller('SearchController',['$scope','Api',function ($scope, Api) {
        var sc = {
            searchItems: [],
            searchByInput: function (input) {
                if (input.length < 2) return;
                Api.searchByInput(input).then(function (response) {
                    if (response.data) {
                        sc.searchItems = response.data.items;

                        if ($(window).width() > 767)
                            $('.downer').find('.search-results').addClass('open');
                        else
                            $('#nav-mobile').find('.search-results').addClass('open');
                    }
                });
            },
            closeResults: function () {
                $('.downer').find('.search-results').removeClass('open');
                $('#nav-mobile').find('.search-results').removeClass('open');
            },
            openSearchPage:function (input) {
                window.location = '/search?input='+input;
            },
            searchCert: function (cert) {
                Api.getCerts(cert).then(function (response) {
                    if (response.data) {
                        sc.certItems = response.data.items;

                    }
                });
            }
        };
        window.sc = sc;
        angular.extend(sc, this);

        return sc;
    }]);
})(topol);