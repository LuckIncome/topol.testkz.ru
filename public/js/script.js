$(window).on('load', function() {
    setTimeout(function () {
        $('.preloader-wrapper').fadeOut('slow');
    },500);
});
$(document).ready(function () {
    $('select').niceSelect();

    $('input[type="tel"]').each(function (index) {
        var element = $('input[type="tel"]')[index];
        $(element).mask('+7 (999) 999-99-99')
    });

    $('button[type=submit]').on('click', function (e) {
        $(this).closest('form').find('input').each(function () {
            if ($(this).prop('required')) {
                if (!$(this).val()) {
                    $(this).addClass('warning');
                }
            }
        });
    });
    $('form').find('input').each(function () {
        if ($(this).prop('required')) {
            $(this).blur(function () {
                if (!$(this).val()) {
                    $(this).addClass('warning');
                } else {
                    $(this).removeClass('warning');
                }
            });
            $(this).keypress(function () {
                if (!$(this).val()) {
                    $(this).addClass('warning');
                } else {
                    $(this).removeClass('warning');
                }
            });
        }
    });

    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdownToggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    if ($(window).width() > 767) {
        $dropdown.hover(
            function () {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
                $this.find($dropdownToggle).addClass('active');
            },
            function () {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
                $this.find($dropdownToggle).removeClass('active');
            }
        );
    }

    if ($(window).width() < 767) {
        $dropdown.click(function () {
            var $this = $(this);
            $(".dropdown").each(function (item) {
                if ($(this).is($this)) {
                    $(this).removeClass(showClass);
                }
            });
            $(".dropdown-menu").each(function (item) {
                if ($(this).is($this)) {
                    $(this).removeClass(showClass);
                }
            });
            $(".dropdownToggle").each(function (item) {
                if ($(this).is($this)) {
                    $(this).removeClass(active);
                }
            });
            $(".dropdownToggle").each(function (item) {
                if ($(this).is($this)) {
                    $(this).attr('aria-expanded', "false");
                }
            });

            if (!$this.find($dropdownMenu).hasClass(showClass)) {
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", '"' + !$this.find($dropdownToggle).attr("aria-expanded") + '"');
                $this.find($dropdownMenu).addClass(showClass);
                $this.find($dropdownToggle).addClass('active');
            } else {
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", '"' + !$this.find($dropdownToggle).attr("aria-expanded") + '"');
                $this.find($dropdownMenu).removeClass(showClass);
                $this.find($dropdownToggle).removeClass('active');
            }

        });
    }

    $('.home-slider .slider-content').slick({
        infinite: false,
        dots: false,
        autoplay: false,
        // autoplaySpeed: 5000,
        prevArrow: $('.home-slider .slider-arrows .prevSlide'),
        nextArrow: $('.home-slider .slider-arrows .nextSlide'),
    });
    $('#nav-hamb').click(function () {
        $(this).toggleClass('open');
        if ($(window).width() <= 767) {
            $('#navigation-menu').removeClass('open');
            $('#navigation-menu').hide();
            if ($('#nav-mobile').hasClass('open')) {
                $('#nav-mobile').removeClass('open');
                $('.mob-fixed-menu .logo').removeClass('open');
                closeNav();
            } else {
                setTimeout(function () {
                    $('#nav-mobile').addClass('open');
                    $('.mob-fixed-menu .logo').addClass('open');
                }, 150);
                openNav();
            }
        } else {
            $('#navigation-menu').toggleClass('open');
            $('#nav-mobile').removeClass('open');
            $('.mob-fixed-menu .logo').removeClass('open');
            $('#nav-mobile').hide();
        }
    });
    var featureds = ['1', '2', '3'];
    for (var k = 0; k < featureds.length; k++) {
        if ($('#nav-' + featureds[k] +' .tab-slider .content').find('.item').length > 4){
            $('#nav-' + featureds[k]).find('.tab-slider .content').slick({
                infinite: true,
                dots: false,
                autoplay: false,
                slidesToShow: 4,
                prevArrow: $('#nav-' + featureds[k]).find('.slider-arrows .prevSlide'),
                nextArrow: $('#nav-' + featureds[k]).find('.slider-arrows .nextSlide'),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                ]
            });
            $('#nav-' + featureds[k] +' .tab-slider').removeClass('not-slider');
        }else {
            $('#nav-' + featureds[k] +' .tab-slider').addClass('not-slider');
        }

    }
    if ($('.product-page .tab-slider .content .item').length > 2) {
        $('.product-page').find('.tab-slider .content').slick({
            infinite: true,
            dots: false,
            autoplay: false,
            slidesToShow: 3,
            prevArrow: $('.product-page').find('.slider-arrows .prevSlide'),
            nextArrow: $('.product-page').find('.slider-arrows .nextSlide'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
    } else {
        $('.product-page').find('.tab-slider .slider-arrows').hide();
    }


    $('.about-page').find('.tab-slider .content').slick({
        infinite: false,
        dots: false,
        autoplay: false,
        slidesToShow: 3,
        prevArrow: $('.about-page').find('.slider-arrows .prevSlide'),
        nextArrow: $('.about-page').find('.slider-arrows .nextSlide'),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });

    $(".img-hover").find('.title, .name, .image').each(function () {
        var img = $(this).parent().find('.image');
        if (img.length) {
            img.removeClass('hover');
        } else {
            $(this).parent().parent().find('.image').removeClass('hover');
        }
        $(this).hover(function () {
            var img = $(this).parent().find('.image');
            if (img.length) {
                if (!img.hasClass('hover'))
                    img.addClass('hover');
                else
                    img.removeClass('hover');
            } else {
                if (!$(this).parent().parent().find('.image').hasClass('hover'))
                    $(this).parent().parent().find('.image').addClass('hover');
                else
                    $(this).parent().parent().find('.image').removeClass('hover');
            }
        });
    });

    $(".img-hover").find('.image').each(function () {
        var img = $(this).parent().find('.title, .name');
        if (img.length) {
            img.removeClass('hover');
        } else {
            $(this).parent().parent().find('.title, .name').removeClass('hover');
        }
        $(this).hover(function () {
            var img = $(this).parent().find('.title, .name');
            if (img.length) {
                if (!img.hasClass('hover'))
                    img.addClass('hover');
                else
                    img.removeClass('hover');
            } else {
                if (!$(this).parent().parent().find('.title, .name').hasClass('hover')) {
                    $(this).parent().parent().find('.title, .name').addClass('hover')
                } else {
                    $(this).parent().parent().find('.title, .name').removeClass('hover');
                }
            }
        });
    });

    if ($('.partners .slider-data .content').find('.item').length > 7 || $(window).width() < 481) {
        $('.partners .slider-data .content').slick({
            infinite: true,
            dots: false,
            slidesToShow: 7,
            slidesToScroll: 1,
            autoplay: false,
            // autoplaySpeed: 5000,
            prevArrow: $('.partners .slider-data .slider-arrows .prevSlide'),
            nextArrow: $('.partners .slider-data .slider-arrows .nextSlide'),
            responsive: [
                {
                    breakpoint: 1220,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }else {
        $('.partners .slider-data').find('.slider-arrows').hide();
        $('.partners .slider-data').addClass('no-slide');
    }


    $('.gallery-slider .slider-data').slick({
        infinite: false,
        dots: false,
        slidesToShow: 2,
        autoplay: false,
        // autoplaySpeed: 5000,
        prevArrow: $('.gallery-slider .slider-arrows .prevSlide'),
        nextArrow: $('.gallery-slider .slider-arrows .nextSlide'),
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(function () {
        $('[data-toggle="popover"]').popover()
    });


    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active-acc');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active-acc');
    });

    $(document).on("keypress", ".input-group:has(input:input, .input-group-append:has(.btn)) input:input", function (e) {
        if (e.which == 13) {
            $(this).closest(".input-group").find(".btn").click();
        }
    });


    $("#callbackModal, #consultationModal").on('shown.bs.modal', function (event) {
        var page = $(event.relatedTarget).data('page');
        $(this).find('.page-name').val(page);
    });
});
document.createElement( "picture" );

// Получаем нужный элемент
var element = document.querySelector('footer');
var element2 = document.querySelector('#nav-mapsContentPage');
var Visible = function (target) {
    // Все позиции элемента
    var targetPosition = {
            top: window.pageYOffset + target.getBoundingClientRect().top,
            left: window.pageXOffset + target.getBoundingClientRect().left,
            right: window.pageXOffset + target.getBoundingClientRect().right,
            bottom: window.pageYOffset + target.getBoundingClientRect().bottom
        },
        // Получаем позиции окна
        windowPosition = {
            top: window.pageYOffset,
            left: window.pageXOffset,
            right: window.pageXOffset + document.documentElement.clientWidth,
            bottom: window.pageYOffset + document.documentElement.clientHeight
        };

    if (targetPosition.bottom > windowPosition.top && // Если позиция нижней части элемента больше позиции верхней чайти окна, то элемент виден сверху
        targetPosition.top < windowPosition.bottom && // Если позиция верхней части элемента меньше позиции нижней чайти окна, то элемент виден снизу
        targetPosition.right > windowPosition.left && // Если позиция правой стороны элемента больше позиции левой части окна, то элемент виден слева
        targetPosition.left < windowPosition.right) { // Если позиция левой стороны элемента меньше позиции правой чайти окна, то элемент виден справа
        // Если элемент полностью видно, то запускаем следующий код
        var myMap;

        var offices = $('footer .map');
        var contacts = $('.page-content .map');

        ymaps.ready(function () {
            if (contacts.length) {
                for (var $k = 0; $k < contacts.length; $k++) {
                    initMap($(contacts)[$k].id, $(contacts[$k]).find('.text').text(), $(contacts)[$k].dataset.coordinates);
                }
            } else {
                for (var $i = 0; $i < offices.length; $i++) {
                    initMap($(offices)[$i].id, $(offices[$i]).find('.text').text(), $(offices)[$i].dataset.coordinates);
                }
            }
        });
    } else {
        // Если элемент не видно, то запускаем этот код
        console.clear();
    }
    ;
};

// Запускаем функцию при прокрутке страницы
window.addEventListener('scroll', function () {
    if (element && $(window).width() > 1024)
        Visible(element);
    if (element2 && $(window).width() > 1024)
        Visible(element2);
});

// А также запустим функцию сразу. А то вдруг, элемент изначально видно
if (element && $(window).width() > 1024)
    Visible(element);
if (element2 && $(window).width() > 1024)
    Visible(element2);

if ($(window).width() <= 1024){
    var myMap;

    var offices = $('footer .map');
    var contacts = $('.page-content .map');

    ymaps.ready(function () {
        if (contacts.length) {
            for (var $k = 0; $k < contacts.length; $k++) {
                initMap($(contacts)[$k].id, $(contacts[$k]).find('.text').text(), $(contacts)[$k].dataset.coordinates);
            }
        } else {
            for (var $i = 0; $i < offices.length; $i++) {
                initMap($(offices)[$i].id, $(offices[$i]).find('.text').text(), $(offices)[$i].dataset.coordinates);
            }
        }
    });
}

function initMap(id, text, coordinates) {
    coordinates = coordinates.replace(' ', '').split(',');
    coords = [parseFloat(coordinates[0]), parseFloat(coordinates[1])];
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map(id, {
        zoom: 17,
        scroll: false,
        center: coords,
        controls: ['smallMapDefaultSet']
    }, {
        searchControlProvider: 'yandex#search'
    });
    myMap.behaviors.disable('scrollZoom');
    myMap.behaviors.disable('drag');
    // Создание макета балуна на основе Twitter Bootstrap.
    MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="popover top">' +
        '<a class="close" href="#"></a>' +
        '<div class="arrow"></div>' +
        '<div class="popover-inner">' +
        '$[[options.contentLayout observeSize minWidth=280 maxWidth=280 maxHeight=350]]' +
        '</div>' +
        '</div>', {
            /**
             * Строит экземпляр макета на основе шаблона и добавляет его в родительский HTML-элемент.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#build
             * @function
             * @name build
             */
            build: function () {
                this.constructor.superclass.build.call(this);

                this._$element = $('.popover', this.getParentElement());

                this.applyElementOffset();

                this._$element.find('.close')
                    .on('click', $.proxy(this.onCloseClick, this));
            },

            /**
             * Удаляет содержимое макета из DOM.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#clear
             * @function
             * @name clear
             */
            clear: function () {
                this._$element.find('.close')
                    .off('click');

                this.constructor.superclass.clear.call(this);
            },

            /**
             * Метод будет вызван системой шаблонов АПИ при изменении размеров вложенного макета.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
             * @function
             * @name onSublayoutSizeChange
             */
            onSublayoutSizeChange: function () {
                MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

                if(!this._isElement(this._$element)) {
                    return;
                }

                this.applyElementOffset();

                this.events.fire('shapechange');
            },

            /**
             * Сдвигаем балун, чтобы "хвостик" указывал на точку привязки.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
             * @function
             * @name applyElementOffset
             */
            applyElementOffset: function () {
                this._$element.css({
                    left: -(this._$element[0].offsetWidth / 2),
                    top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
                });
            },

            /**
             * Закрывает балун при клике на крестик, кидая событие "userclose" на макете.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
             * @function
             * @name onCloseClick
             */
            onCloseClick: function (e) {
                e.preventDefault();

                this.events.fire('userclose');
            },

            /**
             * Используется для автопозиционирования (balloonAutoPan).
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ILayout.xml#getClientBounds
             * @function
             * @name getClientBounds
             * @returns {Number[][]} Координаты левого верхнего и правого нижнего углов шаблона относительно точки привязки.
             */
            getShape: function () {
                if(!this._isElement(this._$element)) {
                    return MyBalloonLayout.superclass.getShape.call(this);
                }

                var position = this._$element.position();

                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [position.left, position.top], [
                        position.left + this._$element[0].offsetWidth,
                        position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
                    ]
                ]));
            },

            /**
             * Проверяем наличие элемента (в ИЕ и Опере его еще может не быть).
             * @function
             * @private
             * @name _isElement
             * @param {jQuery} [element] Элемент.
             * @returns {Boolean} Флаг наличия.
             */
            _isElement: function (element) {
                return element && element[0] && element.find('.arrow')[0];
            }
        }),

        // Создание вложенного макета содержимого балуна.
        MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="popover-content">$[properties.balloonContent]</div>'
        );
    var myPlacemark = new ymaps.Placemark(coords, {
        balloonContent: '<div class="map-ballon">'+text + '</div>'
    }, {
        iconLayout: 'default#image',
        iconImageHref: '/images/icons/org.svg',
        iconImageSize: [24, 24],
        iconImageOffset: [-24, -24],
        balloonPanelMaxMapArea: 0,
        balloonLayout: MyBalloonLayout,
        balloonContentLayout: MyBalloonContentLayout
    });
    myMap.geoObjects.add(myPlacemark);

    observeEvents(myMap);

    myPlacemark.balloon.open();

    myMap.container.fitToViewport();
}

