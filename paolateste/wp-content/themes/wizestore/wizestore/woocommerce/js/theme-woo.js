jQuery(document).ready(function($) {
	jQuery('.easyzoom').easyZoom();
	gt3_sticky_thumb ();
	gt3_product_carousel_init ();
	gt3_category_accordion ();
	gt3_animate_cart ();
	gt3_spinner_up_down ();
	gt3_size_guide ();
	gt3_sidebar_products_top();
    woocommerce_triger_lightbox();
    gt3_login_register();
});

jQuery(window).load(function() {
	gt3_masonry_shop ();
	var $anim_prod = jQuery(".gt3-animation-wrapper.gt3-anim-product");
	if ($anim_prod.length) {
		gt3_scroll_animation($anim_prod, false);
	}

    gt3_product_single_carousel();
    gt3_sticky_thumb (); // recalc
});

function gt3_masonry_shop () {
	jQuery('.products.shop_grid_masonry').isotope({
		itemSelector: 'li.product',
		sortBy: 'original-order',
		percentPosition: true,
		  masonry: {
		    columnWidth: 1
		  }
	});

	resetShopGrid ();
}
jQuery(window).resize(function($){
	setTimeout( resetShopGrid ,100);
	gt3_sticky_thumb ();
});

function gt3_sticky_thumb () {
	var window_width = jQuery(window).width();
	if (window_width < 768) {
      jQuery('.gt3_sticky_thumb').trigger("sticky_kit:detach");
    } else {
    	jQuery('.gt3_sticky_thumb').stick_in_parent();
    }
}

function resetShopGrid () {
	var width = Math.floor(jQuery('.product-default-width').width()),
		$product = jQuery('.products.shop_grid_masonry.shop_grid_packery li.product');
    $product.each(function () {
		var margin = jQuery(this).parent().hasClass('gap_default') ? 30 : 0;
		switch (true) {
			case jQuery(this).hasClass('large'):
				jQuery(this).height(Math.floor(width * 0.8) * 2 + margin);
				break;
			case jQuery(this).hasClass('large_vertical'):
				jQuery(this).height(Math.floor(width * 0.8) * 2 + margin);
				break;
			default:
				jQuery(this).height(Math.floor(width * 0.8));
				break;
		}
	});
    $product.css('opacity', 1);
	jQuery('.products.shop_grid_masonry.shop_grid_packery .bubblingG').css('opacity', 0);
	jQuery('.products.shop_grid_masonry.shop_grid_packery').isotope('layout');
}

function gt3_product_single_carousel () {
    var $wrap_vert_thumb = jQuery('.gt3_thumb_vertical.gt3_carousel_thumb');
    if ($wrap_vert_thumb.length){
        var $control_wrap = $wrap_vert_thumb.find('.flex-control-nav.flex-control-thumbs');
        var $control_thumb = $wrap_vert_thumb.find('.flex-control-nav.flex-control-thumbs > li');
        var $control_height = $control_thumb.height() + $control_thumb.outerHeight() * 2;
        $control_wrap.css({ 'height': $control_height });

        if ($control_thumb.length > 3){
            $control_wrap.wrap('<div class="gt3_control_wrapper"></div>').before('<span class="gt3_control_prev"></span>').after('<span class="gt3_control_next"></span>');
            $control_wrap = $wrap_vert_thumb.find('.flex-control-nav.flex-control-thumbs');

            $wrap_vert_thumb.find('.flex-control-nav.flex-control-thumbs > li:nth-child(3n + 1)').addClass('point');

            var $position;
            var $currentElement = $control_thumb.first();
            var $thumb_next = $wrap_vert_thumb.find('.gt3_control_next');
            var $thumb_prev = $wrap_vert_thumb.find('.gt3_control_prev');
            $thumb_prev.addClass('hidden');

            $thumb_next.on('click', function() {
                var $nextElement = $currentElement.nextAll('li.point');
                if($nextElement.length) {
                    $currentElement = $nextElement.slice(0, 1);
                    $position = $control_wrap.scrollTop() + $currentElement.position().top;
                    $control_wrap.stop(true).animate({
                        scrollTop: $position
                    }, 600);
                }

                $thumb_prev.removeClass('hidden');
                if($nextElement.length === 1) $thumb_next.addClass('hidden');

                return false;
            });

            $thumb_prev.on('click', function() {
                var $prevElement = $currentElement.prevAll('li.point');
                if($prevElement.length) {
                    $currentElement = $prevElement.slice(0, 1);
                    $position = $control_wrap.scrollTop() + $currentElement.position().top;
                    $control_wrap.stop(true).animate({
                        scrollTop: $position
                    }, 600);
                }

                $thumb_next.removeClass('hidden');
                if($prevElement.length === 1) $thumb_prev.addClass('hidden');

                return false;
            });
        }
    }
}

