<?php get_header(); ?>

<div id="post-area" <?php if( get_theme_mod( 'branches_sidebar_frontpage' ) == '') { ?>class="fullwidth"<?php } ?>>
	
	<div id="single-post">
		<h1><?php _e('Error 404','branches'); ?></h1>
		<div class="entry">
			<p><?php _e("It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all.", 'branches'); ?></p>		
		</div>
	</div>

	<div class="clear"></div>
</div>

<?php if( get_theme_mod( 'branches_sidebar_frontpage' ) == '') { ?>

<?php } else { ?>
<div id="sidebar">
	<?php get_sidebar(); ?>
</div>
<?php } ?>

<div class="clear"></div>
        
<?php get_footer(); ?>