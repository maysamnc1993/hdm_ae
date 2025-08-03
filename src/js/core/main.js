/// ============  start header =================

jQuery(document).ready(function($) {
    // Variables
    const $body = $('body');
    const $header = $('.site-header');
    const $mobileMenuToggle = $('.js-mobile-menu-toggle');
    const $mobileSearchToggle = $('.js-mobile-search-toggle');
    const $mobileMenu = $('.js-mobile-menu');
    const $mobileSearch = $('.js-mobile-search');

    // Mobile menu toggle with overlay
    $mobileMenuToggle.on('click', function(e) {
        e.preventDefault();
        $mobileMenu.toggleClass('active');
        $body.toggleClass('menu-open');

        // Close search when menu opens
        if ($mobileSearch.hasClass('active')) {
            $mobileSearch.removeClass('active');
        }
    });

    // Mobile search toggle
    $mobileSearchToggle.on('click', function(e) {
        e.preventDefault();
        $mobileSearch.toggleClass('active');

        // Close menu when search opens
        if ($mobileMenu.hasClass('active')) {
            $mobileMenu.removeClass('active');
            $body.removeClass('menu-open');
        }
    });

    // Mobile submenu toggles - COMPLETELY SIMPLIFIED APPROACH
    $(document).on('click', '.mobile-submenu-toggle', function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Use DOM traversal to find the submenu
        const $toggle = $(this);
        const $parentMenuItem = $toggle.closest('.menu-item-has-children');
        const $submenu = $parentMenuItem.find('.mobile-submenu').first();

        console.log('Toggle clicked');
        console.log('Found submenu:', $submenu.length > 0);

        // Toggle icon rotation
        $toggle.find('svg').toggleClass('rotate-180');

        // Toggle submenu visibility
        if ($submenu.length > 0) {
            $submenu.slideToggle(300);
        }
    });

    // Close menu when clicking outside
    $(document).on('click', function(e) {
        if ($mobileMenu.hasClass('active') &&
            !$(e.target).closest('.js-mobile-menu, .js-mobile-menu-toggle').length) {
            $mobileMenu.removeClass('active');
            $body.removeClass('menu-open');
        }

        if ($mobileSearch.hasClass('active') &&
            !$(e.target).closest('.js-mobile-search, .js-mobile-search-toggle').length) {
            $mobileSearch.removeClass('active');
        }
    });

    // Add resize handler to reset mobile menu state when switching to desktop
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 1024 && $mobileMenu.hasClass('active')) {
                $mobileMenu.removeClass('active');
                $body.removeClass('menu-open');
            }
        }, 250);
    });
});
/// ============  end of header =================









var ScrolledRight = 0;
jQuery(document).scroll(function(e) {
    var st = jQuery(this).scrollTop();
    var scrolled = jQuery(this).scrollTop();

    if(st > 100){
        jQuery("header").addClass("active");
    }else{
        jQuery("header").removeClass("active");
    }

});

