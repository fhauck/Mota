<?php
	
/*  Thumbnail upscale
/* ------------------------------------ */ 
function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null; // let the wordpress default function handle this
 
    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
 
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );
 
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );


// Theme setup
add_action( 'after_setup_theme', 'mota_setup' );

function mota_setup() {
	
	// Automatic feed
	add_theme_support( 'automatic-feed-links' );
	
	// Add nav menu
	register_nav_menu( 'primary', __('Primary Menu','mota') );
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size ( 360, 230, true );
	
	/*
	add_image_size( 'big-header-xxlarge', 2320, 980, true );
	add_image_size( 'big-header-xlarge', 1740, 735, true );
	add_image_size( 'big-header-large', 1160, 490, true );
	add_image_size( 'big-header-medium', 766, 323, true );
	add_image_size( 'big-header-small', 580, 245, true );

	add_image_size( 'post-thumbnail-medium', 720, 460, true );
	add_image_size( 'post-thumbnail-small', 360, 230, true );	
	*/

	// Make the theme translation ready
	load_theme_textdomain('mota', get_template_directory() . '/languages');
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	  require_once($locale_file);
	  
	// Set content-width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 882;
}




// Register and enqueue styles
function mota_load_style() {
	if ( !is_admin() ) {
	    wp_enqueue_style( 'mota_googleFonts', '//fonts.googleapis.com/css?family=Merriweather+Sans:400,700,800|Merriweather:400,700' );
	    wp_enqueue_style( 'mota_style', get_stylesheet_uri() );
	}
}

add_action('wp_print_styles', 'mota_load_style');

function insert_jquery(){
wp_enqueue_script('jquery', false, array(), false, false);
}
add_filter('wp_enqueue_scripts','insert_jquery',1);

function add_javascript() {

	$scripts = get_template_directory_uri().'/js/scripts-min';
	wp_enqueue_script( 'motaScripts', $scripts, '', '', true);
}
add_action( 'wp_enqueue_scripts', 'add_javascript' );


// Add editor styles
add_action( 'init', 'mota_add_editor_styles' );

function mota_add_editor_styles() {
    add_editor_style( 'mota-editor-styles.css' );
    $font_url = '//fonts.googleapis.com/css?family=Merriweather+Sans:400,700,800|Merriweather:400,700';
    add_editor_style( str_replace( ',', '%2C', $font_url ) );
}


// Change the length of excerpts
function mota_custom_excerpt_length( $length ) {
	return 42;
}
add_filter( 'excerpt_length', 'mota_custom_excerpt_length', 999 );


// Change the excerpt ellipsis
function mota_new_excerpt_more( $more ) {
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

// mota comment function
if ( ! function_exists( 'mota_comment' ) ) :

function mota_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	
		<?php __( 'Pingback:', 'mota' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'mota' ), '<span class="edit-link">', '</span>' ); ?>
		
	</li>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			
			<?php echo get_avatar( $comment, 160 ); ?>
			
			<?php if ( $comment->user_id === $post->post_author ) : ?>
					
				<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php _e('Post author','mota'); ?>">
				
					<div class="genericon genericon-user"></div>
					
				</a>
			
			<?php endif; ?>
			
			<div class="comment-inner">
			
				<div class="comment-header">
											
					<h4><?php echo get_comment_author_link(); ?></h4>
				
				</div> <!-- /comment-header -->
				
				<div class="comment-content post-content">
			
					<?php comment_text(); ?>
					
				</div><!-- /comment-content -->
				
				<div class="comment-meta">
					
					<div class="fleft">
						<div class="genericon genericon-day"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date(get_option('date_format')); ?></a>
						<?php edit_comment_link( __( 'Edit', 'mota' ), '<div class="genericon genericon-edit"></div>', '' ); ?>
					</div>
					
					<?php if ( '0' == $comment->comment_approved ) : ?>
				
						<div class="comment-awaiting-moderation fright">
							<div class="genericon genericon-show"></div><?php _e( 'Your comment is awaiting moderation.', 'mota' ); ?>
						</div>
						
					<?php else : ?>
						
						<?php 
							comment_reply_link( array( 
								'reply_text' 	=>  	__('Reply','mota'),
								'depth'			=> 		$depth, 
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<div class="fright"><div class="genericon genericon-reply"></div>',
								'after'			=>		'</div>'
								) 
							); 
						?>
					
					<?php endif; ?>
					
					<div class="clear"></div>
					
				</div> <!-- /comment-meta -->
								
			</div> <!-- /comment-inner -->
										
		</div><!-- /comment-## -->
				
	<?php
		break;
	endswitch;
}
endif;

?>