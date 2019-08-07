/* global jQuery */
'use strict';

(function($) {
	$(document).ready(function() {

		/**
		 * Subscribe.
		 */
		$('.textwidget .mc4wp-form').slideUp();

		$('.subscribe a.fa-envelope').on('click', function(event) {
			event.preventDefault();
			$(this).parents('.subscribe').next('script').next('.mc4wp-form').slideToggle();
		});

		/**
		 * Podcast timestamps.
		 */
		$('.podcast-jump').on('click', function(e) {
			e.preventDefault();
			var player = $('.podcast_player audio').get(0),
				jumpTime = hmsToSecondsOnly($(this).data('timestamp'));

			player.setCurrentTime(jumpTime);
			player.play();
		});

	});
}(jQuery));
