(function (topol) {
    "use strict";
    topol.controller('CatalogController', ['$rootScope', '$scope', '$window', '$http', '$timeout', 'Api', function ($rootScope, $scope, $window, $http, $timeout, Api) {
        var cat = {
            products: [],
            options_key: '',
            options: '',
            brands: '',
            filterExpression: {},
            loading: false,
            categories: [],
            pageSize:21,
            currentPage: 1,
            filtered_products: [],
            currentCategory:{},
            initFunctions: function (slug) {
                cat.loading = true;
                Api.getCurrentCategory(slug).then(function (response) {
                    if (response.data){
                        cat.currentCategory = response.data.category;
                        cat.getCategoryProducts(cat.currentCategory.id);
                    }
                });
            },
            refreshCategory: function (category) {
               window.location.href = category;
            },
            getCategoryProducts: function (categoryId) {
                Api.getCategoryProducts(categoryId).then(function (response) {
                    if (response.data && response.data.products) {
                        cat.loading = false;
                        cat.products = response.data.products;
                        cat.options_key = response.data.options_key;
                        cat.options = response.data.options;
                        cat.brands = response.data.brands;
                        cat.filters = response.data.filters;
                        angular.forEach(cat.filters, function (filter, key) {
                                filter.filtersLimit = 4;
                        });

                        setTimeout(function () {
                            $(".img-hover").find('.title, .name, .image').each(function () {
                                $(this).hover(function () {
                                    var img = $(this).parent().find('.image');
                                    (img.length) ? img.toggleClass('hover') : $(this).parent().parent().find('.image').toggleClass('hover');
                                });
                            });
                            $(".img-hover").find('.image').each(function () {
                                $(this).hover(function () {
                                    var img = $(this).parent().find('.title, .name');
                                    (img.length) ? img.toggleClass('hover') : $(this).parent().parent().find('.title, .name').toggleClass('hover');
                                });
                            });
                        },200);
                    }else {
                        cat.products = [];
                        cat.loading = false;
                    }
                });
            },

            changePageSize: function (pageSize) {
               cat.pageSize = pageSize;
            },
            numberOfPages:function(){
                return Math.ceil(cat.products.length/cat.pageSize);
            },
            updateFilters: function (item) {

                var validCounter = 0;
                var trueCounter;
                for (var categoryKey in cat.filters) {
                    trueCounter = 0;
                    for (var valueKey in cat.filters[categoryKey]) {
                        if (valueKey == 'filtersLimit') {
                            continue;
                        }
                        if (cat.filters[categoryKey][valueKey]) {
                            trueCounter = 1;
                            if (item[categoryKey] === valueKey) {
                                trueCounter = -1;
                                break;
                            }
                        }
                    }
                    validCounter += +(trueCounter < 1);
                }
                return validCounter === Object.keys(cat.filters).length;
            },
            showMoreFilter: function (category) {
                return category.filtersLimit + 1 < Object.keys(category).length;
            },
        };

        window.cat = cat;
        angular.extend(cat, this);
        return cat;

    }]).filter('filtersLimitTo', [function () {
        return function (obj, limit) {
            var keys = Object.keys(obj);
            if (keys.length < 1) {
                return [];
            }
            var ret = new Object,
                count = 0;
            angular.forEach(keys, function (key, arrayIndex) {
                if (count >= limit) {
                    return false;
                }
                ret[key] = obj[key];
                count++;
            });
            return ret;
        };
    }]);
})(topol);