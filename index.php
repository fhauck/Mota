<?php get_header(); ?>

<?php if(is_front_page()){
if ( !is_paged() ) {
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page' => 1,
	'post__in'  => $sticky,
	'ignore_sticky_posts' => 1
);
$query = new WP_Query( $args );
if ( isset($sticky[0]) ) {
?>
	
	
	<section class="sticky" id="top-section" style="background-image: url(<?php the_post_thumbnail_url('big-header-xxlarge'); ?>);">
		<div class="innerwidth">
			<div class="top-section-inner">
				<div class="top-section-content">
					<h1 class="headline-main"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php if(get_field('subtitle')){ ?>
					<h2 class="headline-sub"><?php the_field('subtitle'); ?></h2>
					<?php } ?>
					<div class="article-meta">
						<span class="spacer date"><?php echo get_the_date(); ?></span>
						<span class="spacer comments"><?php comments_number( '0 '. __( 'Comments', 'mota' ) .'', '1 '. __( 'Comment', 'mota' ) .'', '%  '. __( 'Comments', 'mota' ) .'' ); ?></span>
						<span class="spacer author">by Flo</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
<?php
}
}
} ?>

<section class="article-list">
	<div class="innerwidth">
	<div class="three-column">
		
	<?php 
	if(!empty($paged)) {
	    $paged = $paged;
	}elseif(get_query_var( 'paged')) {
	    $paged = get_query_var('paged');
	}elseif(get_query_var( 'page')) {
	    $paged = get_query_var('page');
	}else {
	    $paged = 1;
	}
	$args = array(
	    'ignore_sticky_posts' => 1,
	    'paged' => $paged
	);
	$wp_query = new WP_Query( $args );
	while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
		<?php get_template_part( 'loop' ); ?>
	
	<?php endwhile; ?>
	
		<?php
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'mota' ),
				'next_text'          => __( 'Next page', 'mota' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mota' ) . ' </span>',
			) );
		?>
			
	<?php wp_reset_query(); ?>

	</div>
	</div>
</section>

        
<?php get_footer(); ?>