jQuery( document ).ajaxComplete(function() {
	if( ! jQuery('.gt3-thumbnails-control.slick-slider').length ){
		gt3_thumbnails_slider ();
	}
	var select = jQuery('#yith-quick-view-modal .variations select');
	select.on('change', function(){
		var thumbnails = jQuery('#yith-quick-view-modal .gt3-thumbnails-control');
		var selectEmpty = true;

		select.each(function(){
		    var easyzoom = jQuery("#yith-quick-view-content .woocommerce-product-gallery__image").easyZoom();
			var api = easyzoom.data('easyZoom');
			api.teardown();
			api._init();

			if ( this.value !== '') {
				selectEmpty = false;
			}
		});

		if ( selectEmpty ) {
			thumbnails.css({'height':'auto'});
		} else {
			thumbnails.find('.gt3-thumb-control-item:first').trigger( "click" );
			thumbnails.css({'height':'0'});
		}
	})
});
function gt3_thumbnails_slider () {
	var controls_wrapper, slider, slides, slide, item;
	slider = jQuery('#yith-quick-view-content .woocommerce-product-gallery__wrapper');
	slides = slider.find('.woocommerce-product-gallery__image');
	controls_wrapper = jQuery('<div class="gt3-thumbnails-control"></div>');

	for (var i = 0; i < slides.length; i++) {
		slide = slides[i];
		item = '<div class="gt3-thumb-control-item"><img src="' + jQuery(slide).attr( 'data-thumb' ) + '"></div>';
		controls_wrapper.append(item);
	}

	slider.parent().append(controls_wrapper);

	imagesLoaded(slider.parent(), gt3_vertical_thumb );
	jQuery('#yith-quick-view-content .woocommerce-product-gallery__image').easyZoom();
}

function gt3_vertical_thumb (){
	jQuery('#yith-quick-view-content').each(function(){
		var cur_slidesToShow = 1;
		var cur_sliderAutoplay = 4000;
		var cur_fade = true;

		jQuery(this).find('.woocommerce-product-gallery__wrapper').slick({
			slidesToShow: cur_slidesToShow,
			slidesToScroll: cur_slidesToShow,
			autoplay: false,
			autoplaySpeed: cur_sliderAutoplay,
			speed: 500,
			dots: false,
			fade: cur_fade,
			focusOnSelect: true,
			arrows: false,
			infinite: false,
			asNavFor: jQuery(this).find('.gt3-thumbnails-control')
		});
		jQuery(this).find('.gt3-thumbnails-control').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			nextArrow: '<i class="slick-next fa fa-angle-right"></i>',
			prevArrow: '<i class="slick-prev fa fa-angle-left"></i>',
			asNavFor: jQuery(this).find('.woocommerce-product-gallery__wrapper'),
			dots: false,
			focusOnSelect: true,
			infinite: false
		});
		var x = jQuery(this).find('.woocommerce-product-gallery')[0];
		jQuery(x).addClass('ready');
	});
}
function gt3_product_carousel_init () {
	jQuery('.cross-sells .products').slick({
		autoplay: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		nextArrow: '<i class="slick-next fa fa-angle-right"></i>',
  		prevArrow: '<i class=" slick-prev fa fa-angle-left"></i>',
		dots: false,
		infinite: false,
		responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1
		      }
		    }
		]
	})
}

function gt3_scroll_animation($el, newItem) {
    var order = 0
      , lastOffsetTop = 0;
    jQuery.each($el, function(index) {
        var el = jQuery(this);
        el.imagesLoaded(function() {
            var elOffset = el.offset()
              , windowHeight = jQuery(window).outerHeight()
              , delay
              , offset = 20;
            if (elOffset.top > (windowHeight + offset)) {
                if (order === 0) {
                    lastOffsetTop = elOffset.top;
                } else {
                    if (lastOffsetTop !== elOffset.top) {
                        order = 0;
                        lastOffsetTop = elOffset.top;
                    }
                }
                order++;
                index = order;
            }
            delay = index * 0.20;
            el.css({
                'transition-delay': delay + 's'
            });
            el.attr('data-delay', delay);
            el.attr('data-delay', delay);
        });
    });
    $el.appear(function() {
        var el = jQuery(this)
          , windowScrollTop = jQuery(window).scrollTop();
        if (newItem) {
            el.addClass('loaded');
        } else {
            var addLoaded = setTimeout(function() {
                el.addClass('loaded');
            }, 300);
            if (windowScrollTop > 100) {
                clearTimeout(addLoaded);
                el.addClass('loaded');
            }
        }
        var elDur = el.css('transition-duration')
          , elDelay = el.css('transition-delay')
          , timeRemove = elDur.split('s')[0] * 1000 + elDelay.split('s')[0] * 1000 + 4000
          , notRemove = '.wil-progress';
        el.not(notRemove).delay(timeRemove).queue(function() {
            el.removeClass('loaded gt3-anim-product').dequeue();
        });
        el.delay(timeRemove).queue(function() {
            el.css('transition-delay', '');
        });
    }, {
        accX: 0,
        accY: 30
    });
}

