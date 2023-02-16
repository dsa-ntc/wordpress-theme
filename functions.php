<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
ini_set('log_errors','Off');
//ini_set('error_log','php-errors.log');
//error_reporting(E_ALL);
require get_template_directory() . '/bootstrap-navwalker.php';
// Remove the WP Emoji stuff
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Additional header cleanup
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Start a PHP Session
add_action('init', 'start_session', 1);
function start_session() {
    if(!session_id()) {
        session_start();
    }
}

// Add Theme Customization Support
register_default_headers([
	'dsalogo' => [
		'url'           => '%s/img/logo-main.svg',
		'thumbnail_url' => '%s/img/logo-thumb.png',
		'description'   => 'DSA Logo'
	]
]);

// Configure the Theme
add_action( 'after_setup_theme', 'theme_setup' );
function theme_setup() {
	add_theme_support( 'html5' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', [ 'image', 'video' ] );
	add_theme_support( 'custom-header', [ 'default-image' => get_template_directory_uri() . '/img/headerlogo-400x400.png' ]  );
}

add_action( 'init', 'register_menus' );
function register_menus() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
	register_nav_menu('footer-menu',__( 'Footer Menu' ));
}

function dsaveeone_widget_support() {
	// Register Main Sidebar Widget Area
	register_sidebar( array(
		'name'          => 'Standard Sidebar',
		'id'            => 'standard_sidebar',
		'before_widget' => '<section>',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
		)
	);

	// Register Front Page Sub-Banner Widget Area
	register_sidebar( array(
		'name'          => 'Front Page Sub-Banner',
		'id'            => 'frontpage_subbanner',
		'before_widget' => '<section id="subbanner">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
	) );

	// Register Front Page Above Footer Widget Area
	register_sidebar( array(
		'name'          => 'Above Footer',
		'id'            => 'above_footer',
		'before_widget' => '<section id="above_footer_widgets" class="fullwidth-widgets">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
	) );

	// Register Footer Widget Area
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'before_widget' => '<section id="footer_widgets" class="fullwidth-widgets">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
	) );

	// Register Contact Page Sidebar Widget
	register_sidebar( array(
		'name'          => 'Contact Form Sidebar',
		'id'            => 'contact',
		'before_widget' => '<section>',
		'after_widget'  => '</section>',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>',
	) );

	// For each custom post type, register a unique widget area
	$cpts = get_post_types( [
		'_builtin' => false,
		'exclude_from_search' => false,
	], 'objects' );

	foreach ( $cpts as $cpt ) :
		register_sidebar( array(
			'name'          => "{$cpt->labels->singular_name} Sidebar",
			'id'            => $cpt->name,
			'before_widget' => '<section>',
			'after_widget'  => '</section>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
		) );

		register_sidebar( array(
			'name'          => "{$cpt->labels->singular_name} Archive Sidebar",
			'id'            => $cpt->name . '_archive',
			'before_widget' => '<section>',
			'after_widget'  => '</section>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
		) );
	endforeach;
}
add_action( 'widgets_init', 'dsaveeone_widget_support' );

// Queue and load javascript and stylesheet resources into the WordPress engine
add_action( 'wp_enqueue_scripts', 'load_scripts' );
function load_scripts()	{
	$templatedirectory = get_template_directory_uri();

	wp_enqueue_script( 'font-awesome', '//pro.fontawesome.com/releases/v5.2.0/js/all.js' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', "//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" );
	wp_enqueue_script( 'jquery' );

	// Bootstrap stuff
	wp_enqueue_style( 'bootstrap', "//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" );
	wp_enqueue_script( 'popper-js', "//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js", [], null, true );
	wp_enqueue_script( 'bootstrap', "//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js", [ 'jquery' ], null, true );

	wp_enqueue_style( 'main-style', $templatedirectory . '/style.css');

	wp_register_script( 'dsaveeone-jsfunctions', $templatedirectory . '/js/main.js', array( 'jquery' ) );
	wp_enqueue_script( 'dsaveeone-jsfunctions');


  // Swiper library for carousel on homepage
  if ( is_home() ) :
    wp_enqueue_style( 'swiper', $templatedirectory . '/assets/swiper/swiper.min.css' );
    wp_register_script( 'swiper', $templatedirectory . '/assets/swiper/swiper.min.js' );
    wp_enqueue_script( 'swiper' );
  endif;

	// Load slick.js if it's the homepage
	if ( is_home() ) :
		wp_enqueue_style( 'slick', $templatedirectory . '/assets/slick/slick.css');
		wp_enqueue_style( 'slick-theme', $templatedirectory . '/assets/slick/slick-theme.css');
		wp_enqueue_script( 'slick', $templatedirectory . '/assets/slick/slick.min.js', array('jquery') );
	endif;
	// Load Google ReCaptcha only on the contact page and volunteer page
	if ( is_page_template('template-contact.php') ) :
		wp_register_script( 'recaptcha', '//www.google.com/recaptcha/api.js' );
		wp_enqueue_script( 'recaptcha');
	endif;
}

add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );
function load_admin_scripts() {
	$templatedirectory = get_template_directory_uri();

	wp_enqueue_style( 'jquery-ui-admin', $templatedirectory . '/assets/jquery-ui-1.12.1.custom.admin/jquery-ui.min.css');
	wp_register_script( 'jquery-ui-admin', $templatedirectory . '/assets/jquery-ui-1.12.1.custom.admin/jquery-ui.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-ui-admin' );

	wp_register_script( 'dsaveeone-modernizr', $templatedirectory . '/js/modernizr-custom.js' );
	wp_enqueue_script( 'dsaveeone-modernizr');

	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );

	wp_register_script( 'dsaveeone-adminjs', $templatedirectory . '/js/admin.js', array( 'dsaveeone-modernizr', 'jquery-ui-admin' ) );
	wp_enqueue_script( 'dsaveeone-adminjs');

	wp_enqueue_style( 'admin-style', $templatedirectory . '/admin.css');
}

// Defer certain scripts to load after the page has rendered
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
function add_defer_attribute($tag, $handle) {
	// add script handles to the array below
	$scripts_to_defer = array('slick', 'font-awesome', 'dsaveeone-jsfunctions', 'recaptcha');

	foreach($scripts_to_defer as $defer_script) {
	   if ($defer_script === $handle) {
		  return str_replace(' src', ' defer="defer" src', $tag);
	   }
	}
	return $tag;
 }

