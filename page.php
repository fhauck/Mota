<?php get_header(); ?>


<div id="post-area" <?php if( get_theme_mod( 'branches_sidebar_singlepage' ) == '') { ?>class="fullwidth"<?php } ?>>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	<div id="single-post" <?php if( get_theme_mod( 'branches_show_header_singlepost' ) == '') { } else { ?>style="margin-top: 40px;"<?php } ?>>
		
		<h1><?php the_title(); ?></h1>
		
		<div class="entry">
			
			<?php the_content(); ?>
			
		</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>
</div>

<?php if( get_theme_mod( 'branches_sidebar_singlepage' ) == '') { ?>

<?php } else { ?>
<div id="sidebar">
	<?php get_sidebar(); ?>
</div>
<?php } ?>

<div class="clear"></div>

<?php get_footer(); ?>