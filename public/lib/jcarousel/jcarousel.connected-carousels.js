$(window).resize(function () {
    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {
        // Setup the carousels. Adjust the options for both carousels here.
        var carouselStage      = $('.carousel-stage').on('jcarousel:createend', function() {
            // Arguments:
            // 1. The method to call
            // 2. The index of the item (note that indexes are 0-based)
            // 3. A flag telling jCarousel jumping to the index without animation
            $(this).jcarousel('scroll', -1, false);

        }).jcarousel({
            items: '.item-jcarousel',
        });

        carouselStage.on('jcarousel:scroll', function(event, target, carousel){
            $('.item-jcarousel').removeClass('active');

            $(target[0]).addClass('active');
            

        }).jcarousel();

        var carouselNavigation = $('.carousel-navigation').on('jcarousel:createend', function() {
            // Arguments:
            // 1. The method to call
            // 2. The index of the item (note that indexes are 0-based)
            // 3. A flag telling jCarousel jumping to the index without animation
            $(this).jcarousel('scroll', -1, false);
        }).jcarousel();


        // We loop through the items of the navigation carousel and set it up
        // as a control for an item from the stage carousel.
        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);

            // This is where we actually connect to items.
            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        // Setup controls for the stage carousel
        $('.prev-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        // Setup controls for the navigation carousel
        $('.prev-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
    });
});

(function($) {
    // This is the connector function.
    // It connects one item from the navigation carousel to one item from the
    // stage carousel.
    // The default behaviour is, to connect items with the same index from both
    // carousels. This might _not_ work with circular carousels!
    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {
        // Setup the carousels. Adjust the options for both carousels here.
        var carouselStage      = $('.carousel-stage').on('jcarousel:createend', function() {
            // Arguments:
            // 1. The method to call
            // 2. The index of the item (note that indexes are 0-based)
            // 3. A flag telling jCarousel jumping to the index without animation
            $(this).jcarousel('scroll', -1, false);

            $('.item-jcarousel').removeClass('active');
            $('.item-jcarousel').last().addClass('active');

            var _windowWidth = window.innerWidth;

            if(_windowWidth > 768){
                var _h = $('.item-jcarousel').last().height();

                $(this).height(_h+"px");
            }



        }).jcarousel({
            items: '.item-jcarousel',
        });

        carouselStage.on('jcarousel:scroll', function(event, carousel, target, animate){
            $('.item-jcarousel').removeClass('active');

            $(target[0]).addClass('active');

            var _windowWidth = window.innerWidth;

            if(_windowWidth > 768){
                var _h = $(target[0]).height();

                $(this).height(_h+"px");
            }

        }).jcarousel();

        var carouselNavigation = $('.carousel-navigation').on('jcarousel:createend', function() {
            // Arguments:
            // 1. The method to call
            // 2. The index of the item (note that indexes are 0-based)
            // 3. A flag telling jCarousel jumping to the index without animation
            $(this).jcarousel('scroll', -1, false);
        }).jcarousel();


        // We loop through the items of the navigation carousel and set it up
        // as a control for an item from the stage carousel.
        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);

            // This is where we actually connect to items.
            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        // Setup controls for the stage carousel
        $('.prev-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        // Setup controls for the navigation carousel
        $('.prev-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
    });
})(jQuery);
