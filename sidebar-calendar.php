<?php
	$keywords = !empty( $_GET['keywords'] ) ? $_GET['keywords'] : '';
	$datefilter = !empty( $_GET['dates'] ) ? $_GET['dates'] : '';
	$location = !empty( $_GET['location'] ) ? $location = $_GET['location'] : '';
?>
<aside id="sidebar">
	<section id="eventfilters">
		<h2>Event <strong>Filters</strong></h2>
		<form action="<?php bloginfo('siteurl'); ?>/calendar/" id="eventcalfilterform" method="get" onReset="clearFilters()">
			<section id="eventcalkeywordfilter">
				<label for="keywords">Keywords</label>
				<input type="text" id="eventcalkeywords" name="keywords" value="<?php echo $keywords; ?>" />
			</section>
			<section id="eventcaldatefilter">
				<label for="dates">Date</label>
				<input type="hidden" id="eventcaldates" name="dates" value="<?php echo $datefilter; ?>" />
				<div id="eventcaldatepicker">
					<div id="datepickeryears">
						<div class="placeholder">
							<span id="prevyear"><i class="far fa-fw fa-arrow-circle-left"></i></span>
						</div><!-- .placeholder -->
						<span id="datepickeryear" class="text-xl"><input id="yearvalue" type="text" disabled="true" /></span>
						<div class="placeholder">
							<span id="nextyear"><i class="far fa-fw fa-arrow-circle-right"></i></span>
						</div><!-- .placeholder -->
					</div><!-- #datepickeryears -->
					<div id="datepickermonths"></div>
					<script type="text/javascript">
						var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
						window.d = new Date();

						if ( $('#eventcaldates').val() ) {
							var olddate = new Date( parseInt($('#eventcaldates').val()) );
							var year = olddate.getFullYear();
							var month = olddate.getMonth();
							var dateFiltered = true;
						} else {
							var year = d.getFullYear();
							var month = d.getMonth();
						};

						$('#yearvalue').val(year).change();
						if ( $('#yearvalue').val() >= d.getFullYear() - 1 ) {
							$('#prevyear').fadeIn();
						}
						if ( $('#yearvalue').val() <= d.getFullYear() + 1 ) {
							$('#nextyear').fadeIn();
						}

						for (var i = 0; i < monthNames.length; i++ ) {
							$('#datepickermonths').append('<div data-month=' + i + '>' + monthNames[i].substr(0,3) + '</div>');
						};

						if ( dateFiltered ) {
							$('#datepickermonths div[data-month=' + month + ']').addClass('filteredmonth', 500);
						};

						$('#prevyear').click( function() {
							var newYear = parseInt( $('#yearvalue').val() ) - 1;
							$('#yearvalue').val(newYear).change();
						});

						$('#nextyear').click( function() {
							var newYear = parseInt( $('#yearvalue').val() ) + 1;
							$('#yearvalue').val(newYear).change();
						});

						$('#yearvalue').change( function() {
							if ( $(this).val() <= d.getFullYear() - 2 ) {
								$('#prevyear').fadeOut();
							} else {
								$('#prevyear').fadeIn();
							}

							if ( $(this).val() >= d.getFullYear() + 2 ) {
								$('#nextyear').fadeOut();
							} else {
								$('#nextyear').fadeIn();
							}

							if ( $(this).val() == year ) {
								$('div[data-month=' + month + ']').addClass('filteredmonth', 500);
							} else {
								$('div[data-month=' + month + ']').removeClass('filteredmonth', 500);
							}
						});

						$('#datepickermonths div').click( function() {
							if ( year == $('#yearvalue').val() && month == $(this).attr('data-month') ) {
								$(this).removeClass('filteredmonth', 500);
								year = "";
								month = "";
								$('#eventcaldates').val('');
							} else {
								year = $('#yearvalue').val();
								month = $(this).attr('data-month');
								$('.filteredmonth').removeClass('filteredmonth', 500);
								$(this).addClass('filteredmonth', 500);
								var newdate = new Date((parseInt(month)+1) + ' 1, ' + year);
								$('#eventcaldates').val(newdate.getTime());
							}
						});

						function clearFilters(){
							$('#eventcalkeywords').val("");
							$('#eventcaldates').val("");
							$('form#eventcalfilterform').submit();
						}
					</script>
				</div>
			</section>
			<section id="eventcalbuttons" class="space-top-1x">
				<input type="submit" id="eventcalfiltersubmit" value="Search" class="btn btn-red mr-3" />
				<input type="button" id="eventcalfilterclear" value="Clear" onClick="clearFilters()" class="btn btn-outline-dark" />
			</section><!-- #eventcalbuttons -->
		</form>
	</section>
</aside>
