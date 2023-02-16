// JavaScript Document
jQuery(document).ready(function($) {
	if(!Modernizr.inputtypes.date){
		jQuery('input[type=date]').datepicker({
			dateFormat: "mm/dd/yyyy",
			show: "slideDown"
		});
	}

	jQuery('#banner_bgcolor_proxy').wpColorPicker({
		change: function(event, ui) {
			$('#banner_bgcolor_custom').val(ui.color.toString()).prop('checked',true);
		}
	});

	jQuery('#_ept_allday').change( function() {
		if ( this.checked ) {
			jQuery('#_ept_start_time').val('00:00').prop('disabled', true);
			jQuery('#_ept_end_time').val('23:59').prop('disabled', true);
		} else {
			jQuery('#_ept_start_time').prop('disabled', false);
			jQuery('#_ept_end_time').prop('disabled', false);
		};
	});

	jQuery('#_ept_start_date').change( function() {
		if ( Date.parse( jQuery('#_ept_end_date').val() ) < Date.parse( this.value ) ) {
			jQuery('#_ept_end_date').val( this.value );
		};
	});
});