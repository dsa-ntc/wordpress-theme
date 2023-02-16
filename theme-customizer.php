<?php
	function dsamain_customize_register( $wp_customize ) {
		$wp_customize->add_section( 'dsamain_cpts', [
			'title' => __( 'DSA Main - Post Types' ),
		]);
		$wp_customize->add_section( 'dsamain_layout', [
			'title' => __( 'DSA Main - Layout' ),
		]);
		$wp_customize->add_section( 'dsamain_fonts', [
			'title' => __( 'DSA Main - Fonts' ),
		]);
		$wp_customize->add_section( 'dsamain_other', [
			'title' => __( 'DSA Main - Other Settings' ),
		]);
		$wp_customize->add_section( 'dsamain_sidebars', [
			'title' => __( 'DSA Main - Sidebar Settings' ),
		]);
		$wp_customize->add_section( 'dsamain_statements', [
			'title' => __( 'DSA Main - Statements Settings' ),
		]);
		$wp_customize->add_section( 'dsamain_blog', [
			'title' => __( 'DSA Main - Blog Settings' ),
		]);

		// Custom post types
		$cpts = [
			'banner' => 'Front Page Banner',
			'news' => 'News',
			'statement' => 'Statement',
			'pressrelease' => 'Press Release',
			'event' => 'Event',
			'orgblog' => 'Organizing Blog',
			'strategy' => 'Socialist Strategy',
			'factsheet' => 'Factsheet',
			'natlupdate' => 'National Update',
			'stacks' => 'The Stacks'
		];

		foreach ( $cpts as $cpt=>$label ) :
			$wp_customize->add_setting( "enable_cpt_{$cpt}" );

			$wp_customize->add_control( "enable_cpt_{$cpt}", [
				'section' => 'dsamain_cpts',
				'type' => 'checkbox',
				'label' => __( "Enable the custom post type {$label}?" ),
			]);

		endforeach;
		// End custom post types

		// Sticky logo
		$wp_customize->add_setting( 'sticky_logo' );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sticky_logo', [
		'label'    => __( 'Sticky Logo' ),
		'description' => 'The image file to be displayed at the top of the screen in a mobile layout. Images with a wide aspect ratio work best (4:1 width-to-height or greater).',
        'section'  => 'header_image',
        'settings' => 'sticky_logo',
		]));
		// End sticky logo

		// ======= COLORS ======= //

		// We remove this because the theme doesn't support setting header colors this way
		$wp_customize->remove_control( 'header_textcolor' );

		// Page background color
		$wp_customize->add_setting( 'page_bg_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#fff',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_bg_color', [
			'label'        => __( 'Background Color' ),
			'description' => __( 'The color for the site background. Content area backgrounds are always white.' ),
			'section'    => 'colors',
			'settings'   => 'page_bg_color',
		]));
		// End page background color

		// Theme primary color
		$wp_customize->add_setting( 'primary_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#ec1f27',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', [
			'label'        => __( 'Primary Color' ),
			'description' => __( 'The main accent color to use throughout the site. This actually DOES NOTHING right now.' ),
			'section'    => 'colors',
			'settings'   => 'primary_color',
		]));
		// End theme primary color

		// Header color
		$wp_customize->add_setting( 'header_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#ffffff',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', [
			'label'        => __( 'Header Block Color' ),
			'description' => __( 'The background color for the header section.' ),
			'section'    => 'colors',
			'settings'   => 'header_color',
		]));
		// End header color

		// Footer color
		$wp_customize->add_setting( 'footer_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#ec1f27',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', [
			'label'        => __( 'Footer Block Color' ),
			'description' => __( 'The background color for the footer section.' ),
			'section'    => 'colors',
			'settings'   => 'footer_color',
		]));
		// End footer color

		// Headings color
		$wp_customize->add_setting( 'font_headings_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#323232',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_headings_color', [
			'section'    => 'colors',
			'label'        => __( 'Headings Color' ),
			'description' => __( 'The text color for headings. The default is the same as the body text (#323232)' ),
			'settings'   => 'font_headings_color',
		]));
		// End headings color

		// Site title color
		$wp_customize->add_setting( 'font_sitetitle_color', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '#323232',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'font_sitetitle_color', [
			'section'    => 'colors',
			'label'        => __( 'Site Title Color' ),
			'description' => __( 'The text color for the site title. The default is #323232. DSA Red is #ec1f27. For this to have an effect, "Display Site Title and Tagline" must be enabled under the "Site Identity" section.' ),
			'settings'   => 'font_sitetitle_color',
		]));
		// End site title color

		// ======= END COLORS ======= //

		// Page border
		$wp_customize->add_setting( 'page_border', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'page_border', [
			'type' => 'checkbox',
			'section' => 'dsamain_layout',
			'label' => __( 'Show a framing border?' ),
			'description' => __( 'On desktop layouts, apply a thin/light border to the main page content.' ),
		]);
		// End page border

		// Full-width header and footer
		$wp_customize->add_setting( 'fullwidth_header_footer', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => true,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'fullwidth_header_footer', [
			'type' => 'checkbox',
			'section' => 'dsamain_layout',
			'label' => __( 'Full-width header and footer?' ),
			'description' => __( 'Should the header and footer stretch to the full width of the browser window? This setting is only visible on the desktop layout' ),
		]);
		// End full-width header and footer

		// Header style
		$wp_customize->add_setting( 'header_style', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'stacked stacked-left',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'header_style', [
			'type' => 'radio',
			'section' => 'dsamain_layout',
			'label' => __( 'Page header style' ),
			'description' => __( 'One of several variations for the placement of the logo and navigation menu in the header of every page.' ),
			'choices' => array(
				'stacked stacked-left' => 'Vertically stacked, logo on left',
				'stacked stacked-right' => 'Vertically stacked, logo on right',
				'stacked stacked-centered' => 'Vertically stacked, centered',
				'horizontal horizontal-left' => 'Horizontal (side-by-side), logo on left',
				'horizontal horizontal-right' => 'Horizontal (side-by-side), logo on right'
			)
		]);
		// End header style

		// Header border
		$wp_customize->add_setting( 'header_bottom_border', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => true,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'header_bottom_border', [
			'type' => 'checkbox',
			'section' => 'dsamain_layout',
			'label' => __( 'Add border to bottom of header area?' ),
			'description' => __( 'Whether to show a border at the bottom edge of the header, as a content separator' ),
		]);
		// End header border

		// Banner style
		$wp_customize->add_setting( 'show_banner', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'show_banner', [
			'type' => 'checkbox',
			'section' => 'dsamain_layout',
			'active_callback' => 'is_front_page',
			'label' => __( 'Show carousel/banner on frontpage?' ),
			'description' => __( 'Show a "hero" image or carousel of images on the home page?' ),
		]);
		$wp_customize->add_setting( 'banner_posts', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'featured',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'banner_posts', [
			'type' => 'radio',
			'section' => 'dsamain_layout',
			'active_callback' => 'banner_posts_callback',
			'label' => __( 'What should the banner show?' ),
			'description' => __( 'The banner can either display the latest posts (based on publish date), posts that contain are tagged "featured", or a custom post type called "Front Page Banner"' ),
			'choices' => [
				'latest' => 'Show latest posts',
				'featured' => 'Show posts that are tagged "featured"',
				'cpt' => 'Show Front Page Banner posts'
			]
		]);
		$wp_customize->add_setting( 'banner_posts_latest_count', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 4,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'banner_posts_latest_count', [
			'type' => 'number',
			'section' => 'dsamain_layout',
			'active_callback' => 'banner_posts_latest_callback',
			'label' => __( 'How many latest posts should the banner show?' ),
		]);
		// End banner style

		// Footer text
		$wp_customize->add_setting( 'footer_text', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'footer_text', [
			'type' => 'text',
			'section' => 'dsamain_layout',
			'label' => __( 'Footer text' ),
			'description' => __( 'A brief disclaimer or descriptor for the footer of every page. Basic HTML markup is allowed.' ),
		]);
		// End footer text

		// Sidebar style
		$wp_customize->add_setting( 'show_sidebar_fp', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => true,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'show_sidebar_fp', [
			'type' => 'checkbox',
			'section' => 'dsamain_sidebars',
			'active_callback' => 'is_front_page',
			'label' => __( 'Show sidebar on homepage?' ),
			'description' => __( 'Show the customizable sidebar on the home page.' ),
		]);

		$wp_customize->add_setting( 'show_sidebar_page', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => true,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'show_sidebar_page', [
			'type' => 'checkbox',
			'section' => 'dsamain_sidebars',
			'label' => __( 'Show sidebar on pages (not including the front page?' ),
			'description' => __( 'Show a customizable sidebar on other pages/posts/content.' ),
		]);

		// Custom post type sidebars
		$cpts = get_post_types( [
			'_builtin' => false,
			'exclude_from_search' => false,
		], 'objects' );

		foreach ( $cpts as $cpt ) :
			$wp_customize->add_setting( "show_sidebar_{$cpt->name}", [
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => true,
				'transport' => 'refresh',
			]);
			$wp_customize->add_control( "show_sidebar_{$cpt->name}", [
				'type' => 'checkbox',
				'section' => 'dsamain_sidebars',
				'label' => __( "Show sidebar on single {$cpt->labels->singular_name} pages?" ),
				'description' => __( "Should a sidebar section be displayed for individual posts of this type?" )
			]);
			$wp_customize->add_setting( "show_sidebar_{$cpt->name}_archive", [
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => true,
				'transport' => 'refresh',
			]);
			$wp_customize->add_control( "show_sidebar_{$cpt->name}_archive", [
				'type' => 'checkbox',
				'section' => 'dsamain_sidebars',
				'label' => __( "Show sidebar on {$cpt->labels->singular_name} archives?" ),
				'description' => __( "Should a sidebar section be displayed for archive  of this type?" )
			]);
		endforeach;
		// End banner style
	
		// Statement options
		$wp_customize->add_setting( 'show_statements', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'show_statements', [
			'type' => 'checkbox',
			'section' => 'dsamain_statements',
			'label' => __( 'Show statements?' ),
			'description' => __( 'Whether to include issue-related statements on the home page.' ),
		]);

		$wp_customize->add_setting( 'statements_also_show_news', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'statements_also_show_news', [
			'type' => 'checkbox',
			'section' => 'dsamain_statements',
			'label' => __( 'Also show news?' ),
			'description' => __( 'Whether to show news items on the statements section.' ),
		]);
		
		$wp_customize->add_setting( 'statements_name', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'Statements',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'statements_name', [
			'type' => 'text',
			'section' => 'dsamain_statements',
			'label' => __( 'Title for statements section' ),
			'description' => __( 'The heading for the statements section' ),
		]);
		$wp_customize->add_setting( 'statements_subtitle', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'Statements',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'statements_subtitle', [
			'type' => 'text',
			'section' => 'dsamain_statements',
			'label' => __( 'Subtitle for statements section' ),
			'description' => __( 'The subtitle for the statements section' ),
		]);
		
		$wp_customize->add_setting( 'statements_slug', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'statements',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_slug'
		]);
		$wp_customize->add_control( 'statements_slug', [
			'type' => 'text',
			'section' => 'dsamain_statements',
			'label' => __( 'Show statements under the following address' ),
			'description' => __( 'How addresses for the statements are generated. By default, they will be under "site.com/statements/", but you can change "statements" to another value.' ),
		]);
		
		// Blog options
		$wp_customize->add_setting( 'show_blog', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'show_blog', [
			'type' => 'checkbox',
			'section' => 'dsamain_blog',
			'label' => __( 'Show blog?' ),
			'description' => __( 'Whether to include the blog posts section for posts that are not issue-related.' ),
		]);
		
		$wp_customize->add_setting( 'blog_name', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'Blog',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'blog_name', [
			'type' => 'text',
			'section' => 'dsamain_blog',
			'label' => __( 'Title for blog section' ),
			'description' => __( 'The heading for the blog posts section' ),
		]);
		$wp_customize->add_setting( 'blog_subtitle', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'Blog',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'blog_subtitle', [
			'type' => 'text',
			'section' => 'dsamain_blog',
			'label' => __( 'Subtitle for blog section' ),
			'description' => __( 'The subtitle for the blog posts section' ),
		]);
		
		$wp_customize->add_setting( 'blog_slug', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => 'blog',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_slug'
		]);
		$wp_customize->add_control( 'blog_slug', [
			'type' => 'text',
			'section' => 'dsamain_blog',
			'label' => __( 'Show blogs under the following address' ),
			'description' => __( 'How addresses for the blog posts are generated. By default, they will be under "site.com/blog/", but you can change "blog" to another value.' ),
		]);
		// End blog options
		
		// Google Search Console and Analytics
		$wp_customize->add_setting( 'ganalytics_id', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'ganalytics_id', [
			'type' => 'text',
			'section' => 'dsamain_other',
			'label' => __( 'Google Analytics ID' ),
			'description' => __( 'The ID for your Google Analytics account. It should look like "UA-123456789-1".' ),
		]);
		$wp_customize->add_setting( 'gsearch_key', [
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'gsearch_key', [
			'type' => 'text',
			'section' => 'dsamain_other',
			'label' => __( 'Google Search Console API Key' ),
			'description' => __( 'The API key to verify your site with Google Search Console. It\'s just a long alphanumeric string.' ),
		]);
		// End Google Search Console and Analytics

		// Font customization
		$wp_customize->add_setting( 'google_api_key', [
			'type' => 'theme_mod',
			'default' => 'AIzaSyDCRJbaChIad-GarzP_-C6fqtKbhllEUw0',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'google_api_key', [
			'section' => 'dsamain_fonts',
			'type' => 'text',
			'label' => 'Google Fonts API Key',
			'description' => __( 'Enter a unique Google API key. You may use the default for any site hosted on dsausa.org; other sites may not work.' )
		]);

		$wp_customize->add_setting( 'font_headings_custom', [
			'type' => 'theme_mod',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'font_headings_custom', [
			'section' => 'dsamain_fonts',
			'type' => 'checkbox',
			'label' => 'Custom font for headings (<h1> <h2> etc)?'
		] );
		$wp_customize->add_setting( 'font_headings', [
			'type' => 'theme_mod',
			'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
			//'default' => '{"font":"ManifoldDSA","regularweight":"400","italicweight":"400i","boldweight":"700","category":"sans-serif"}',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize,'font_headings', [
			'section' => 'dsamain_fonts',
			'label' => __( 'Font for headings' ),
			'description' => __( 'The default is "DSA Manifold"'),
			'active_callback' => 'custom_font_headings_callback',
			'input_attrs' => [
				'font_count' => 50,
				'orderby' => 'popularity'
			]
		]) );

		$wp_customize->add_setting( 'font_body_custom', [
			'type' => 'theme_mod',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'font_body_custom', [
			'section' => 'dsamain_fonts',
			'type' => 'checkbox',
			'label' => 'Custom font for body text?'
		] );
		$wp_customize->add_setting( 'font_body', [
			'type' => 'theme_mod',
			'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
			//'default' => '{"font":"ManifoldDSA","regularweight":"400","italicweight":"400i","boldweight":"700","category":"sans-serif"}',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize,'font_body', [
			'section' => 'dsamain_fonts',
			'label' => __( 'Font for body text' ),
			'description' => __( 'The default is "Open Sans"'),
			'active_callback' => 'custom_font_body_callback',
			'input_attrs' => [
				'font_count' => 50,
				'orderby' => 'popularity'
			]
		]) );

		$wp_customize->add_setting( 'font_sitetitle_custom', [
			'type' => 'theme_mod',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'font_sitetitle_custom', [
			'section' => 'dsamain_fonts',
			'type' => 'checkbox',
			'label' => 'Custom font for the site title?',
			'description' => 'For this to have an effect, "Display Site Title and Tagline" must be enabled under the "Site Identity" section'
		] );
		$wp_customize->add_setting( 'font_sitetitle', [
			'type' => 'theme_mod',
			'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
			//'default' => '{"font":"ManifoldDSA","regularweight":"400","italicweight":"400i","boldweight":"700","category":"sans-serif"}',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize,'font_sitetitle', [
			'section' => 'dsamain_fonts',
			'label' => __( 'Font for the site title' ),
			'description' => __( 'The default is the same as the body font'),
			'active_callback' => 'custom_font_sitetitle_callback',
			'input_attrs' => [
				'font_count' => 50,
				'orderby' => 'popularity'
			]
		]) );

		$wp_customize->add_setting( 'font_menu_custom', [
			'type' => 'theme_mod',
			'default' => false,
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( 'font_menu_custom', [
			'type' => 'checkbox',
			'section' => 'dsamain_fonts',
			'label' => 'Custom font for the main menu?'
		] );
		$wp_customize->add_setting( 'font_menu', [
			'type' => 'theme_mod',
			'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
			//'default' => '{"font":"ManifoldDSA","regularweight":"400","italicweight":"400i","boldweight":"700","category":"sans-serif"}',
			'transport' => 'refresh',
		]);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize,'font_menu', [
			'section' => 'dsamain_fonts',
			'label' => __( 'Font for the main menu' ),
			'description' => __( 'The default is the same as the body font'),
			'active_callback' => 'custom_font_menu_callback',
			'input_attrs' => [
				'font_count' => 50,
				'orderby' => 'popularity'
			]
		]) );

		// End font customization
	}
	add_action( 'customize_register', 'dsamain_customize_register' );
	add_action( 'customize_save_after', function() {
		flush_rewrite_rules();
	});

	// Callback functions
	function banner_posts_callback( $control ) {
		if ( $control->manager->get_setting('show_banner')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}
	
	function banner_posts_latest_callback( $control ) {
		if ( $control->manager->get_setting('banner_posts')->value() == 'latest' ) {
			return true;
		} else {
			return false;
		}
	}

	function custom_font_headings_callback( $control ) {
		if ( $control->manager->get_setting('font_headings_custom')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	function custom_font_body_callback( $control ) {
		if ( $control->manager->get_setting('font_body_custom')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	function custom_font_sitetitle_callback( $control ) {
		if ( $control->manager->get_setting('font_sitetitle_custom')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	function custom_font_menu_callback( $control ) {
		if ( $control->manager->get_setting('font_menu_custom')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	function sanitize_slug( $input ) {
		return sanitize_title_with_dashes( $input );
	}

	function save_custom_css() {
		$fonts = [];

		if ( get_theme_mod('font_headings_custom', false ) ) :
			$font_headings = json_decode( get_theme_mod('font_headings'), true );
			$fonts[] = str_replace(' ', '+', $font_headings['font'] );
		endif;
		if ( get_theme_mod('font_body_custom', false ) ) :
			$font_body = json_decode( get_theme_mod( 'font_body', false ), true );
			$fonts[] = str_replace(' ', '+', $font_body['font'] );
		endif;
		if ( get_theme_mod('font_sitetitle_custom', false ) ) :
			$font_sitetitle = json_decode( get_theme_mod( 'font_sitetitle', false ), true );
			$fonts[] = str_replace(' ', '+', $font_sitetitle['font'] );
		endif;
		if ( get_theme_mod('font_menu_custom', false ) ) :
			$font_menu = json_decode( get_theme_mod( 'font_menu', false ), true );
			$fonts[] = str_replace(' ', '+', $font_menu['font'] );
		endif;

		$customstyling[] = '<style type="text/css">';
		
		if ( get_theme_mod('page_bg_color', false) ) :
				$customstyling[] = 'body { background-color: ' . get_theme_mod('page_bg_color', '#fff') .'}';
		endif;
		if ( get_theme_mod('header_color', false) ) :
			$header_bg_color = get_theme_mod( 'header_color', '#ffffff' );
			$header_text_color = get_the_text_color( $header_bg_color );

			if ( $header_bg_color != '#ffffff' ) :
				$customstyling[] = "#pageheader { background-color: $header_bg_color; color: $header_text_color; }";
				$customstyling[] = "#hdrnav a { color: $header_text_color; }";
				$customstyling[] = "#hdrnav .mainnav > div:hover { background-color: $header_bg_color; color: $header_text_color; }";
				$customstyling[] = "#hdrnav .mainnav .sub-menu { background-color: $header_bg_color; color: $header_text_color; }";
			endif;
		endif;
		if ( get_theme_mod('footer_color', false) ) :
			$footer_bg_color = get_theme_mod('footer_color', '#ec1f27');
			$footer_text_color = get_the_text_color( $footer_bg_color );

			$customstyling[] = "#pagefooter { background-color: $footer_bg_color; color: $footer_text_color; }";
		endif;
			
		$headings_color = get_theme_mod('font_headings_color');
		if ( $headings_color ) :
			$customstyling[] = "h1,h2,h3,h4,h5 { color: {$headings_color}; } h1 { border-bottom-color: #323232 }";
		endif;
		
		if ( get_theme_mod('font_headings_custom', false) ) :
			$customstyling[] = "h1,h2,h3,h4,h5 { font-family: {$font_headings['font']}; font-weight: {$font_headings['regularweight']}; " . ( strpos( $font_headings['regularweight'], 'i') ? " font-style: italic;" : '' ) . "}; h1 strong, h1 b, h2 strong, h2 b, h3 strong, h3 b, h4 strong, h4 5, h5 strong, h5 b { font-weight: {$font_headings['boldweight']}; }";
		endif;
		if ( get_theme_mod('font_body_custom', false) ) :
				$customstyling[] = "body { font-family: {$font_body['font']}; font-weight: {$font_body['regularweight']}; " . ( strpos( $font_body['regularweight'], 'i') ? " font-style: italic;" : '' ) . "}; body b, body strong { font-weight: {$font_body['boldweight']}; }";
		endif;

		$sitetitle_color = get_theme_mod('font_sitetitle_color');
		if ( $sitetitle_color ) :
			$customstyling[] = ".sitetitle { color: {$sitetitle_color}; }";
		endif;

		if ( get_theme_mod('font_sitetitle_custom', false) ) :
			$sitetitle_color = get_theme_mod('font_sitetitle_color');
			$customstyling[] = ".sitetitle { font-family: {$font_sitetitle['font']}; font-weight: {$font_sitetitle['regularweight']}!important; " . ( strpos( $font_sitetitle['regularweight'], 'i') ? " font-style: italic; " : '' ) . "}; .sitetitle strong, .sitetitle b { font-weight: {$font_sitetitle['boldweight']}; }";
		endif;
		if ( get_theme_mod('font_menu_custom', false) ) :
			$customstyling[] = "#navmenu { font-family: {$font_menu['font']}; font-weight: {$font_menu['regularweight']} !important; " . ( strpos( $font_menu['regularweight'], 'i') ? " font-style: italic;" : '' ) . "}; #navmenu b, #navmenu strong { font-weight: {$font_menu['boldweight']}; }";
	endif;
		
		$customstyling[] = '</style>';

		set_theme_mod('custom_css', implode( "\n", $customstyling ) );
		set_theme_mod('custom_fonts', implode('|', $fonts) );
	}
	add_action( 'customize_preview_init', 'save_custom_css');
	add_action( 'customize_save_after', 'save_custom_css');

	function write_custom_css() {
		$fonts = get_theme_mod( 'custom_fonts', false );

		if ( $fonts ) :
			$google_fonts_base_url = 'https://fonts.googleapis.com/css?family=';
			echo '<link rel="stylesheet" href="' . $google_fonts_base_url . $fonts . '">' . "\n";
		endif;

		echo get_theme_mod('custom_css', false) . "\n";
	}
	add_action( 'wp_head', 'write_custom_css' );

	function get_google_fonts( $limit = 50, $sort = 'popularity' ) {
		$apikey = get_theme_mod('google_api_key', 'AIzaSyDCRJbaChIad-GarzP_-C6fqtKbhllEUw0' );
		$curl = curl_init();
		$curlargs = http_build_query( [
			'key' => $apikey,
			'sort' => $sort
		]);
		
		$curlendpoint = 'https://www.googleapis.com/webfonts/v1/webfonts?' . $curlargs;
		$curlopts = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_URL => $curlendpoint,
			CURLOPT_RETURNTRANSFER => TRUE
		];
	
		curl_setopt_array($curl, $curlopts);
	
		$result = curl_exec($curl);
		curl_close($curl);
	
		$manifold_object = [ (object) [
			'family' => 'Manifold DSA',
			'category' => 'sans-serif',
			'variants' => [
				'300','300i',
				'400','400i',
				'500','500i',
				'600','600i',
				'700','700i',
				'800','800i',
				'900','900i'
			]
		] ];
		
		if ( $result ) :
			$content = json_decode( $result );
			if ( $limit == 'all' ) :
				return array_merge( $manifold_object, $content->items );
				//return $content->items;
			else :
				return array_merge( $manifold_object, array_slice( $content->items, 0, $limit ) );
				//return array_slice( $content->items, 0, $limit );
			endif;
		endif;
	}

	if ( class_exists( 'WP_Customize_Control' ) ) {
		/**
		 * Dropdown Select2 Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		 */
		class Skyrocket_Dropdown_Select2_Custom_Control extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'dropdown_select2';
			/**
			 * The type of Select2 Dropwdown to display. Can be either a single select dropdown or a multi-select dropdown. Either false for true. Default = false
			 */
			private $multiselect = false;
			/**
			 * The Placeholder value to display. Select2 requires a Placeholder value to be set when using the clearall option. Default = 'Please select...'
			 */
			private $placeholder = 'Please select...';
			/**
			 * Constructor
			 */
			public function __construct( $manager, $id, $args = array(), $options = array() ) {
				parent::__construct( $manager, $id, $args );
				// Check if this is a multi-select field
				if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) {
					$this->multiselect = true;
				}
				// Check if a placeholder string has been specified
				if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) {
					$this->placeholder = $this->input_attrs['placeholder'];
				}
			}
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue() {
				wp_enqueue_script( 'skyrocket-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
				wp_enqueue_script( 'skyrocket-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'assets/customizer-custom-controls/js/customizer.js', array( 'skyrocket-select2-js' ), '1.0', true );
				wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'assets/customizer-custom-controls/css/customizer.css', array(), '1.1', 'all' );
				wp_enqueue_style( 'skyrocket-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '4.0.6', 'all' );
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content() {
				$defaultValue = $this->value();
				if ( $this->multiselect ) {
					$defaultValue = explode( ',', $this->value() );
				}
			?>
				<div class="dropdown_select2_control">
					<?php if( !empty( $this->label ) ) { ?>
						<label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
							<?php echo esc_html( $this->label ); ?>
						</label>
					<?php } ?>
					<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-dropdown-select2" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />
					<select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="customize-control-select2" data-placeholder="<?php echo $this->placeholder; ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
						<?php
							if ( !$this->multiselect ) {
								// When using Select2 for single selection, the Placeholder needs an empty <option> at the top of the list for it to work (multi-selects dont need this)
								echo '<option></option>';
							}
							foreach ( $this->choices as $key => $value ) {
								if ( is_array( $value ) ) {
									echo '<optgroup label="' . esc_attr( $key ) . '">';
									foreach ( $value as $optgroupkey => $optgroupvalue ) {
										echo '<option value="' . esc_attr( $optgroupkey ) . '" ' . ( in_array( esc_attr( $optgroupkey ), $defaultValue ) ? 'selected="selected"' : '' ) . '>' . esc_attr( $optgroupvalue ) . '</option>';
									}
									echo '</optgroup>';
								}
								else {
									echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $key ), $defaultValue, false )  . '>' . esc_attr( $value ) . '</option>';
								}
							}
						?>
					</select>
				</div>
			<?php
			}
		}

		/**
		 * Google Font Select Custom Control
		 *
		 * @author Anthony Hortin <http://maddisondesigns.com>
		 * @license http://www.gnu.org/licenses/gpl-2.0.html
		 * @link https://github.com/maddisondesigns
		 */
		class Skyrocket_Google_Font_Select_Custom_Control extends WP_Customize_Control {
			/**
			 * The type of control being rendered
			 */
			public $type = 'google_fonts';
			/**
			 * The list of Google Fonts
			 */
			private $fontList = false;
			/**
			 * The saved font values decoded from json
			 */
			private $fontValues = [];
			/**
			 * The index of the saved font within the list of Google fonts
			 */
			private $fontListIndex = 0;
			/**
			 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
			 */
			private $fontCount = 'all';
			/**
			 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
			 */
			private $fontOrderBy = 'alpha';
			/**
			 * Get our list of fonts from the json file
			 */
			public function __construct( $manager, $id, $args = array(), $options = array() ) {
				parent::__construct( $manager, $id, $args );
				// Get the font sort order
				if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
					$this->fontOrderBy = 'popular';
				}
				// Get the list of Google fonts
				if ( isset( $this->input_attrs['font_count'] ) ) {
					if ( 'all' != strtolower( $this->input_attrs['font_count'] ) ) {
						$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
					}
				}
				//$this->fontList = $this->skyrocket_getGoogleFonts( 'all' );
				$this->fontList = get_google_fonts();
				// Decode the default json font value
				$this->fontValues = json_decode( $this->value() );
				// Find the index of our default font within our list of Google fonts
				$this->fontListIndex = $this->skyrocket_getFontIndex( $this->fontList, $this->fontValues->font );
			}
			/**
			 * Enqueue our scripts and styles
			 */
			public function enqueue() {
				wp_enqueue_script( 'skyrocket-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
				wp_enqueue_script( 'skyrocket-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'assets/customizer-custom-controls/js/customizer.js', array( 'skyrocket-select2-js' ), '1.0', true );
				wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'assets/customizer-custom-controls/css/customizer.css', array(), '1.1', 'all' );
				wp_enqueue_style( 'skyrocket-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '4.0.6', 'all' );
			}
			/**
			 * Export our List of Google Fonts to JavaScript
			 */
			public function to_json() {
				parent::to_json();
				$this->json['skyrocketfontslist'] = $this->fontList;
			}
			/**
			 * Render the control in the customizer
			 */
			public function render_content() {
				$fontCounter = 0;
				$isFontInList = false;
				$fontListStr = '';
				if( !empty($this->fontList) ) {
					?>
					<div class="google_fonts_select_control">
						<?php if( !empty( $this->label ) ) { ?>
							<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<?php } ?>
						<?php if( !empty( $this->description ) ) { ?>
							<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<?php } ?>
						<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
						<div class="google-fonts">
							<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
								<?php
									foreach( $this->fontList as $key => $value ) {
										$fontCounter++;
										$fontListStr .= '<option value="' . $value->family . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . $value->family . '</option>';
										if ( $this->fontValues->font === $value->family ) {
											$isFontInList = true;
										}
										if ( is_int( $this->fontCount ) && $fontCounter === $this->fontCount ) {
											break;
										}
									}
									if ( !$isFontInList && $this->fontListIndex ) {
										// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font
										$fontListStr = '<option value="' . $this->fontList[$this->fontListIndex]->family . '" ' . selected( $this->fontValues->font, $this->fontList[$this->fontListIndex]->family, false ) . '>' . $this->fontList[$this->fontListIndex]->family . ' (default)</option>' . $fontListStr;
									}
									// Display our list of font options
									echo $fontListStr;
								?>
							</select>
						</div>
						<div class="customize-control-description">Select weight &amp; style for regular text</div>
						<div class="weight-style">
							<select class="google-fonts-regularweight-style">
								<?php
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										echo '<option value="' . $value . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . $value . '</option>';
									}
								?>
							</select>
						</div>
						<div class="customize-control-description">Select weight for <italic>italic text</italic></div>
						<div class="weight-style">
							<select class="google-fonts-italicweight-style" <?php disabled( in_array( 'italic', $this->fontList[$this->fontListIndex]->variants ), false ); ?>>
								<?php
									$optionCount = 0;
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										// Only add options that are italic
										if( strpos( $value, 'italic' ) !== false ) {
											echo '<option value="' . $value . '" ' . selected( $this->fontValues->italicweight, $value, false ) . '>' . $value . '</option>';
											$optionCount++;
										}
									}
									if( $optionCount == 0 ) {
										echo '<option value="">Not Available for this font</option>';
									}
								?>
							</select>
						</div>
						<div class="customize-control-description">Select weight for <strong>bold text</strong></div>
						<div class="weight-style">
							<select class="google-fonts-boldweight-style">
								<?php
									$optionCount = 0;
									foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
										// Only add options that aren't italic
										if( strpos( $value, 'italic' ) === false ) {
											echo '<option value="' . $value . '" ' . selected( $this->fontValues->boldweight, $value, false ) . '>' . $value . '</option>';
											$optionCount++;
										}
									}
									// This should never evaluate as there'll always be at least a 'regular' weight
									if( $optionCount == 0 ) {
										echo '<option value="">Not Available for this font</option>';
									}
								?>
							</select>
						</div>
						<input type="hidden" class="google-fonts-category" value="<?php echo $this->fontValues->category; ?>">
					</div>
					<?php
				}
			}
			/**
			 * Find the index of the saved font in our multidimensional array of Google Fonts
			 */
			public function skyrocket_getFontIndex( $haystack, $needle ) {
				foreach( $haystack as $key => $value ) {
					if( $value->family == $needle ) {
						return $key;
					}
				}
				return false;
			}
			/**
			 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
			 */
			/* public function skyrocket_getGoogleFonts( $count = 30 ) {
				// Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY
				$fontFile = trailingslashit( get_template_directory_uri() ) . 'inc/google-fonts-alphabetical.json';
				if ( $this->fontOrderBy === 'popular' ) {
					$fontFile = trailingslashit( get_template_directory_uri() ) . 'inc/google-fonts-popularity.json';
				}
				$request = wp_remote_get( $fontFile );
				if( is_wp_error( $request ) ) {
					return "";
				}
				$body = wp_remote_retrieve_body( $request );
				$content = json_decode( $body );
				if( $count == 'all' ) {
					return $content->items;
				} else {
					return array_slice( $content->items, 0, $count );
				}
			} */
		}
	}
?>