// RSS Stuff
// Add the relevant post types to the feed
function rssfeed_request( $query ) {
    if ( isset($query['feed']) && ! isset($query['post_type']) ) :
		$query['post_type'] = array( 'news', 'statement', 'pressrelease', 'orgblog', 'blog', 'event', );
		return $query;
	else :
		return $query;
	endif;
}
add_filter('request', 'rssfeed_request');

// Remove "Post" type posts from the Admin area (and also comments). This ensures users create the proper custom post type to have it show up in the appropriate areas
function hide_posts_menu() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action( 'admin_menu', 'hide_posts_menu' );

// Common metaboxes across post types
function add_common_meta() {
	$posttypes = [ 'news', 'statement', 'pressrelease', 'orgblog', 'blog' ];
	add_meta_box( 'common_mb_info', 'Additional Post Info', 'common_mb_info', $posttypes, 'side' );
}
add_action( 'add_meta_boxes', 'add_common_meta' );

function common_mb_info( $post ) {
	global $post;
?>
	<h2>Post Content Author</h2>
	<p class="smallnote">The information entered here will be displayed on the site. If you wish to attribute a post to a specific person, specify their name here.</p>
	<div class="inputwrapper">
		<label for="_content_author">Author Name:</label><input type="text" name="_content_author" id="_content_author" value="<?php echo get_post_meta($post->ID, '_content_author', true); ?>" />
	</div>
	<div class="inputwrapper">
		<label for="_content_author_bio">Author Bio:</label>
		<?php wp_editor( get_post_meta($post->ID, '_content_author_bio', true), "_content_author_bio", [ 'teeny' => true, 'media_buttons' => false, 'textarea_rows' => 5 ] ); ?>
	</div>
<?php
		wp_nonce_field( basename( __FILE__ ), 'common_nonce' );
}

function common_mb_save_meta( $post_id ){
	if ( !isset( $_POST['common_nonce'] ) || !wp_verify_nonce( $_POST['common_nonce'], basename( __FILE__ ) ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;

	global $post;
	$posttypes = [ 'news', 'statement', 'pressrelease', 'orgblog', 'blog' ];
	if ( ! in_array($post->post_type, $posttypes) ) return;

	$fields = [
		'_content_author',
		'_content_author_bio'
	];

	foreach ( $fields as $field ) :
		if ( isset($_POST[$field]) ) :
			update_post_meta( $post_id, $field, $_POST[$field] );
		else :
			delete_post_meta( $post_id, $field );
		endif;
	endforeach;
}
add_action( 'save_post', 'common_mb_save_meta' );

function add_featured_image_instruction( $content ) {
	return $content .= '<p>For front page banners, the recommended dimensions for images is 1200px x 400px (or larger, but maintaining the same 3:1 aspect ratio). Note that the sides of the image may be "cropped" as the browser width is reduced; the image will also be shrunk on mobile devices, so use of small text is not recommended.</p>';
}
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');

// Custom Walker class for semantically-correct(er) navigation menus
class Fury_Nav_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<div class='sub-menu sub-menu-$depth'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "</div>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array)$item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '';
		$attributes  =
			! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '' .
			! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '' .
			! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '' .
			! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= ($depth ? '' : '<div' . $class_names .'>') . '<a'. $attributes . ( $depth ? $class_names : '') .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $item, $depth = 0, $args = [] ) {
		$output .= ($depth ? '' : '</div>'). "\n";
	}
}

// Custom Post Type: Blog
add_action('init','create_blog_posts', 0);

