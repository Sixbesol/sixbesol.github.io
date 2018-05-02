$(document).ready(function () {
    function t() {
        var t = $("#hero"),
            e = $(window),
            i = t.data("height");

        t.css(t.hasClass("full-height") ? {
            height: e.height()
        } : {
            height: i  + "px"
        });
        if (e.width() < 900) {
            t.css({
                height: e.height() / 1.7715
            });
            var sliderItems = $('.item.m-center');
            $(sliderItems[0]).css({backgroundImage: 'url(img/mobile_1.jpg)'});
            $(sliderItems[1]).css({backgroundImage: 'url(img/mobile_2.jpg)'});
        }
    }

    var e = $(".anima").waypoint(function (t) {
        "down" == t && $(this.element).addClass("in")
    }, {
        offset: "80%"
    });
    t(), $(window).resize(t), $(document).on("click.nav", ".navbar-collapse.in", function (t) {
        ($(t.target).is("a") || $(t.target).is("button")) && $(this).collapse("hide")
    }), $("#show-btn").click(function () {
        return $("#showme").slideDown("slow"), $(this).hide(), !1
    }), $(".carousel").carousel({interval: false}), $("#main-nav").singlePageNav({
        offset: $(".navbar").height(),
        speed: 750,
        currentClass: "active",
        filter: ":not(.external)",
        beforeStart: function () {
        },
        onComplete: function () {
        }
    }), $("#modal-bar").affix({
        offset: {
            top: 10
        }
    });
    var i = 3,
        o = new Date,
        a = o.setTime(o.getTime() + 24 * i * 60 * 60 * 1e3);
    $("#countdown").countdown(a, function (t) {
        $(this).text(t.strftime("%-d days %H:%M:%S"))
    }), $(".smooth-scroll").click(function () {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var t = $(this.hash);
            if (t = t.length ? t : $("[name=" + this.hash.slice(1) + "]"), t.length) return $("html,body").animate({
                scrollTop: t.offset().top - 60
            }, 1e3), !1
        }
    }), $("#style-switcher h2 a").click(function () {
        return $("#style-switcher").toggleClass("open"), !1
    }), $("#style-switcher li").click(function (t) {
        t.preventDefault();
        var e = $(this);
        return $(".colors").attr("href", "css/" + e.attr("id") + ".css"), $("#logo").attr("src", "img/logo-" + e.attr("id") + ".png"), $("#navlogo").attr("src", "img/navlogo-" + e.attr("id") + ".png"), $("#style-switcher").removeClass("open"), !1
    })
}), app = angular.module("storeApp", []),

    app.filter('customNumber', function () {
        return function (value) {
            return parseFloat(value) //convert to int
        }
    }),

    app.controller("orderController", ["$scope", function t(e) {

        e.options = [{
            label: "0",
            value: 0
        }, {
            label: "1",
            value: 1
        }, {
            label: "2",
            value: 2
        }, {
            label: "3",
            value: 3
        }, {
            label: "4",
            value: 4
        }, {
            label: "5",
            value: 5
        }];

        e.clita = e.options[0];
        e.vero = e.options[0];
        e.mero = e.options[0];
        e.jebo = e.options[0];
        e.nemo = e.options[0];
        e.yoki = e.options[0];

        e.subtotal = 0;
        e.total = 0;

        e.updateTotal = function () {
            e.subtotal = (e.clita.value * 200) + (e.vero.value * 200) + (e.mero.value * 200) + (e.jebo.value * 200) + (e.nemo.value * 200) + (e.yoki.value * 200);
            e.total = e.subtotal + 3.99;
        }
    }]), app.controller("productsController", ["$scope", function e(t) {
    t.items = [{
        name: "Clita",
        price: "200",
        oldprice: "200"
    }, {
        name: "Vero ",
        price: "150",
        oldprice: "150"
    },
        {
            name: "Mero",
            price: "250",
            oldprice: "250"
        },
        {
            name: "Jebo",
            price: "500",
            oldprice: "500"
        },
        {
            name: "Nemo",
            price: "500",
            oldprice: "500"
        },
        {
            name: "Yoki",
            price: "600",
            oldprice: "600"
        }
    ]
}]), $(document).ready(function () {
    function t() {
        var t = o;
        t.after(loaderIntro), t.addClass(function () {
            return t.find(".item").length > 1 ? "big-slider" : ""
        }), t.waitForImages({
            finished: function () {
                if ($(".landing").remove(), t.hasClass("big-slider")) {
                    var e = t.data("autoplay"),
                        i = t.data("navigation"),
                        o = t.data("dots"),
                        a = t.data("transition");
                    t.owlCarousel({
                        items: 1,
                        loop: !0,
                        autoplayTimeout: e || !1,
                        dots: o || !1,
                        nav: i || !1,
                        navText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
                        autoplay: false,
                        animateOut: a || !1
                    })
                }
            },
            waitForAll: !0
        })
    }

    var e = $(window),
        i = $("#hero"),
        o = $("#hero-slider");
    loaderIntro = '<div class="landing"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>', o.length && t()
}), $(document).ready(function () {
    function t() {
        var t = i;
        t.after(loaderIntro), t.addClass(function () {
            return t.find(".item").length > 1 ? "big-slider" : ""
        }), t.waitForImages({
            waitForAll: !0,
            finished: function () {
                if ($(".landing").remove(), t.hasClass("big-slider")) {
                    var e = t.data("autoplay"),
                        i = t.data("navigation"),
                        o = t.data("dots"),
                        a = t.data("transition");
                    t.owlCarousel({
                        items: 1,
                        loop: !0,
                        autoplayTimeout: e || !1,
                        dots: o || !1,
                        nav: i || !1,
                        navText: ['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
                        autoplay: false,
                        animateOut: a || !1
                    })
                }
            }
        })
    }

    var e = $(window),
        i = $("#project-slider");
    loaderIntro = '<div class="landing"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>', $(".img-box").click(function (e) {
        var i = $(this).parent(),
            o = i.find(".project-title").text(),
            a = i.find(".project-price").text(),
            n = i.find(".project-description").html(),
            s = "";
        elemDataCont = i.find(".project-description"), slides = i.find(".project-description").data("images").split(",");
        for (var r = 0; r < slides.length; ++r) s = s + '<div class="item" style="background-image: url(' + slides[r] + ');"></div>';
        $("#project-modal").on("show.bs.modal", function () {
            $(this).find("#sdbr-title").text(o), $(this).find("#sdbr-price").text(a), $(this).find("#project-content").html(n).prepend('<a id="btn-order" class="btn btn-store btn-right"  href="#">Order Now</a>'), $(this).find("#project-slider").html(s), elemDataCont.data("oldprice") ? $(this).find("#sdbr-oldprice").show().text(elemDataCont.data("oldprice")) : $(this).find("#sdbr-oldprice").hide(), elemDataCont.data("descr") ? $(this).find("#sdbr-descr").show().text(elemDataCont.data("descr")) : $(this).find("#sdbr-descr").hide()
        }).modal(), t()
    }), $("#project-modal").on("hidden.bs.modal", function () {
        $("#project-slider").removeClass("big-slider"), $("#project-slider").trigger("destroy.owl.carousel")
    }), $("#project-modal").on("click", "#btn-order", function () {
        $("#project-modal").modal("hide"), $("#project-slider").trigger("destroy.owl.carousel");
        var t = $("section[id='orderform']");
        return $("html,body").animate({
            scrollTop: t.offset().top - 60
        }, "slow"), !1
    })
});