<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<article id="single-post">
	
	<div class="innerwidth">
	
		<h1 class="headline-main"><?php the_title(); ?></h1>

		<?php if(get_field('subtitle')){ ?>
		<h2 class="headline-sub"><?php the_field('subtitle'); ?></h2>
		<?php } ?>
		
		<div class="article-meta">
			<?php if( esc_attr( get_theme_mod( 'mota_hide_date' ) ) == '') { ?>
				<span class="spacer date"><?php echo esc_attr( get_the_date() ); ?></span>
			<?php } ?>
			<?php if( esc_attr( get_theme_mod( 'mota_hide_comments' ) ) == '') { ?>
				<span class="spacer comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0 '. __( 'Comments', 'mota' ) .'', '1 '. __( 'Comment', 'mota' ) .'', '%  '. __( 'Comments', 'mota' ) .'' ); ?></a></span>
			<?php } ?>
			<?php if( esc_attr( get_theme_mod( 'mota_hide_author' ) ) == '') { ?>
				<span class="spacer author"><?php _e('by','mota'); ?> <?php the_author_posts_link(); ?></span>
			<?php } ?>
		</div>
		
		<?php if( esc_attr( get_theme_mod( 'mota_show_header_singlepost' ) ) !== '') { ?>
		<div class="article-image">
			
		<?php
		if ( has_post_thumbnail() )  {     
		    if ( intval(wp_get_attachment_image_src( get_post_thumbnail_id(), 'mota_big-header-xxlarge' )[1]) >= 2320 ) {
		        the_post_thumbnail('mota_big-header-xxlarge');
		    } elseif ( intval(wp_get_attachment_image_src( get_post_thumbnail_id(), 'mota_big-header-xxlarge' )[1]) > 1740 ) {
		        the_post_thumbnail('mota_big-header-xlarge');
		    } elseif ( intval(wp_get_attachment_image_src( get_post_thumbnail_id(), 'mota_big-header-xxlarge' )[1]) > 1160 ) {
		        the_post_thumbnail('mota_big-header-large');
		    } elseif ( intval(wp_get_attachment_image_src( get_post_thumbnail_id(), 'mota_big-header-xxlarge' )[1]) > 766 ) {
		        the_post_thumbnail('mota_big-header-medium');
		    } else {
			    the_post_thumbnail('mota_big-header-small');
		    }
		}
		?>

		</div>
		<?php } ?>
		
		<div class="<?php if( esc_attr( get_theme_mod( 'mota_two_column_content' ) ) !== '') { ?>column-wrapper <?php } ?>entry">

			<?php the_content(); ?>
			
		</div>
		
		<?php wp_link_pages( array(
			'before'      => '<nav class="navigation pagination"><div class="nav-links">',
			'after'       => '</div></nav>',
			'link_before' => '<span class="page-numbers">',
			'link_after'  => '</span>',
			) );
		?>
		
		<?php
		echo get_the_tag_list('<div class="tag-list">Tags: ',', ','</div>');
		?>
		
		<?php comments_template( '', true ); ?>

	</div>
	
</article>
	
	
<?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>