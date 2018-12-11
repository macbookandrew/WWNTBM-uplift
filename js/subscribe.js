/* global jQuery */
'use strict';

(function($) {
	$(document).ready(function() {
		$('.textwidget .mc4wp-form').slideUp();

		$('.subscribe a.fa-envelope').on('click', function(event) {
			event.preventDefault();
			$(this).parents('.subscribe').next('script').next('.mc4wp-form').slideToggle();
		});
	});
}(jQuery));
