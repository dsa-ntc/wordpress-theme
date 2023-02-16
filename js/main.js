// Media Query for "desktop" view
var mq = window.matchMedia( "(min-width: 1024px)" );
	mq.addListener( mqChange );
// End Media Query

var mobilelayout;

$(document).ready(function($) {
	$('#mobile-navbar-toggler').click( function() {
		toggleMobileNav( 'show', $(this).data('target') );
	});
	$('#mobile-navbar .close').click( function() {
		toggleMobileNav( 'hide', '#mobile-navbar' );
	})

	$('.searchsubmit').click( function() {
		$(this).closest('form').submit();
	});

	$('.fLightbox').click( function(e) {
		e.preventDefault();
		caption = $(this).find('figcaption').html();
		modal.open( { content: $(this).attr('href'), mode: 'lightbox', caption: caption } );
	});

	$('.fModal').click( function(e) {
		e.preventDefault();
		modal.open( { content: $(this).attr('href'), mode: 'modal' } );
	});

	mqChange(); // Check the media query rule and load the right layout
});

function toggleMobileNav( status, target ) {
	if ( status == "show" ) {
		// if ( $('#carousel') ) {
		// 	$('#carousel').slick('slickPause');
		// }

		$mobileNav = $(target);
		$mobileNav.show().animate({
			'right' : 0
		}, 500);
	} else if ( status == 'hide' ) {
		$mobileNav = $(target);
		$mobileNav.animate({
			'right' : '-100%'
		}, 500, function(){
			$(this).hide();
			// if ( $('#carousel') ) {
			// 	$('#carousel').slick('slickPlay');
			// }
		});
	}
}

// Super-light modal/lightbox class (furyModal)

/* USAGE
	Lightbox
		HTML:
			<a class="fLightbox" href="https://site.com/image-full.jpg"><img src="image-thumb.jpg"></a>
			- or -
			<a class="fLightbox" href="https://site.com/image-full.jpg">
				<figure>
					<img src="image-thumb.jpg">
					<figcaption>Caption to display in the lightbox</figcaption>
			</a>

	Modal
		HTML:
			<a class="fModal" href="#hiddenelement">Link</a>
			<div class="hidden" id="hiddenelement">Content to display</a>
*/

var modal = ( function(){
	var
	method = {},
	$overlay,
	$modal,
	$content,
	$close;

  // Append the HTML
	$overlay = $('<div id="overlay"></div>');
	$modal = $('<div id="modal"></div>');
	$content = $('<div id="modalcontent"></div>');
	$close = $('<div id="modalclose"><i class="far fa-2x fa-window-close"></i></div>');

	$modal.append( $close, $content );
	$overlay.append( $modal );
	$(document).ready(function(){
	  $('body').append($overlay);
	});

	// Open the modal
	method.open = function( settings ) {
    $('#modalcontent').empty();
		if ( settings.mode == "lightbox" ) {
			$figure = $('<figure>').append( $('<img src="' + settings.content + '" />') );
			$content.append($figure);
      console.log("fig append");
			if ( settings.caption ) {
				$content.append( $('<figcaption>' + settings.caption + '</figcaption>') );
			}
		} else if ( settings.mode == "modal" ) {
			$content.append( $(settings.content).clone() );
		}
		$overlay.fadeIn('fast', function(){
			$modal.slideDown();
		});

		$overlay.bind('click', function(e) {
			if ( ( !($modal.is(e.target)) && $modal.has(e.target).length === 0 ) ) {
				modal.close();
			}
		});

		$close.bind('click', function() {
			modal.close();
		});
	};

	// Close the modal
	method.close = function() {
		$modal.slideUp(function(){
			$overlay.fadeOut('fast', function() {
				$('#modalcontent').empty();
			});
		});
		$overlay.unbind('click');
		$close.unbind('click');
	};

	return method;
}());


function mqChange() {
	if ( mq.matches ) { // If the browser matches the Desktop media query
		/* $('#navmenu').appendTo('#hdrnav');
		$('#navsearch').appendTo('#hdrnav');
		mobilelayout = false; // Set it to not be in a mobile layout

		$(window).unbind('scroll');
		$('#stickylogo').hide(); */
	} else {
		/* $('#navsearch').prependTo('#menucontents');
		$('#navmenu').prependTo('#menucontents');

		var mainlogotop = $('#mainlogo').offset().top;
		var mainlogoheight = $('#mainlogo').height();
		var threshold = mainlogotop + mainlogoheight;

		$(window).scroll(function(){
			if( $(window).scrollTop() > (threshold) ){
			   $("#stickylogo").fadeIn();
			}
			else{
			   $("#stickylogo").fadeOut();
			}
		}); */
	}
}
