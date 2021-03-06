jQuery(function($){
    /*
	*
	* Custom Functions
	*
	*/
	shop = {};

    shop.scrollTargets = '.tag-banner-wave'; // comma separated like a jquery selector

    shop.lastScrollPos = $(window).scrollTop();

    shop.headerAnimationDown = function(){
        var scrollPos = $(window).scrollTop();
        if($(window).width() > 741){
            if(scrollPos > 90){
                if (scrollPos >= shop.lastScrollPos){
                    $('html').removeClass('scroll-up').addClass('scroll-down scrolling scrolled');
                } else {
                    $('html').removeClass('scroll-down').addClass('scroll-up scrolling scrolled');
                }
            } else {
                $('html').removeClass('scroll-up scroll-down scrolling');
            }
        } else {
            $('html').removeClass('scroll-up scroll-down scrolling scrolled');
        }
        shop.lastScrollPos = scrollPos;
    }

    shop.animateContent = function(){
		$(shop.scrollTargets).each(function(){
			if($(window).scrollTop() + $(window).innerHeight() > $(this).offset().top + ($(window).innerHeight()/4)){
				$(this).addClass('animated');
			}
		});
		$(shop.scrollTargets).each(function(){
			if($(window).scrollTop() + $(window).innerHeight() > $(this).offset().top + ($(window).innerHeight()/2)){
				$(this).addClass('animated');
			}
		});
	}

	shop.selectLink = function(){
		$('.cat-select').on('change', function(){
			var target = $(this).val();
			if(target){
				window.location.href = target;
			}
		});
	}

	shop.targetBlank = function(){
		/* Make all External Links and PDF's open in a new Tab */
	    var host = new RegExp('/' + window.location.host + '/');
	    $('a').each(function() {
		    if ((!host.test(this.href) && this.href.slice(0, 1) != "/" && this.href.slice(0, 1) != "#" && this.href.slice(0, 1) != "?") || this.href.indexOf('.pdf') > 0) {
			    $(this).attr({'target': '_blank'});
		    }
		});
	}

	shop.setupModaal = function(){
		$('.block-link-video').modaal({
			type: 'video',
		});
		$('.block-link-inline').modaal();
		$('.modaal-inline').modaal();
	}

	shop.menuTrigger = function(){
		$('.menu-trigger').on('click', function(e){
			e.preventDefault();
			$('html').toggleClass('menu-active');
			return false;
		});
	}

    shop.smoothScroll = function(){
        // Remove the # from the hash, as different browsers may or may not include it
        var hash = location.hash.replace('#','');
        console.log(hash);
        if(hash != ''){
            scrollOffset = ($(window).width() < 600) ? 420 : 100;
            // Clear the hash in the URL
            // location.hash = '';   // delete front "//" if you want to change the address bar
            $('html, body').animate({ scrollTop: $('#'+hash).offset().top - scrollOffset}, 1000);
            $('#'+hash).css('color', '#FF4E50');
        }
    }

	/*
	* End Functions
	*/

	/*
	*
	*	Place items in here to have them run after the Dom is ready
	*
	*/
	$(document).ready(function(){
        shop.headerAnimationDown();
		shop.animateContent();

        var mySwiper = new Swiper ('.swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            autoHeight: true,
            parallax: true,

            // If we need pagination
            pagination: {
              el: '.tag-swiper-pagination',
              clickable: true,
            },

            // Navigation arrows
            navigation: {
              nextEl: '.tag-swiper-next',
              prevEl: '.tag-swiper-prev',
            },
        });
		$('a.social-icons__icon').attr('target', '_blank');
	});

	/*
	*
	*	Place items in here to have them run the page is loaded
	*
	*/
	$(window).load(function() {
		shop.headerAnimationDown();
        shop.smoothScroll();
	});

	/*
	*
	*	Place items in here to have them run when the window is scrolled
	*
	*/
	$(window).scroll(function() {
		shop.headerAnimationDown();
		shop.animateContent();
	});

	/*
	*
	*	Place items in here to have them run when the window is resized
	*
	*/
	$(window).resize(function() {
		shop.animateContent();
	});
});
