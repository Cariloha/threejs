jQuery(document).ready(function () {

	function ajax_load_publications(page) {
		if (!jQuery('body').hasClass('loading-record')) {
			jQuery('body').addClass('loading-record');
			
			var filter = jQuery('form[data-js-form="filter"]').serialize();
			console.log(filter);
			
			var data = {
				page: page,
				data: filter,
				action: "pagination-load-publication"
			}

			jQuery.ajax({
				url: wp_ajax.ajax_url,
				type: 'POST',
				data: data,
				success: function (response) {
					jQuery('#publications-content').html(response);
					 jQuery('body').removeClass('loading-record');
				},
				error: function (response) {
					console.warn(response);
				},

			});
		}
	  }
		
		// onchange page
		jQuery(document).on('click', '#publications-content ul li a.page-link', function (e) {
			e.preventDefault();
			var page = jQuery(this).attr('data-page');
			ajax_load_publications(page);
		});
		
		// onchange filter
		jQuery(document).on('change', 'form[data-js-form=filter]', function (e) {
			e.preventDefault();
			ajax_load_publications(1);
		});
});
		
	