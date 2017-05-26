<section id="top-section">
	<div class="innerwidth">
		<div class="top-section-inner">
			<div class="top-section-content">
				<h1 class="headline-main"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
			</div>
		</div>
	</div>
	<div class="top-section-image">
	<?php the_post_thumbnail('mota_big-header-xxlarge'); ?>
	</div>
</section>