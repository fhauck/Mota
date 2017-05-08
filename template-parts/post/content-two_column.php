<article class="two__column" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="teaser-image">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('mota_post-thumbnail-medium'); ?></a>
	</div>
	<?php } ?>
	<h3 class="headline-teaser"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="teaser-text">
	<?php the_excerpt(); ?>
	</div>
	<div class="article-meta">
		<span class="spacer date"><?php echo get_the_date(); ?></span>
		<span class="spacer comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0 '. __( 'Comments', 'mota' ) .'', '1 '. __( 'Comment', 'mota' ) .'', '%  '. __( 'Comments', 'mota' ) .'' ); ?></a></span>
		<span class="spacer author"><?php _e('by','mota'); ?>  <?php the_author_posts_link(); ?></span>
	</div>

</article>
