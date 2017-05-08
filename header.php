<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
	<title><?php wp_title(''); ?></title>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	
<header>
	<div class="innerwidth">
		
		<div class="header-wrapper">
		
		<div id="logo">
			<a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a>
		</div>

		<nav class="header-navigation">
			
			<a href="javascript:;" class="burger-menu">
			  <?php _e('Navigation','branches'); ?>
			</a>
			<ul class="main-menu">
			<?php if ( has_nav_menu( 'primary' ) ) {
																
				wp_nav_menu( array( 
				
					'container' => '', 
					'items_wrap' => '%3$s',
					'theme_location' => 'primary'
												
				) ); 
				
				} else {
			
				wp_list_pages( array(
				
					'container' => '',
					'title_li' => ''
				
				));
				
			} ?>
			</ul>
		</nav>
		
		<div class="clear"></div>
		
		</div>
	</div>
</header>

<!-- mainwrapper -->
<div id="mainwrapper">