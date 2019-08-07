/* global jQuery */
'use strict';

(function($) {

	/**
	 * Convert timestamp to seconds.
	 *
	 * @param {string} str H:m:s-formatt timestamp.
	 *
	 * @returns {string} Number of seconds.
	 */
	function hmsToSecondsOnly(str) {
		var p = str.split(':'),
			s = 0, m = 1;

		while (p.length > 0) {
			s += m * parseInt(p.pop(), 10);
			m *= 60;
		}

		return s;
	}

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