function create_blog_posts() {
	$blogname = get_theme_mod( 'blog_name', 'Blog');

	register_post_type( 'blog', [
		'labels' => [
			'name' => $blogname,
			'singular_name' => "$blogname Post",
			'add_new_item' => "New $blogname Post",
			'edit_item' => "Edit $blogname Post",
			'view_item' => "View $blogname Post"
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'query_var' => true,
		'menu_icon' => 'dashicons-media-document',
		'rewrite' => [ 'slug' => get_theme_mod('blog_slug', 'blog'), 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Blog

// Custom Post Type: Front Page Banner
if ( get_theme_mod( 'enable_cpt_banner', false ) ) :
	add_action( 'init', 'create_banner_posts' );
	add_action( 'save_post', 'banner_mb_save_meta' );
endif;

function create_banner_posts() {
	register_post_type( 'banner', [
		'labels' => [
			'name' => 'Front Page Banners',
			'singular_name' => 'Banner',
			'add_new_item' => 'Add New Banner',
			'edit_item' => 'Edit Banner',
			'view_item' => 'View Banner'
		],
		'description' => 'Banners are displayed at the top of the home page. If more than one banner is published, they are displayed in a carousel.',
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => [ 'title','editor', 'thumbnail', 'post-formats' ],
		'register_meta_box_cb' => 'banner_metaboxes'
	] );
}

function banner_metaboxes() {
	add_meta_box( 'banner_mb_link', 'Full banner link', 'banner_mb_link', 'banner', 'normal' );
	add_meta_box( 'banner_mb_bgcolor', 'Background color', 'banner_mb_bgcolor', 'banner', 'side' );
	add_meta_box( 'banner_mb_bgimage', 'Image positioning', 'banner_mb_bgimage', 'banner', 'side' );
	add_meta_box( 'banner_mb_overlay', 'Content overlay', 'banner_mb_overlay', 'banner', 'side' );
}

function banner_mb_link( $post ) {
	global $post;
	$oldValue = get_post_meta( $post->ID, '_banner_linkurl', true );
	echo '<input type="checkbox" id="banner_link" name="banner_link" value="true" ' . ( $oldValue ? 'checked' : '' ) .  ' /><label class="needsmargin" for="banner_link">Full Banner is a Link</label>';
	if ( $oldValue ) :
		echo '<p class="smallnote">Current link is: ' . $oldValue . '</p>';
	endif;
	echo '<p>If this box is checked, clicking anywhere in the banner will link to the <em>first</em> link in the content field. This is useful for banners that are "Image" post types; you define the "Featured Image" as the banner graphic, and then insert a single link in the content body.</p>';
	wp_nonce_field( basename( __FILE__ ), 'banner_nonce' );
}

function banner_mb_bgcolor( $post ) {
	global $post;
	$oldValue = get_post_meta( $post->ID, '_banner_bgcolor', true );
	$defaultColors = array( "#ec1f27", "#ffffff", "#f0f0f0", "#323232", "#000000" );
	foreach ( $defaultColors as $color ) :
?>
		<label class="text-fw" style="width:80px; display: inline-block;"><input type="radio" value="<?php echo $color; ?>" name="banner_bgcolor" <?php checked($oldValue, $color); ?>><?php echo $color; ?><div style="display: inline-block; width: 50px; height: 1em; vertical-align: text-bottom; margin-left: 10px; background-color: <?php echo $color; ?>"></div></label><br />
<?php
	endforeach;
?>
	<label style="width:80px; display: inline-block;"><input type="radio" name="banner_bgcolor" <?php echo ( in_array($oldValue,$defaultColors) ? '' : 'checked' ); ?> id="banner_bgcolor_custom">Custom: </label><input id="banner_bgcolor_proxy" type="text"  value="<?php echo $oldValue; ?>">
<?php
}

function banner_mb_bgimage( $post ) {
	global $post;
	$position = get_post_meta( $post->ID, '_banner_bgimage_position', true );
	if ( ! $position ) $position = 'stretch';
?>
	<input id="_banner_bgimage_position_cover" type="radio" name="_banner_bgimage_position" value="cover" <?php checked($position, 'cover'); ?>/><label for="_banner_bgimage_position_cover">Stretch background image (default)</label><br />
	<input id="_banner_bgimage_position_contain" type="radio" name="_banner_bgimage_position" value="contain" <?php checked($position, 'contain'); ?>/><label for="_banner_bgimage_position_contain">Contain background image</label><br />
<?php
}

function banner_mb_overlay( $post ) {
	if (! get_theme_mod('show_banner') ) : // Don't bother showing this if the banner/carousel isn't configured to show.
		echo '<em>This theme is not configured to show the "Featured" banner, so there are no settings to configure.</em>';
		return;
	endif;

	$position = get_post_meta( $post->ID, '_banner_overlay_position', true );
	if ( ! $position ) $position = 'left';
?>
	<h2>Content Overlay Position</h2>
	<input id="_banner_overlay_position_bl" type="radio" name="_banner_overlay_position" value="left" <?php checked($position, 'left'); ?>/><label for="_banner_overlay_position_bl">Bottom Left (default)</label><br />
	<input id="_banner_overlay_position_br" type="radio" name="_banner_overlay_position" value="right" <?php checked($position, 'right'); ?>/><label for="_banner_overlay_position_br">Bottom Right</label><br />
	<input id="_banner_overlay_position_tl" type="radio" name="_banner_overlay_position" value="top left" <?php checked($position, 'top left'); ?>/><label for="_banner_overlay_position_tl">Top Left</label><br />
	<input id="_banner_overlay_position_tr" type="radio" name="_banner_overlay_position" value="top right" <?php checked($position, 'top right'); ?>/><label for="_banner_overlay_position_tr">Top Right</label><br />
	<input id="_banner_overlay_position_fwbtm" type="radio" name="_banner_overlay_position" value="fullwidth" <?php checked($position, 'fullwidth'); ?>/><label for="_banner_overlay_position_fwbtm">Full-width across bottom</label><br />
	<input id="_banner_overlay_position_full" type="radio" name="_banner_overlay_position" value="fullarea" <?php checked($position, 'fullarea'); ?>/><label for="_banner_overlay_position_full">Full overlay (center-aligned)</label><br />
<?php
}

function banner_mb_save_meta( $post_id ) {
	if ( isset($_POST['post_type']) && $_POST['post_type'] != 'banner' ) return;
	if ( !isset( $_POST['banner_nonce'] ) || !wp_verify_nonce( $_POST['banner_nonce'], basename( __FILE__ ) ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;

	$newValue = $_POST['banner_bgcolor'];
	$oldValue = get_post_meta( $post_id, '_banner_bgcolor', true );

	if ( $newValue && $newValue != $oldValue ) :
		update_post_meta( $post_id, '_banner_bgcolor', $newValue );
	elseif ( $newValue == '' && $oldValue ) :
		delete_post_meta( $post_id, '_banner_bgcolor' );
	endif;

	if ( isset($_POST['banner_link']) ) :
		$pattern = '/<a.*href=(?:\'|\")(.*?)(?:\'|\")>/';
		$string = stripslashes($_POST['content']);
		if ( preg_match( $pattern, $string, $matches ) ) :
			update_post_meta( $post_id, '_banner_linkurl', $matches[1] );
		endif;
	else :
		delete_post_meta( $post_id, '_banner_linkurl' );
	endif;

	update_post_meta( $post_id, '_banner_overlay_position', key_exists('_banner_overlay_position', $_POST) ? $_POST['_banner_overlay_position'] : 'left' );

	update_post_meta( $post_id, '_banner_bgimage_position', key_exists('_banner_bgimage_position', $_POST) ? $_POST['_banner_bgimage_position'] : 'stretch' );
}

// End Custom Post Type: Front Page Banner

// Custom Post Type: News Posts
if ( get_theme_mod('enable_cpt_news', false) ) :
	add_action( 'init', 'create_news_posts', 0 );
	add_action( 'save_post', 'news_mb_save_meta' );
endif;

function create_news_posts() {
	register_post_type( 'news', [
		'labels' => [
			'name' => 'News',
			'singular_name' => 'News Post',
			'add_new_item' => 'Add New News Post',
			'edit_item' => 'Edit News Post',
			'view_item' => 'View News Post'
		],
		'description' => 'News posts. If the post is set to "announcement", it will display on the front page.',
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'rewrite' => [ 'slug' => 'news', 'with_front' => false ],
		'has_archive' => true,
		'menu_icon' => 'dashicons-welcome-write-blog',
		'supports' => [ 'title','editor', 'thumbnail', 'post-formats' ],
		'register_meta_box_cb' => 'news_metaboxes'
	] );
}

function news_metaboxes() {
	add_meta_box( 'news_mb_announcement', 'Announcement Options', 'news_mb_announcement', 'news', 'normal' );
}

function news_mb_announcement( $post ) {
	global $post;
?>
	<p>Announcements are displayed prominently on the home page. Standard "news" posts are displayed in the sidebar (and in the archive).</p>
	<ul>
		<li>
			<input type="radio" name="_news_posttype" id="_news_posttype_news" value="news" <?php echo ( ( get_post_meta( $post->ID, '_news_posttype', true ) == 'news' ) ? " checked " : null ); ?>>
			<label for="_news_posttype_news">News Post</label>
		</li>
 		<li>
		 	<input type="radio" name="_news_posttype" id="_news_posttype_ann"value="ann" <?php echo ( ( get_post_meta( $post->ID, '_news_posttype', true ) == 'announcement' ) ? " checked " : null ); ?>>
			<label for="_news_posttype_ann">Announcement</label>
		</li>
	</ul>
	<h3>Announcement Details</h3>
	<input type="checkbox" id="news_ann_urgent" name="_news_ann_urgent" <?php echo ( ( get_post_meta( $post->ID, '_news_ann_urgent', true ) == 'true' ) ? " checked " : null ); ?> value="true" /><label class="needsmargin" for="news_ann_urgent">Urgent?</label>
	<hr />
<?php
	$expiration_date = ( get_post_meta($post->ID, '_news_ann_expiration', true) ? get_post_meta($post->ID, '_news_ann_expiration', true) : strtotime( date('Y-m-d') . ' + 14 days') );
	$expiration_date = date('Y-m-d', $expiration_date );
?>
	<label for="_news_ann_expiration">Expiration Date:</label><input type="date" id="news_ann_expiration" name="_news_ann_expiration" value="<?php echo $expiration_date; ?>" />
	<hr />
	<input type="checkbox" id="ann_showfullonfp" <?php echo ( get_post_meta( $post->ID, '_news_ann_showfullonfp', true ) ? 'checked' : '' ); ?> name="_news_ann_showfullonfp"><label for="news_ann_showfullonfp">Show full announcement on front page?</label>

	<?php wp_nonce_field( basename( __FILE__ ), 'news_ann_nonce' ); ?>
<?php
}

function news_mb_save_meta( $post_id ) {
	if ( !isset( $_POST['news_ann_nonce'] ) || !wp_verify_nonce( $_POST['news_ann_nonce'], basename( __FILE__ ) ) ) return;

	if ( isset($_GET['post_type']) && $_POST['post_type'] != 'news' ) return;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	if ( !current_user_can( 'edit_post', $post_id ) ) return;

	// Save post type
	switch ( $_POST['_news_posttype'] ) :
		case ('ann') :
			$post_type = "announcement";
			break;
		case ('news'):
		default:
			$post_type = "news";
			break;
	endswitch;
	update_post_meta( $post_id, '_news_posttype', $post_type );

	// If it's a news post, clear out the announcement metadata, just for cleanliness
	if ( $post_type == "news" ) :
		foreach ( ['_news_ann_urgent', '_news_ann_expiration', '_news_ann_showfullonfp'] as $ann_field ) :
			delete_post_meta( $post_id, $ann_field );
		endforeach;
	else: // If it's an announcement post, save/update the metadata
		// Urgency
		$new_value = $_POST['_news_ann_urgent'];
		$old_value = get_post_meta( $post_id, '_news_ann_urgent', true );
		if ( $new_value && $new_value != $old_value ) :
			update_post_meta( $post_id, '_news_ann_urgent', $new_value );
		elseif ( $new_value == '' && $old_value ) :
			delete_post_meta( $post_id, '_news_ann_urgent' );
		endif;

		// Expiration
		$new_value = strtotime($_POST['_news_ann_expiration']);
		$old_value = get_post_meta( $post_id, '_news_ann_expiration', true );
		if ( $new_value && $new_value != $old_value ) :
			update_post_meta( $post_id, '_news_ann_expiration', $new_value );
		elseif ( $new_value == '' && $old_value ) :
			delete_post_meta( $post_id, '_news_ann_expiration' );
		endif;

		// Show full announcement on front page
		if ( isset( $_POST['_news_ann_showfullonfp'] ) ) :
			$new_value = True;
		else :
			$new_value = False;
		endif;
		update_post_meta( $post_id, '_news_ann_showfullonfp', $new_value );
	endif;
}
// End Custom Post Type: News

// Custom Post Type: Statement
if ( get_theme_mod('enable_cpt_statement', false) ) :
	add_action( 'init', 'create_statement_posts', 0 );
endif;

function create_statement_posts() {
	register_post_type( 'statement', [
		'labels' => [
			'name' => 'Statements',
			'singular_name' => 'Statement',
			'add_new_item' => 'New Statement',
			'edit_item' => 'Edit Statement',
			'view_item' => 'View Statement'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Statements',
		'query_var' => true,
		'menu_icon' => 'dashicons-format-aside',
		'rewrite' => [ 'slug' => 'statements', 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Statement

// Custom Post Type: Press Release
if ( get_theme_mod('enable_cpt_pressrelease', false) ) :
	add_action( 'init', 'create_pressrelease_posts', 0 );
endif;

function create_pressrelease_posts() {
	register_post_type( 'pressrelease', [
		'labels' => [
			'name' => 'Press Releases',
			'singular_name' => 'Press Release',
			'add_new_item' => 'New Press Release',
			'edit_item' => 'Edit Press Release',
			'view_item' => 'View Press Release'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Press Releases',
		'query_var' => true,
		'menu_icon' => 'dashicons-microphone',
		'rewrite' => [ 'slug' => 'pressreleases', 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Press Release

// Custom Post Type: Organizing Blog
if ( get_theme_mod('enable_cpt_orgblog', false) ) :
	add_action( 'init', 'create_orgblog_posts', 0 );
endif;

function create_orgblog_posts() {
	register_post_type( 'orgblog', [
		'labels' => [
			'name' => 'Organizing Blog Posts',
			'singular_name' => 'Organizing Blog Post',
			'add_new_item' => 'New Organizing Blog Post',
			'edit_item' => 'Edit Organizing Blog Post',
			'view_item' => 'View Organizing Blog Post'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Organizing Blog Posts for Members',
		'query_var' => true,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'rewrite' => [ 'slug' => 'organize', 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Organizing Blog

// Custom Post Type: Socialist Strategy
if ( get_theme_mod('enable_cpt_strategy', false) ) :
	add_action( 'init', 'create_strategy_posts', 0 );
endif;

function create_strategy_posts() {
	register_post_type( 'strategy', [
		'labels' => [
			'name' => 'Socialist Strategy Articles',
			'singular_name' => 'Socialist Strategy Article'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Socialist Strategy Articles',
		'query_var' => true,
		'menu_icon' => 'dashicons-clipboard',
		'rewrite' => [ 'slug' => 'strategy', 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Socialist Strategy

// Custom Post Type: Fact Sheets
if ( get_theme_mod('enable_cpt_factsheet', false) ) :
	add_action( 'init', 'create_factsheet_posts', 0 );
endif;

function create_factsheet_posts() {
	register_post_type( 'factsheet', [
		'labels' => [
			'name' => 'Fact Sheets',
			'singular_name' => 'Fact Sheet',
			'add_new_item' => 'New Fact Sheet',
			'edit_item' => 'Edit Fact Sheet',
			'view_item' => 'View Fact Sheet'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Organizing Blog Posts for Members',
		'query_var' => true,
		'menu_icon' => 'dashicons-analytics',
		'rewrite' => [ 'slug' => 'factsheets', 'with_front' => true ],
		'has_archive' => true
	] );
}
// End Custom Post Type: Fact Sheets

// Custom Post Type: National Updates
if ( get_theme_mod('enable_cpt_natlupdate', false) ) :
	add_action( 'init', 'create_natlupdate_posts', 0 );
endif;

function create_natlupdate_posts() {
	register_post_type( 'natlupdate', [
		'labels' => [
			'name' => 'National Updates',
			'singular_name' => 'National Update',
			'add_new_item' => 'New National Update',
			'edit_item' => 'Edit National Update',
			'view_item' => 'View National Update'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'National Update Newsletters for Members',
		'query_var' => true,
		'menu_icon' => 'dashicons-megaphone',
		'rewrite' => [ 'slug' => 'national-updates', 'with_front' => true ],
		'has_archive' => true
	] );
}
// END NATIONAL UPDATES POST TYPE

// Custom Post Type: The Stacks
if ( get_theme_mod('enable_cpt_stacks', false) ) :
	add_action( 'init', 'create_stacks_posts', 0 );
endif;

function create_stacks_posts() {
	register_post_type( 'stacks', [
		'labels' => [
			'name' => 'The Stacks',
			'singular_name' => 'Stacks Issue',
			'add_new_item' => 'New Stacks Issue',
			'edit_item' => 'Edit Stacks Issue',
			'view_item' => 'View Stacks Issue'
		],
		'supports' => [ 'title', 'editor', 'author', 'excerpt', 'thumbnail' ],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'The Stacks is a periodical publication',
		'query_var' => true,
		'menu_icon' => 'dashicons-layout',
		'rewrite' => [ 'slug' => 'stacks', 'with_front' => true ],
		'has_archive' => true
	] );
}
// END THE STACKS POST TYPE

// Event Calendar Functionality
	// Custom Post Type: Event
if ( get_theme_mod('enable_cpt_event', false) ) :
	add_action( 'init', 'create_event_posts', 0 );
	add_action( 'save_post', 'ept_mb_save_meta' );
endif;

function create_event_posts() {
	register_post_type( 'event', [
		'labels' => [
			'name' => 'Events',
			'singular_name' => 'Event',
			'add_new_item' => 'Add New Event',
			'edit_item' => 'Edit Event',
			'view_item' => 'View Event'
		],
		'public' => true,
		'show_in_rest' => true, // Gutenberg editor support
		'description' => 'Posts that contain information pertaining to an event, such as a conference or meeting.',
		'query_var' => true,
		'menu_icon' => 'dashicons-calendar-alt',
		'has_archive' => true,
		'rewrite' => [ 'slug' => 'calendar', 'with_front' => false ],
		'register_meta_box_cb' => 'ept_metaboxes'
	] );
}

// This is only needed if using the default archive page for events (register_post_type with the "has_archive" flag). Currently using a custom page template to serve as the event post archive/calendar
function ept_archive_modify($query){
	if(is_post_type_archive( "event" ) && $query->is_main_query() ):

		if ( !empty( $_GET['keywords'] ) ) $keywords = $_GET['keywords'];
		if ( !empty( $_GET['dates'] ) )  $datefilter = $_GET['dates'];

		if ( isset($datefilter) ) :
			$startdate = new DateTime();
			$startdate->setTimestamp( $datefilter / 1000 );
			$enddate = new DateTime( $startdate->format('Y-m-t') );
			$arrayEndAfter = array(
				'key' => '_ept_end_timestamp',
				'value' => $startdate->format('U'),
				'compare' => '>='
			);
			$arrayEndBefore = array(
				'key' => '_ept_end_timestamp',
				'value' => $enddate->format('U'),
				'compare' => '<='
			);
			$meta_query = array(
				'relation' => 'AND',
				$arrayEndBefore,
				$arrayEndAfter
			);
		else :
			$meta_query = array (
					array(
						'key' => '_ept_end_timestamp',
						'value' => time(),
						'compare' => '>='
					)
			);
		endif;
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );
		$query->set( 'meta_key', '_ept_start_timestamp' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_query', $meta_query );

		if ( !empty( $keywords ) ) :
			$query->set( 's', $keywords );
		endif;
	endif;
};
add_action( 'pre_get_posts', 'ept_archive_modify');

function ept_metaboxes() {
	add_meta_box( 'ept_mb_datetime', 'Event Date and Time', 'ept_mb_datetime', 'event', 'side', 'default' );
	add_meta_box( 'ept_mb_location', 'Event Location', 'ept_mb_location', 'event', 'side', 'default' );
	add_meta_box( 'ept_mb_moreinfo', 'Event More Info', 'ept_mb_moremeta', 'event', 'side', 'default' );
}

function ept_mb_datetime( $post ) {
	global $post;

	// Retrieve the post's timezone if it's set; if not, default to the WordPress timezone. If *that's* not set, use GMT to avoid an error.
	$tzString = get_post_meta( $post->ID, '_ept_timezone', true );
	if ( !$tzString ) :
		$tzString = get_option('timezone_string') ? get_option('timezone_string') : 'GMT' ;
	endif;
	$tz  = new DateTimeZone( $tzString );

	echo '<h2>Time Zone</h2>';
	create_timezone_dropdown("USthenAll", "_ept_timezone", $tzString );

	$tsvalue = get_post_meta( $post->ID, '_ept_start_timestamp', true );
	$timestamp = new DateTime( ( $tsvalue ? '@' . $tsvalue : 'now' ) );
	$timestamp->setTimezone( $tz );

	$date = $timestamp->format('Y-m-d');
	$time = $timestamp->format('H:i');
	$alldayevent = get_post_meta( $post->ID, '_ept_allday', true );
?>
	<h2>Start Date and Time</h2>
	<div class="inputwrapper multi">
		<input type="date" name="_ept_start_date" id="_ept_start_date" value="<?php echo $date; ?>" />
		<input type="time" name="_ept_start_time" id="_ept_start_time" value="<?php echo $time; ?>" />
	</div>

	<div class="inputwrapper">
		<input type="checkbox" name="_ept_allday" id="_ept_allday" <?php checked($alldayevent,'on'); ?> />
		<label for="_ept_allday" class="radio">All day event?</label>
	</div>
<?php
	$tsvalue = get_post_meta( $post->ID, '_ept_end_timestamp', true );
	$timestamp = new DateTime( ( $tsvalue ? '@' . $tsvalue : 'now' ) );
	$timestamp->setTimezone( $tz );

	$date = $timestamp->format('Y-m-d');
	$time = $timestamp->format('H:i');
	$alldayevent = get_post_meta( $post->ID, '_ept_allday', true );
?>
	<h2>End Date and Time</h2>
	<div class="inputwrapper multi">
		<input type="date" name="_ept_end_date" id="_ept_end_date" value="<?php echo $date; ?>" />
		<input type="time" name="_ept_end_time" id="_ept_end_time" value="<?php echo $time; ?>" />
	</div>
<?php

	wp_nonce_field( basename( __FILE__ ), 'event_nonce' );
}

function ept_mb_location( $post ) {
	global $post;

	echo '<h2>Physical Venue</h2>';
	$addressvalues = [
		"venue" => array( "Venue Name", get_post_meta( $post->ID, '_ept_venue', true ) ),
		"street" => array( "Street Address", get_post_meta( $post->ID, '_ept_street', true ) ),
		"city" => array( "City", get_post_meta( $post->ID, '_ept_city', true ) ),
		"state" => array( "State", get_post_meta( $post->ID, '_ept_state', true ) ),
		"zip" => array( "Zip Code", get_post_meta( $post->ID, '_ept_zip', true ) )
	];

	foreach ( $addressvalues as $key => list($label, $val ) ) :
?>
		<div class="inputwrapper">
			<label for="_ept_<?php echo $key; ?>"><?php echo $label; ?>:</label>
			<input type="text" name="_ept_<?php echo $key; ?>" id="_ept_<?php echo $key; ?>" placeholder="<?php echo $label; ?>" <?php echo ( $val ? 'value="'.$val.'"' : '' ); ?>/>
		</div>
<?php
	endforeach;

	echo '<h2>Call/Digital Info</h2>';
	$confvalues = [
		"conflink" => array( "Conference Link (URL)", get_post_meta( $post->ID, '_ept_conflink', true ) ),
		"confnum" => array( "Conference Dial-In Number", get_post_meta( $post->ID, '_ept_confnum', true ) )
	];

	foreach ( $confvalues as $key => list($label, $val ) ) :
?>
		<div class="inputwrapper">
			<label for="_ept_<?php echo $key; ?>"><?php echo $label; ?>:</label>
			<input type="text" name="_ept_<?php echo $key; ?>" id="_ept_<?php echo $key; ?>" placeholder="<?php echo $label; ?>" <?php echo ( $val ? 'value="'.$val.'"' : '' ); ?>/>
		</div>
<?php
	endforeach;
}

function ept_mb_moremeta( $post, $args ) {
	$metabox = array(
		[
			'label' => 'More Info Link',
			'name' => 'moreinfo'
		],
		[
			'label' => 'RSVP Link',
			'name' => 'rsvplink'
		],
		[
			'label' => 'Organizer Name (Not Published)',
			'name' => 'organizer'
		],
		[
			'label' => 'Organizer Email (Not Published)',
			'name' => 'organizer_email'
		]
		);
	foreach ( $metabox as $field ) :
		$event_meta = get_post_meta( $post->ID, '_ept_' . $field['name'], true );
		echo '<div class="inputwrapper"><label for ="_ept_'. $field['name'] . '">' . $field['label'] . ': </label><input type="text"  class="fullwidth" id="_ept_' . $field['name'] . '" name="_ept_' . $field['name'] . '" placeholder="' . $field['label'] . '" value="' . $event_meta . '" /></div>';
	endforeach;
}

function ept_mb_save_meta( $post_id ) {
	if ( !isset( $_POST['event_nonce'] ) || !wp_verify_nonce( $_POST['event_nonce'], basename( __FILE__ ) ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;

	$tzstring = get_option('timezone_string');

	$starttimestamp = strtotime( $_POST["_ept_start_date"] . ' ' . $_POST['_ept_start_time'] . $tzstring );
	update_post_meta( $post_id, '_ept_start_timestamp', $starttimestamp );
	$endtimestamp = strtotime( $_POST["_ept_end_date"] . ' ' . $_POST['_ept_end_time'] . $tzstring );
	update_post_meta( $post_id, '_ept_end_timestamp', $endtimestamp );

	$metafields = array( "timezone","allday","venue", "street", "city", "state", "zip", "confnum", "organizer", "organizer_email" );
	foreach ( $metafields as $key ) :
		if ( array_key_exists('_ept_' . $key, $_POST) ) :
			update_post_meta( $post_id, '_ept_' . $key, $_POST['_ept_' . $key]);
		else :
			delete_post_meta( $post_id, '_ept_' . $key );
		endif;
	endforeach;

	$metalinkfields = array( "conflink", "moreinfo", "rsvplink" );
	foreach ( $metalinkfields as $key ) :
		if ( array_key_exists('_ept_' . $key, $_POST) ) :
			update_post_meta( $post_id, '_ept_' . $key, format_url($_POST['_ept_' . $key], 'proper') );
		else :
			delete_post_meta( $post_id, '_ept_' . $key );
		endif;
	endforeach;
}
// End Custom Post Type: Event

// Supporting functions
function list_time_zones($region = "all") {

	$utcTime = new DateTime('now', new DateTimeZone('UTC'));

	switch ( $region ) :
		case "US":
			$tzIds = [
				"USA" => DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US')
			];
			break;
		case "USthenAll":
			$tzIds = [
				"USA" => DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US'),
				"All" => DateTimeZone::listIdentifiers(DateTimeZone::ALL)
			];
			break;
		default:
			$tzIds = [
				"All" => DateTimeZone::listIdentifiers()
			];
			break;
	endswitch;

	$tzList = [];
	foreach ( $tzIds as $tzRegion => $tzIdList ) :
		$tempTzs = array();
		foreach ($tzIdList as $tzId) :
			$currentTz = new DateTimeZone($tzId);

			$tempTzs[] = array(
				'offset' => (int)$currentTz->getOffset($utcTime),
				'identifier' => $tzId
		);
		endforeach;

		// Sort the array by offset,identifier ascending
		usort($tempTzs, function($a, $b) {
			return ($a['offset'] == $b['offset'])
				? strcmp($a['identifier'], $b['identifier'])
				: $a['offset'] - $b['offset'];
		});

		foreach ($tempTzs as $tz) :
			$sign = ($tz['offset'] > 0) ? '+' : '-';
			$offset = gmdate('H:i', abs($tz['offset']));
			$tzList[$tzRegion][$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
				$tz['identifier'];
		endforeach;
	endforeach;

	return $tzList;
}

function create_timezone_dropdown( $region = "all", $dropdown_name = "timezone", $select_value ) {
	$timezones = list_time_zones($region);
	echo '<select name="' . $dropdown_name . '">';
	foreach ( $timezones as $region => $zones ) :
		echo '<optgroup label="' . $region . '">' . "\n";
		foreach ( $zones as $value => $label ) :
			echo '<option' . selected($value, $select_value) . ' value="' . $value . '">' . str_replace('_', ' ', $label) . '</option>' . "\n";
		endforeach;
		echo '</optgroup>' . "\n" ;
	endforeach;
	echo '</select>';
}

function ept_delete_all_events() {
	$events = new WP_Query( array(
		'post_type' => 'event'
	));
	while ( $events->have_posts() ) {
		$events->the_post();
		wp_delete_post( $events->post->ID, true );
	}
}
//add_action( 'admin_init', 'ept_delete_all_events' ); // This is for troubleshooting options

// Get the Month Abbreviation
function ept_get_the_month_abbr( $month ) {
	global $wp_locale;
	for ( $i = 1; $i < 13; $i = $i +1 ) :
		if ( $i == $month ) :
			$monthabbr = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
		endif;
	endfor;

	return $monthabbr;
}
function ept_the_month_abbr( $month ) {
	echo ept_get_the_month_abbr( $month );
}

// Display the date
function ept_get_the_event_date($format = "fullstring") {
	global $post;

	$tzstring = get_post_meta( $post->ID, '_ept_timezone', true );
	$tz = new DateTimeZone($tzstring);
	$ustzs = [
		"America/New_York",
		"America/Chicago",
		"America/Denver",
		"America/Los_Angeles"
	];

	$starttimestamp = new DateTime( '@'. get_post_meta($post->ID, '_ept_start_timestamp', true) );
	$starttimestamp->setTimeZone($tz);
	$endtimestamp = new DateTime( '@'. get_post_meta($post->ID, '_ept_end_timestamp', true) ) ;
	$endtimestamp->setTimeZone($tz);

	$starttimefortzs = clone $starttimestamp;
	foreach ( $ustzs as $ustz ) :
		$starttimefortzs->setTimeZone( new DateTimeZone($ustz) );
		$start_us_tzs[] = $starttimefortzs->format('g:i A T');
	endforeach;
	$start_us_tzs = implode(' / ', $start_us_tzs );

	$starthour = $starttimestamp->format('G');
	if ( $starthour >= 12 ) :
		$starthour = $starthour - 12;
		$ampm = 'PM';
	elseif ( $starthour = 0 ) :
		$starthour = 12;
		$ampm = 'AM';
	else :
		$ampm = 'AM';
	endif;
	$startdate = '';
	$startmonth = $starttimestamp->format('n');
	$startdate = $starttimestamp->format( ( $format=="fullwithday" ? 'l, M' : 'M') );

	$fullarray = [
		"timezone" => $starttimestamp->format("T"),
		"date_span" => ($starttimestamp->format('Y-m-d') == $endtimestamp->format('Y-m-d') ?
			$starttimestamp->format('l, F jS, Y') :
			$starttimestamp->format('D M j, Y') . ' - ' . $endtimestamp->format('D M j, Y')
		),
		"time_span" => ($starttimestamp->format('g:i a') == $endtimestamp->format('g:i a') ?
			$starttimestamp->format('g:i A') :
			$starttimestamp->format('g:i A') . ' - ' . $endtimestamp->format('g:i A')
		),
		"start_us_tzs" => $start_us_tzs,
		"start_time" => $starttimestamp->format("g:i A"),
		"start_time_tz" => $starttimestamp->format("g:i A T"),
		"start_date" => $starttimestamp->format("Y-m-d"),
		"start_date_us" => $starttimestamp->format("m/d/Y"),
		"start_date_fs" => $starttimestamp->format("M j"),
		"start_Y" => $starttimestamp->format("Y"),
		"start_m" => $starttimestamp->format("m"),
		"start_F" => $starttimestamp->format("F"),
		"start_M" => $starttimestamp->format("M"),
		"start_d" => $starttimestamp->format("d"),
		"start_D" => $starttimestamp->format("D"),
		"start_l" => $starttimestamp->format("l"),
		"end_time" => $endtimestamp->format("g:i A"),
		"end_time_tz" => $endtimestamp->format("g:i A T"),
		"end_date" => $endtimestamp->format("Y-m-d"),
		"end_date_us" => $endtimestamp->format("m/d/Y"),
		"end_date_fs" => $endtimestamp->format("M j"),
		"end_Y" => $endtimestamp->format("Y"),
		"end_m" => $endtimestamp->format("m"),
		"end_F" => $endtimestamp->format("F"),
		"end_M" => $endtimestamp->format("M"),
		"end_d" => $endtimestamp->format("d"),
		"end_D" => $endtimestamp->format("D"),
		"end_l" => $endtimestamp->format("l")
	];

	switch ( $format ) :
		case "fullstring":
		case "fullwithday":
			if ( get_post_meta($post->ID, '_ept_allday', true) != 'checked' ) :
				$startdate .= ' ' . $starttimestamp->format('j, Y');
				$startdate .= ' at ' . $starttimestamp->format('g:i A T');
				$eventdate = $startdate;
			else :
				if ( $starttimestamp->format('Y-m-d') == $endtimestamp->format('Y-m-d') ) :
					$startdate .= ' ' . $starttimestamp->format('j, Y');
					$eventdate = $startdate;
				elseif ( $starttimestamp->format('Y-m') == $endtimestamp->format('Y-m') && $starttimestamp->format('j') != $endtimestamp-format('j') ) :
					$startdate .= ' ' . $starttimestamp-format('j - ') . $endtimestamp->format('j, Y');
					$eventdate = $startdate;
				elseif ( $starttimestamp-format('Y-m-d') != $endtimestamp->format('Y-m-d') ) :
					$startdate .= ' ' . $starttimestamp->format('j, Y');
					$endmonth = $endtimestamp->format('n');
					$enddate . $endtimestamp->format('M j, Y');
					$eventdate = "$startdate - $enddate";
				endif;
			endif;
			return $eventdate;
			break;
		case "startday":
			break;
		case "starttime":
			break;
		case "endday":
			break;
		case "array":
			return $fullarray;
	endswitch;
}
function ept_the_event_date($format="fullstring") {
	echo ept_get_the_event_date($format);
}

// Get the venue
function ept_get_the_event_location( $format = 'long' ) {
	global $post;
	$meta = [];
	foreach ( [ "venue", "street", "city", "state", "zip" ] as $field ) :
		$meta[$field] = get_post_meta( $post->ID, '_ept_' . $field, true );
	endforeach;

	if ( $format == 'long' ) : // I collapsed the line breaks on these, just to make them look more confusing. Wheee!
		$address = implode(" - ",array_filter([$meta['venue'],implode( ", ",array_filter([$meta['street'],$meta['city'],implode(" ",array_filter( [$meta ['state'],$meta['zip']]))]))]));
	elseif ( $format == 'short' ) :
		$address = implode(" - ",array_filter( [$meta['venue'],implode(", ",array_filter([$meta['city'],$meta['state']]))]));
	endif;

	return $address;
}
function ept_the_event_location( $format = 'long' ) {
	echo ept_get_the_event_location($format);
}

function ept_get_the_conf_info( $format = 'full' ) {
	global $post;
	$conflink = get_post_meta( $post->ID, '_ept_conflink', true );
	$confnum = get_post_meta( $post->ID, '_ept_confnum', true );
	$link = $num = null;

	if ($conflink) :
		if ( preg_match( '/zoom\.us/', $conflink ) ) :
			$platform = "Zoom Meeting";
		elseif ( preg_match( '/webex\.com/', $conflink ) ) :
			$platform = "WebEx Meeting";
		else :
			$platform = format_url( $conflink, 'host' );
		endif;
		$link = '<a href="' . $conflink . '" target="_blank">'. $platform . '</a>';
	endif;

	if ($confnum) :
		$num = '<a href="tel:' . $confnum . '">' . $confnum . '</a>';
	endif;

	switch ( $format ) :
		case 'full' :
			return $link . ( $conflink && $confnum ? ' - ' : '' ) . $num;
			break;
	endswitch;

}
function ept_the_conf_info( $format = 'full' ) {
	echo ept_get_the_conf_info($format);
}

	// Pull events from ActionKit
function get_ak_events() {
	$creds = get_credential( 'AK Event Calendar' );
	$ak_hwm = get_option('ak_high_water_mark', 0 );
	$new_hwm = $ak_hwm;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // TODO: Workaround because the current host (Siteground) can't seem to resolve act.dsausa.org, so we're using the direct AK hostname in the credentials.json file. This should be removed
	curl_setopt($ch, CURLOPT_USERPWD, $creds["username"] . ':' . $creds["password"]);
	curl_setopt($ch, CURLOPT_URL, $creds["endpoint"]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);

	if ( $result ) :
		$events = json_decode($result, true);
	else :
		throw new Exception( "REST call failed" );
	endif;

	foreach ( $events['objects'] as $event ) :
		$event_ts = strtotime( $event['created_at'] );

		// AK doesn't allow filtering on this field in the query, and there's no other GUID/HWM to use for identifying new events, so we have to get all events and compare their creation date to our own HWM.
		if ( $event_ts <= $ak_hwm )	continue;

		$newpost = array(
			'post_title' => $event['title'],
			'post_content' => $event['public_description'],
			'post_status' => 'publish',
			'post_type' => 'event',
			'meta_input' => array(
				'_ept_start_timestamp' => strtotime( $event['starts_at_utc'] ),
				'_ept_end_timestamp' => strtotime( ( $event['ends_at_utc'] ? $event['ends_at_utc'] : $event['starts_at_utc'] ) ),
				'_ept_venue' => $event['venue'],
				'_ept_street' => $event['address1'] . ( $event['address2'] ? ' ' . $event['address2'] : ''),
				'_ept_city' => $event['city'],
				'_ept_state' => $event['state'],
				'_ept_zip' => $event['zip'],
				'_ept_confnum' => $event['phone']
			)
		);
		$post_id = wp_insert_post( $newpost, true );

		if ( is_wp_error($post_id) ) :
			// TODO: email the admin?
		else :
			// The post was created
			if ( $event_ts > $new_hwm ) :
				$new_hwm = $event_ts; // Update the HWM if the event creation timestamp is newer
			endif;
		endif;
	endforeach;

	// Record the most recent event's timestamp in order to filter future events
	update_option('ak_high_water_mark', $new_hwm);
}
	// Create a wp-cron event to pull new events twice a day
if ( get_theme_mod('event_cpt_ak_sync', false) ) :
	if ( ! wp_next_scheduled( 'get_ak_events_hook' ) ) :
		wp_schedule_event( time(), 'twicedaily', 'get_ak_events_hook' );
	endif;
	add_action( 'get_ak_events_hook', 'get_ak_events' );
endif;
// End Event Calendar Functionality

// LOAD IN THE CUSTOMIZER PANELS
include('theme-customizer.php');
?>
