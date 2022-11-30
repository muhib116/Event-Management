(function($){
	$(document).ready(function() {	

		// Scroll to Top
		jQuery('.scrollto-top').click(function(){
			jQuery('html').animate({'scrollTop' : '0px'}, 400);
			return false;
		});
		
		jQuery(window).scroll(function(){
			var upto = jQuery(window).scrollTop();
			if(upto > 500) {
				jQuery('.scrollto-top').fadeIn();
			} else {
				jQuery('.scrollto-top').fadeOut();
			}
		});

		jQuery(".quantity span").click(function() {
			jQuery(this).prev().addClass("quantity-color")
		});

		jQuery(".stich-btn input").click(function() {
			jQuery(".stich-btn").toggleClass("clr")
		});

		jQuery(".filter-item h4").click(function() {
			jQuery(this).next().slideToggle()
			jQuery(this).toggleClass("toggle-arrow")
		});


		// owlCarousel
		$("#owl-csel1").owlCarousel({
			items: 4,
			autoplay: true,
			autoplayTimeout: 3500,
			startPosition: 0,
			rtl: false,
			loop: true,
			margin: 15,
			dots: true,
			nav: true,
			navText: [
						'<i class="fas fa-chevron-left"></i>',
						'<i class="fas fa-chevron-right"></i>'
					],
			navContainer: '.main-content .custom-nav',
			responsive:{
				0: {
					items: 1,						
				},
				767: {
					items: 1,						
				},
				768: {
					items: 2,						
				},
				992: {
					items: 3,						
				},

				1200: {
					items: 4,						
				}
			}

		});

		$("#owl-csel2").owlCarousel({
			items: 4,
			autoplay: true,
			autoplayTimeout: 4500,
			startPosition: 0,
			rtl: false,
			loop: true,
			margin: 15,
			dots: true,
			nav: true,
			navText: [
						'<i class="fas fa-chevron-left"></i>',
						'<i class="fas fa-chevron-right"></i>'
					],
			navContainer: '.main-content2 .custom-nav',
			responsive:{
				0: {
					items: 1,						
				},
				767: {
					items: 1,						
				},
				768: {
					items: 2,						
				},
				992: {
					items: 3,						
				},

				1200: {
					items: 4,						
				}
			}

		});

		$("#owl-csel3").owlCarousel({
			items: 4,
			autoplay: true,
			autoplayTimeout: 4000,
			startPosition: 0,
			rtl: false,
			loop: true,
			margin: 15,
			dots: true,
			nav: true,
			navText: [
						'<i class="fas fa-chevron-left"></i>',
						'<i class="fas fa-chevron-right"></i>'
					],
			navContainer: '.main-content3 .custom-nav',
			responsive:{
				0: {
					items: 1,						
				},
				767: {
					items: 1,						
				},
				768: {
					items: 2,						
				},
				992: {
					items: 3,						
				},

				1200: {
					items: 4,						
				}
			}

		});

		$('.datepicker_1').Zebra_DatePicker();
		

	
		
		
	});
})(jQuery);