function observeEvents(map) {
    var mapEventsGroup;
    map.geoObjects.each(function (geoObject) {
        geoObject.balloon.events
        // При открытии балуна начинаем слушать изменение центра карты.
            .add('open', function (e1) {
                var placemark = e1.get('target');
                // Вызываем функцию в двух случаях:
                mapEventsGroup = map.events.group()
                // 1) в начале движения (если балун во внешнем контейнере);
                    .add('actiontick', function (e2) {
                        if (placemark.options.get('balloonPane') == 'outerBalloon') {
                            setBalloonPane(map, placemark, e2.get('tick'));
                        }
                    })
                    // 2) в конце движения (если балун во внутреннем контейнере).
                    .add('actiontickcomplete', function (e2) {
                        if (placemark.options.get('balloonPane') != 'outerBalloon') {
                            setBalloonPane(map, placemark, e2.get('tick'));
                        }
                    });
                // Вызываем функцию сразу после открытия.
                setBalloonPane(map, placemark);
            })
            // При закрытии балуна удаляем слушатели.
            .add('close', function () {
                mapEventsGroup.removeAll();
            });
    });
}

function setBalloonPane(map, placemark, mapData) {
    mapData = mapData || {
            globalPixelCenter: map.getGlobalPixelCenter(),
            zoom: map.getZoom()
        };

    var mapSize = map.container.getSize(),
        mapBounds = [
            [mapData.globalPixelCenter[0] - mapSize[0] / 2, mapData.globalPixelCenter[1] - mapSize[1] / 2],
            [mapData.globalPixelCenter[0] + mapSize[0] / 2, mapData.globalPixelCenter[1] + mapSize[1] / 2]
        ],
        balloonPosition = placemark.balloon.getPosition(),
        // Используется при изменении зума.
        zoomFactor = Math.pow(2, mapData.zoom - map.getZoom()),
        // Определяем, попадает ли точка привязки балуна в видимую область карты.
        pointInBounds = ymaps.util.pixelBounds.containsPoint(mapBounds, [
            balloonPosition[0] * zoomFactor,
            balloonPosition[1] * zoomFactor
        ]),
        isInOutersPane = placemark.options.get('balloonPane') == 'outerBalloon';

    // Если точка привязки не попадает в видимую область карты, переносим балун во внутренний контейнер
    if (!pointInBounds && isInOutersPane) {
        placemark.options.set({
            balloonPane: 'balloon',
            balloonShadowPane: 'shadows'
        });
        // и наоборот.
    } else if (pointInBounds && !isInOutersPane) {
        placemark.options.set({
            balloonPane: 'outerBalloon',
            balloonShadowPane: 'outerBalloon'
        });
    }
}
document.querySelectorAll('img.svg').forEach(function (img) {
    var imgID = img.id;
    var imgClass = img.className;
    var imgURL = img.src;

    fetch(imgURL).then(function (response) {
        return response.text();
    }).then(function (text) {

        var parser = new DOMParser();
        var xmlDoc = parser.parseFromString(text, "text/xml");

        // Get the SVG tag, ignore the rest
        var svg = xmlDoc.getElementsByTagName('svg')[0];

        // Add replaced image's ID to the new SVG
        if (typeof imgID !== 'undefined') {
            svg.setAttribute('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== 'undefined') {
            svg.setAttribute('class', imgClass + ' replaced-svg');
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        svg.removeAttribute('xmlns:a');

        //Check if the viewport is set, if the viewport is not set the SVG wont't scale.
        if (!svg.getAttribute('viewBox') && svg.getAttribute('height') && svg.getAttribute('width')) {
            svg.setAttribute('viewBox', '0 0 ' + svg.getAttribute('height') + ' ' + svg.getAttribute('width'))
        }

        // Replace image with new SVG
        img.parentNode.replaceChild(svg, img);
    });

});
// When the user scrolls down 20px from the top of the document, slide down the navbar
window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if ($(window).width() > 767) {
        if (document.body.scrollTop > 160 || document.documentElement.scrollTop > 160) {
            document.getElementById("fixed-menu").style.top = "0";
        } else {
            document.getElementById("fixed-menu").style.top = "-150px";
        }
    }
}

function openNav() {
    if ($(window).width() > 481) {
        document.getElementById("nav-mobile").style.width = "45%";
    } else {
        document.getElementById("nav-mobile").style.width = "90%";
    }
    document.getElementById("nav-mobile").style.left = "0";
    // document.getElementById("main").style.marginLeft = "85%";
    document.getElementById("main").style.width = "100%";
    document.body.style.overflowY = "hidden";
}

function closeNav() {
    document.getElementById("nav-mobile").style.width = "0";
    document.getElementById("nav-mobile").style.left = "-50%";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.overflowY = "auto";
    if ($(window).width() > 481) {
        document.getElementById("main").style.marginTop = "95px";
    } else {
        document.getElementById("main").style.marginTop = "90px";
    }
}

(function ($) {
    function processFormModal(e) {
        var self = $(this);
        $.ajax({
            url: '/feedback/inline',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: $(this).serialize(),
            success: function (data, textStatus, jQxhr) {
                console.log(textStatus,jQxhr);
                $('#callbackModal').modal('hide');
                $('#consultationModal').modal('hide');
                $('#successModal').modal('show');
                $(self).find("input, textarea").val("");
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('Заполните все необходимые поля');
            }
        });
        e.preventDefault();
    }

    $('#callbackModal form, #consultationModal form, .feedback form').submit(processFormModal);
})(jQuery);


(function ($) {
    function processFormSubscription(e) {
        var self = $(this);
        $.ajax({
            url: '/subscribe',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: $(this).serialize(),
            success: function (data, textStatus, jQxhr) {
                var result = $.parseJSON(data);
                if (result.success) {
                    $('.subscription').find('.inline-form').slideUp(500, 'swing', function () {
                        $('.subscription').find('.text-success').slideDown(500);
                    });
                    $(self).find("input, textarea").val("");
                } else {
                    $('.subscription').find('.text-success').find('p').text(result.message);
                    $('.subscription').find('.inline-form').slideUp(500, 'swing', function () {
                        $('.subscription').find('.text-success').slideDown(500);
                    });
                }

            },
            error: function (jqXhr, textStatus, errorThrown) {

            }
        });
        e.preventDefault();
    }

    $('.subscription form').submit(processFormSubscription);
})(jQuery);
