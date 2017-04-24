<?php
	
// Theme setup
function mota_setup() {
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	// Automatic feed
	add_theme_support( 'automatic-feed-links' );
	
	// Add nav menu
	register_nav_menu( 'primary', __('Primary Menu','mota') );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'mota' ),
	) );
	
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'mota_big-header-xxlarge', 2320, 980, true );
	add_image_size( 'mota_big-header-xlarge', 1740, 735, true );
	add_image_size( 'mota_big-header-large', 1160, 490, true );
	add_image_size( 'mota_big-header-medium', 766, 323, true );
	add_image_size( 'mota_big-header-small', 580, 245, true );

	add_image_size( 'mota_post-thumbnail-medium', 720, 460, true );
	add_image_size( 'mota_post-thumbnail-small', 360, 230, true );	
	
	
	add_editor_style( array( 'mota-editor-styles.css', mota_fonts_url() ) );
	

	// Make the theme translation ready
	load_theme_textdomain('mota', get_template_directory() . '/languages');
	
	  
	// Set content-width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 882;
}
add_action( 'after_setup_theme', 'mota_setup' );

// Add Custom Logo support
function mota_custom_logo_setup() {
    $defaults = array(
		'width'			=> 600,
		'height'		=> 400,
		'flex-height'	=> true,
		'flex-width'	=> true
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'mota_custom_logo_setup' );


if ( ! function_exists( 'mota_fonts_url' ) ) :
function mota_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather Sans font: on or off', 'mota' ) ) {
		$fonts[] = 'Merriweather Sans:400,700,800';
	}

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'mota' ) ) {
		$fonts[] = 'Merriweather:400,700,800';
	}
	
	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'mota' ) ) {
		$fonts[] = 'Open Sans:400,700,800';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'mota' ) ) {
		$fonts[] = 'Roboto:400,700,800';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

// Register and enqueue styles
function mota_load_style() {
	if ( !is_admin() ) {
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'mota-fonts', mota_fonts_url(), array(), null );
	    wp_enqueue_style( 'mota_style', get_stylesheet_uri() );
	}
}
add_action('wp_enqueue_scripts', 'mota_load_style');

