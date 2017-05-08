<?php get_header(); ?>

<!---
<?php if(is_front_page()){
	
	if ( !is_paged() ) {
		
		// Show Latest/Newest Post
		if( esc_attr( get_theme_mod( 'mota_home_header' ) == 0 ) ) {
		?>
		
			<?php 
			$args = array(
				'posts_per_page' => 1,
				'ignore_sticky_posts' => 1
			);
			$wp_query = new WP_Query( $args );
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	
				<?php get_template_part( 'template-parts/post/content','special_teaser' ); ?>
				
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
				
		<?php
		// Show Latest/Newest Sticky-Post	
		} elseif( esc_attr( get_theme_mod( 'mota_home_header' ) ) == 1 ) {
		
			$sticky = get_option( 'sticky_posts' );
			$args = array(
				'posts_per_page' => 1,
				'post__in'  => $sticky,
				'ignore_sticky_posts' => 1
			);
			$query = new WP_Query( $args );
			if ( isset($sticky[0]) ) {
			?>
				<?php get_template_part( 'template-parts/post/content','special_teaser' ); ?>

			<?php
			}
			
		// Show Nothing -> Invisible
		} else {
			
		}
	}

} ?>

<section class="article-list">
	<div class="innerwidth">
		<div class="column__wrapper">
			
			

			<?php 
			if(!empty($paged)) {
			    $paged = $paged;
			}elseif(get_query_var( 'paged')) {
			    $paged = get_query_var('paged');
			}elseif(get_query_var( 'page')) {
			    $paged = get_query_var('page');
			}else {
			    $paged = 1;
			} ?>
			
			<?php
			$args = array(
			    'ignore_sticky_posts' => 1,
			    'paged' => $paged
			);
			$wp_query = new WP_Query( $args );
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			
				<?php get_template_part( 'template-parts/post/content','three_column' ); ?>
			
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

		

		
		
		</div>
		
		<?php
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'mota' ),
				'next_text'          => __( 'Next page', 'mota' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mota' ) . ' </span>',
			) );
		?>
	</div>
</section>
-->
        
<?php get_footer(); ?>