function gt3_category_accordion () {
	jQuery('.widget_product_categories').each(function(){
		var elements = jQuery(this).find('.product-categories>li.cat-parent');
		for (var i = 0; i < elements.length; i++) {
			jQuery(elements[i]).append("<span class=\"gt3-button-cat-open\"></span>");
		}
	});
	jQuery(".gt3-button-cat-open").on("click", function () {
		jQuery(this).parent().toggleClass('open');
		if (jQuery(this).parent().hasClass('open')) {
			jQuery(this).parent().children('.children').slideDown();
		} else {
			jQuery(this).parent().children('.children').slideUp();
		}
	})
}

/* Cart Count Icon Animation */
function gt3_animate_cart () {
	jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
		this.each(function() {
			for (var x=1; x<=intShakes; x++) {
				jQuery(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
				.animate({left:intDistance}, ((intDuration/intShakes)/2))
				.animate({left:0}, (((intDuration/intShakes)/4)));
			}
		});
		return this;
	};
	jQuery(document.body).on('added_to_cart', function(){
		setTimeout(function(){
			jQuery(".gt3_header_builder_cart_component").addClass("show_cart");
			jQuery(".woo_mini-count").shake(3,1.2,300);
		}, 300);
		setTimeout(function(){
			jQuery(".gt3_header_builder_cart_component").removeClass("show_cart");
		}, 2800);
    });
}

/* Input spinner */
function gt3_spinner_up_down () {
	var $body = jQuery('body');
    $body.on('tap click', '.gt3_qty_spinner .quantity-up', function() {
        var input = jQuery(this).parent().find('input[type="number"]'),
            max = input.attr('max'),
            oldValue = parseFloat(input.val()),
            newVal;
		if (oldValue >= max && '' !== max) {
			newVal = oldValue;
		} else {
			newVal = oldValue + 1;
		}
		input.val(newVal);
		input.trigger("change");
	});
    $body.on('tap click', '.gt3_qty_spinner .quantity-down, .gt3_qty_spinner .quantity-down', function() {
        var input = jQuery(this).parent().find('input[type="number"]'),
            min = input.attr('min'),
            oldValue = parseFloat(input.val()),
            newVal;
		if (oldValue <= min && '' !== min) {
			newVal = oldValue;
		} else {
			newVal = oldValue - 1;
		}
		input.val(newVal);
		input.trigger("change");
	});
}

function gt3_size_guide() {
	jQuery('.gt3_block_size_popup').on('tap click', function(){
		var $popup = jQuery('.image_size_popup');
        $popup.addClass('active');
		if ($popup.hasClass('active')) {
			jQuery(document).keyup(function(e) {
				if (e.keyCode === 27) jQuery('.image_size_popup').removeClass('active');
			});
			jQuery('.image_size_popup .layer, .image_size_popup .close').on('tap click', function(){
				jQuery('.image_size_popup').removeClass('active');
			});
		}
	});
}

function gt3_sidebar_products_top(){
	var button = jQuery('.gt3_woocommerce_top_filter_button ');
	var element = jQuery('.gt3_top_sidebar_products');
	if ( jQuery(window).width() < 480) {
		button.on('tap click', function(e){
			e.preventDefault();
			if (element.hasClass('active')) {
				sidebar_close();
			}else{
				sidebar_open();
			}
		});
	} else {
		button.on('tap click', function(e){
			e.preventDefault();
			if (element.hasClass('active')) {
		        sidebar_close();
			}else{
				sidebar_open();
			}
		});
		jQuery(document).on('mouseup', function (e) {
			e.preventDefault();
			if ( element.hasClass('active') && element.has(e.target).length === 0 && button.has(e.target).length === 0 ){
				sidebar_close();
			}
		});
		jQuery(document).keyup(function(e) {
			if (e.keyCode === 27){
				sidebar_close();
			}
		});
	}
	function sidebar_open(){
		button.addClass('active');
		element.addClass('active');
		element.slideDown(300)
	}
	function sidebar_close(){
		button.removeClass('active');
		element.removeClass('active');
		element.slideUp(400)
	}
}

function woocommerce_triger_lightbox() {
	jQuery('.woocommerce-product-gallery:not(.gt3_thumb_grid) .woocommerce-product-gallery__wrapper').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        jQuery('.woocommerce-product-gallery:not(.gt3_thumb_grid) .woocommerce-product-gallery__trigger').trigger( "click" );
    });
}

function gt3_login_register(){
    var $modal = jQuery('.gt3_header_builder__login-modal');
    if (!jQuery('body').hasClass('woocommerce-account') && $modal.find('.woocommerce-error').length){
        $modal.addClass('active');
    }
}
