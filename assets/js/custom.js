/**	
	* Template Name: Intensely
	* Version: 1.0	
	* Template Scripts
	* Author: MarkUps
	* Author URI: http://www.markups.io/

	Custom JS
	
	1. SEARCH BOX SLIDE
	2. HOVER DROPDOWN MENU
	3. BOOTSTRAP ACCORDION
	4. SKILL PROGRESS BAR
	5. MIXIT SLIDER
	6. FANCYBOX
	7. MAIN SLIDER (SLICK SLIDER)
	8. LOGIN MODAL WINDOW
	9. COUNTER
	10. TESTIMONIAL SLIDER (SLICK SLIDER)
	11. CLIENTS BRAND SLIDER (SLICK SLIDER) 
	12. SCROLL TOP BUTTON
	13. PRELOADER 
	14. WOW ANIMATION	
	
**/

jQuery(function($){

	/* ----------------------------------------------------------- */
	/*  1. SEARCH BOX SLIDE
	/* ----------------------------------------------------------- */ 

	$('#search-icon').click(function(e){
		e.preventDefault();
		$('.header-top').slideToggle(300);
		$('#m_search').focus();
	});
	
			
	/* ----------------------------------------------------------- */
	/*  2. HOVER DROPDOWN MENU
	/* ----------------------------------------------------------- */ 
	
	// for hover dropdown menu
	$('ul.nav li.dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(150).fadeIn(200);
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(150).fadeOut(200);
	});

	/* ----------------------------------------------------------- */
	/*  3. BOOTSTRAP ACCORDION
	/* ----------------------------------------------------------- */ 
	
	$('#accordion .panel-collapse').on('shown.bs.collapse', function () {
		$(this).prev().find(".fa").removeClass("fa-plus-square").addClass("fa-minus-square");
	});
	
	$('#accordion .panel-collapse').on('hidden.bs.collapse', function () {
		$(this).prev().find(".fa").removeClass("fa-minus-square").addClass("fa-plus-square");
	});	

	/* ----------------------------------------------------------- */
	/*  4. SKILL PROGRESS BAR
	/* ----------------------------------------------------------- */ 

	if ($.fn.progressbar && $('.progress .progress-bar').length) {
		$('.progress .progress-bar').progressbar({
			display_text: 'center',
			percent_format: function(p) { return p + ' %'; }
		});
	}

	/* ----------------------------------------------------------- */
	/*  5. MIXIT SLIDER
	/* ----------------------------------------------------------- */  	

	if ($.fn.mixItUp && $('#mixit-container').length) {
		$('#mixit-container').mixItUp();
	}
		
	/* ----------------------------------------------------------- */
	/*  6. FANCYBOX 
	/* ----------------------------------------------------------- */

	if ($.fn.fancybox && $('.fancybox').length) {
		$(".fancybox").fancybox();
	}

	/* ----------------------------------------------------------- */
	/*  7. MAIN SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */

	if ($.fn.slick && $('.main-slider').length) {
		$('.main-slider').slick({
			dots: true,
			infinite: true,
			speed: 500,
			autoplay: true,
			accessibility: false,
			fade: true,
			cssEase: 'linear'
		});
	}

	/* ----------------------------------------------------------- */
	/*  8. LOGIN MODAL WINDOW
	/* ----------------------------------------------------------- */

	$("#signup-btn").on('click', function(e){
		$('#signup-content').show();
		$('#login-content').hide();
		e.preventDefault();		
	});

	$("#login-btn").on('click', function(e){
		$('#login-content').show();
		$('#signup-content').hide();
		e.preventDefault();
	});

	/* ----------------------------------------------------------- */
	/*  9. COUNTER
	/* ----------------------------------------------------------- */ 

	if ($.fn.counterUp && $('.counter').length) {
		$('.counter').counterUp({
			delay: 10,
			time: 1000
		});
	}

	/* ----------------------------------------------------------- */
	/*  10. TESTIMONIAL SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	if ($.fn.slick && $('.testimonial-slider').length) {
		$('.testimonial-slider').slick({
			dots: true,
			infinite: true,
			speed: 500,
			autoplay: true,		
			cssEase: 'linear'
		});
	}

	/* ----------------------------------------------------------- */
	/*  11. CLIENTS BRAND SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	if ($.fn.slick && $('.clients-brand-slide').length) {
		$('.clients-brand-slide').slick({
			dots: false,
			infinite: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			autoplay: true,	
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	}

	/* ----------------------------------------------------------- */
	/*  12. SCROLL TOP BUTTON
	/* ----------------------------------------------------------- */

	$(window).scroll(function(){
		if ($(this).scrollTop() > 300) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});	   
	   
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0}, 600);
		return false;
	});

	/* ----------------------------------------------------------- */
	/*  13. PRELOADER 
	/* ----------------------------------------------------------- */ 
	
	function dismissPreloader() {
		$('#status').fadeOut();
		$('#preloader').fadeOut('slow');
		$('body').css({'overflow':'visible'});
	}
	$(window).on('load', dismissPreloader);
	setTimeout(dismissPreloader, 800);

	/* ----------------------------------------------------------- */
	/*  14. WOW ANIMATION
	/* ----------------------------------------------------------- */ 

	if (typeof WOW !== 'undefined') {
		var wow = new WOW({
			animateClass: 'animated',
			offset: 100,
			live: true
		});
		wow.init();
	}

	/* ----------------------------------------------------------- */
	/*  15. COOKIE CONSENT BANNER (POINT 17)
	/* ----------------------------------------------------------- */
	var cookieConsent = localStorage.getItem('lean_green_cookie_consent');
	if (!cookieConsent) {
		setTimeout(function() {
			$('#cookieConsentBanner').fadeIn(350);
		}, 600);
	}

	$('#acceptCookiesBtn').on('click', function() {
		localStorage.setItem('lean_green_cookie_consent', 'accepted');
		$('#cookieConsentBanner').fadeOut(300);
	});

	$('#declineCookiesBtn').on('click', function() {
		localStorage.setItem('lean_green_cookie_consent', 'declined');
		$('#cookieConsentBanner').fadeOut(300);
	});

	/* ----------------------------------------------------------- */
	/*  16. FORM VALIDATION & LOADING STATES (POINTS 12 & 13)
	/* ----------------------------------------------------------- */
	$('form').on('submit', function(e) {
		var $form = $(this);
		var $submitBtn = $form.find('button[type="submit"], input[type="submit"]');
		var isValid = true;

		// Clear previous errors
		$form.find('.input-error').removeClass('input-error');
		$form.find('.form-error-feedback').remove();

		// Check required fields
		$form.find('input[required], textarea[required], select[required]').each(function() {
			var $input = $(this);
			var val = $.trim($input.val());
			if (!val) {
				isValid = false;
				$input.addClass('input-error');
				$input.after('<div class="form-error-feedback"><i class="fa fa-exclamation-circle"></i> This field is required</div>');
			} else if ($input.attr('type') === 'email') {
				var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				if (!emailPattern.test(val)) {
					isValid = false;
					$input.addClass('input-error');
					$input.after('<div class="form-error-feedback"><i class="fa fa-exclamation-circle"></i> Please enter a valid email</div>');
				}
			}
		});

		if (!isValid) {
			e.preventDefault();
			return false;
		}

		// Activate loading spinner on submit button
		if ($submitBtn.length && !$form.hasClass('no-loading-state')) {
			$submitBtn.addClass('btn-loading').prop('disabled', true);
		}
	});

	// Remove error highlight on user input
	$('form').on('input change', 'input, textarea, select', function() {
		$(this).removeClass('input-error');
		$(this).siblings('.form-error-feedback').fadeOut(150, function() { $(this).remove(); });
	});
	
});