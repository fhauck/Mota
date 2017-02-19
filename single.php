<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<article id="single-post">
	
	<div class="innerwidth">
	
		<h1 class="headline-main"><?php the_title(); ?></h1>

		<?php if(get_field('subtitle')){ ?>
		<h2 class="headline-sub"><?php the_field('subtitle'); ?></h2>
		<?php } ?>
		
		<div class="article-meta">
			<span class="spacer date"><?php echo get_the_date(); ?></span>
			<span class="spacer comments"><?php comments_number( '0 '. __( 'Comments', 'mota' ) .'', '1 '. __( 'Comment', 'mota' ) .'', '%  '. __( 'Comments', 'mota' ) .'' ); ?></span>
			<span class="spacer author">by Flo</span>
		</div>
		
		<div class="entry">
			
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