jQuery(function ($) {
    function isInViewport($el) {
        const rect = $el[0].getBoundingClientRect();
        const buffer = 100;
        return (
            rect.top <
            (window.innerHeight || document.documentElement.clientHeight) -
            buffer && rect.bottom > 0
        );
    }

    function handleScroll() {
        $(
            ".fade-in, .slide-in-up, .slide-in-left, .scale-up, .slide-in-right"
        ).each(function () {
            const $el = $(this);
            if (isInViewport($el)) {
                if (!$el.hasClass("show")) {
                    $el.addClass("show");
                }
            }
        });
    }

    handleScroll();
    $(window).on("scroll", handleScroll);
    $(window).on("resize", handleScroll);
});
