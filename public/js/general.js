
$(document).ready(function () {

    $(".animacionVisible").inViewport(function (px) {
        if (px){
            $(this).addClass("animacion");
        }
    });
    
    $(".scrollUp").on("click", function () {
        $("html").animate({scrollTop: 0});
    });

    $(".menu-btn").on("click", function () {
        $(".navbar-top .menu").toggleClass("active");
        $(".menu-btn i").toggleClass("active");
    });
    $(".nav-link").on("click", function () {
        $(".navbar-top .menu").removeClass("active");
        $(".menu-btn i").removeClass("active");
    });

    if($(".typing").length){
        var typed = new Typed(".typing", {
            strings: ["Analista", "Desarrollador"],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true,
        });
    }
    if($(".typing2").length){
        var typed = new Typed(".typing2", {
            strings: ["Analista", "Desarrollador"],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true,
        });
    }
    var pos = 0;
    $(window).scroll(function () {
        if($('#skills').length){
            var oTop = $('#skills').offset().top - window.innerHeight;
            if (pos === 0 && $(window).scrollTop() > oTop) {
                $('.countUp').each(function () {
                    var $this = $(this),
                            countTo = $this.attr('aria-valuenow');
                    $({countNum: $this.css("width")}).animate({
                        countNum: countTo
                    },
                            {
                                duration: 3000,
                                easing: 'swing',
                                step: function () {
                                    $this.css("width", Math.floor(this.countNum) + "%");
                                },
                                complete: function () {
                                    $this.css("width", this.countNum + "%");
                                }
                            });
                });
                pos = 1;
            }
        }
    });
    $('.carousel').owlCarousel({
        margin: 20,
        loop: true,
        autoplayTimeOut: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            }
        }
    });
    
    $("span.colores").on("click", function(){
       $(":root").css("--main-bg-color", $(this).data("color"));
    });
});
$(document).on("click", "a[href^='#']", function (e) {
    e.preventDefault();
    if ($.attr(this, "href") != "#") {
        $("html, body").animate({
            scrollTop: $($.attr(this, "href")).offset().top - $(".navbar-top").outerHeight()
        }, 500);
    }
});
$(function ($, win) {
    $.fn.inViewport = function (cb) {
        return this.each(function (i, el) {
            function visPx() {
                var H = $(this).height(),
                        r = el.getBoundingClientRect(), t = r.top, b = r.bottom;
                return cb.call(el, Math.max(0, t > 0 ? H - t : (b < H ? b : H)));
            }
            visPx();
            $(win).on("resize scroll", visPx);
        });
    };
}(jQuery, window));