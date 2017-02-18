<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="teaser-image">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail-medium'); ?></a>
	</div>
	<?php } ?>
	<h3 class="headline-teaser"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="teaser-text">
	<?php the_excerpt(); ?>
	</div>

</article>


<!--
<article>
<div class="teaser-image">
	<img src="images/teaser02.jpg" alt="" />
</div>

<p>Cat ipsum dolor sit amet, ignore the squirrels, you’ll never catch them anyway or present belly, scratch hand when stroked and licks paws. Lick the curtain just to be annoying friends are not food but inspect anything brought into the house please …</p>
</article>

		<a href="<?php the_permalink(); ?>" class="post-info-left-top"><?php echo get_the_date(); ?></a>
		<a href="<?php the_permalink(); ?>#comments" class="post-info-right-top"><?php comments_number( '0 '. __( 'Comments', 'branches' ) .'', '1 '. __( 'Comment', 'branches' ) .'', '%  '. __( 'Comments', 'branches' ) .'' ); ?></a>
		<span class="post-info-left-bottom"><?php echo get_the_category_list(', '); ?></span>
-->