// Enqueue scripts and styles.
function mota_scripts() {

	wp_enqueue_script( 'mota-scripts', get_template_directory_uri() . '/js/mota-scripts.js', array( 'jquery' ), '', true);


	if ( comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mota_scripts' );


function mota_sanitize_int( $input, $setting ) {
$input = absint( $input );
// If the input is an absolute integer, return it.
// otherwise, return the default.
return ( $input ? $input : $setting->default );
}

// mota theme options
class mota_Customize {

	public static function mota_register ( $wp_customize ) {
   
      
	
		
		// Add Setting for Accent Color
		$wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
		 array(
		    'default' => '#0079a8', //Default setting/value to save
		    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		    'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		    'sanitize_callback' => 'sanitize_hex_color'            
		 ) 
		);
		
		// Add Control for Accent Color
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
		 $wp_customize, //Pass the $wp_customize object (required)
		 'mota_accent_color', //Set a unique ID for the control
		 array(
		    'label' => __( 'Accent Color', 'mota' ), //Admin-visible name of the control
		    'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		    'settings' => 'accent_color', //Which setting to load and manipulate (serialized is okay)
		    'priority' => 10, //Determines the order this control appears in for the specified section
		 ) 
		) );
	      
		// Add Setting for Accent Color
		$wp_customize->add_setting( 'overlay_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
		 array(
		    'default' => '#0079a8', //Default setting/value to save
		    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
		    'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		    'sanitize_callback' => 'sanitize_hex_color'            
		 ) 
		);
		
		// Add Control for Accent Color
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
		 $wp_customize, //Pass the $wp_customize object (required)
		 'mota_overlay_color', //Set a unique ID for the control
		 array(
		    'label' => __( 'Overlay Color', 'mota' ), //Admin-visible name of the control
		    'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
		    'settings' => 'overlay_color', //Which setting to load and manipulate (serialized is okay)
		    'priority' => 20, //Determines the order this control appears in for the specified section
		 ) 
		) );	   
	     
		$wp_customize->add_section('mota_fonts',
		    array(
		        'title' => 'Fonts',
		        'description' => __( 'Choose between different Fonts.', 'mota' ),
		        'priority' => 70
		    )
		);
		
		$wp_customize->add_section('mota_posts_pages',
		    array(
		        'title' => 'Posts/Pages',
		        'description' => __( 'Some options for the single post and the page template.', 'mota' ),
		        'priority' => 75
		    )
		);
	
		// Add Two Columns Checkbox
		
		$wp_customize->add_setting(
		    'mota_two_column_content',
		    array(
		        'default' => false,
		        'sanitize_callback' => 'mota_sanitize_int'
		    )
		);
		
		$wp_customize->add_control(
		    'mota_two_column_content',
		    array(
		        'label' => __( 'Show Content in Two Columns', 'mota' ),
		        'section' => 'mota_posts_pages',
		        'type' => 'checkbox'
		    )
		);  
		
		// Add Font Switcher
		
		$wp_customize->add_setting(
		    'mota_main_font',
		    array(
		        'default' => 'Merriweather Sans'
		    )
		);
		
		$wp_customize->add_control(
		    'mota_main_font',
		    array(
		        'label' => __( 'Main Font (Headlines)', 'mota' ),
		        'section' => 'mota_fonts',
		        'type' => 'select',
				'choices'  => array(
					'Merriweather Sans, sans-serif'  => 'Merriweather Sans',
					'Merriweather, serif'  => 'Merriweather',
					'Open Sans, sans-serif'  => 'Open Sans',
					'Roboto, sans-serif'  => 'Roboto'
				)
		    )
		);  
		
		
		$wp_customize->add_setting(
		    'mota_second_font',
		    array(
		        'default' => 'Merriweather'
		    )
		);
		
		$wp_customize->add_control(
		    'mota_second_font',
		    array(
		        'label' => __( 'Second Font (Text, Teasertext)', 'mota' ),
		        'section' => 'mota_fonts',
		        'type' => 'select',
				'choices'  => array(
					'Merriweather Sans, sans-serif'  => 'Merriweather Sans',
					'Merriweather, serif'  => 'Merriweather',
					'Open Sans, sans-serif'  => 'Open Sans',
					'Roboto, sans-serif'  => 'Roboto'
				)
		    )
		); 
	
	}

   public static function mota_header_output() {
      ?>
      
	      <!-- Customizer CSS --> 
	      
	      <style type="text/css">
	            <?php
		            
			       
			       esc_html( self::mota_generate_css('body', 'font-family', 'mota_main_font') ); 
			       esc_html( self::mota_generate_css('.teaser-text, .entry', 'font-family', 'mota_second_font') ); 
		            
		           esc_html( self::mota_generate_css('#top-section::after,h1.headline-main::after,h3.headline-teaser::after', 'background-color', 'accent_color') ); 
		           esc_html( self::mota_generate_css('h2.headline-sub,.article-list article .article-meta a:hover', 'color', 'accent_color') );
		           
		           esc_html( self::mota_generate_css('#top-section::after', 'background-color', 'overlay_color') ); 
		        ?>

	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      <?php
   }
   
   
   public static function mota_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = esc_attr( get_theme_mod($mod_name) );
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'mota_Customize' , 'mota_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'mota_Customize' , 'mota_header_output' ) );













// Change the length of excerpts
function mota_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 42;
}
add_filter( 'excerpt_length', 'mota_custom_excerpt_length', 999 );


// Change the excerpt ellipsis
function mota_new_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	return ' ...';
}
add_filter( 'excerpt_more', 'mota_new_excerpt_more' );


// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format', 'mota' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'mota' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'mota' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title', 'mota' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title', 'mota' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives', 'mota' );
    }
    return $title;
});


function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

if ( is_singular() ) wp_enqueue_script( "comment-reply" );

add_theme_support( 'title-tag' );

add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = get_bloginfo( 'name', 'display' )  . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}


//define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_subtitle',
		'title' => 'Subtitle',
		'fields' => array (
			array (
				'key' => 'field_58a8e1bcf30c3',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




?>