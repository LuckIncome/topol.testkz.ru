angular.module('topol')
    .factory('Api', function ($http) {
        return {
            getCategoryProducts: function (categoryId) {
                return $http.get('/catalog/' + categoryId + '/products', {
                    categoryId: categoryId
                });
            },
            getCurrentCategory: function (slug) {
                return $http.get('/catalog/getCurrent/' + slug);
            },
            getCerts: function (input) {
                return $http({url:'/certs',method:"GET",params: {
                    input: input
                }});
            },
            getCurrentProduct: function (slug) {
                return $http.get('/product/getCurrent/' + slug);
            },

            searchByInput: function (input) {
                return $http({url:'/search',method:"GET",params: {
                    input: input
                }});
            }

        };

    });