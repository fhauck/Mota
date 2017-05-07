</div>
<!-- /mainwrapper -->


<footer class="footer">
	<div class="innerwidth">
		<div class="footer-border">
			
			<?php if ( has_nav_menu( 'footer' ) ) { ?>
				<div class="footer-navi">
					<ul>	
					<?php											
					wp_nav_menu( array( 
					
						'container' => '', 
						'items_wrap' => '%3$s',
						'theme_location' => 'footer'
													
					) ); 
					?>
					</ul>
				</div>
			<?php } ?>
			
			<span>
			<?php printf( esc_html('%1$s %2$s - ', 'mota' ), bloginfo( 'name' ), date_i18n(__('Y','mota')) ); ?>
			<a href="<?php echo esc_url('http://www.flohauck.de'); ?>" target="_blank"><?php printf( __( 'Theme by %s', 'mota' ), 'Flo Hauck' ); ?></a>
			</span>
			
		
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>