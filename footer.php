</div>
<!-- /mainwrapper -->


<footer>
	<div class="footer-inner">
		<div class="theme-copyright">
			<?php printf( esc_html('%1$s %2$s', 'mota' ), bloginfo( 'name' ), date_i18n(__('Y','mota')) ); ?>
		</div>
		<div class="theme-linklove">
			<a href="<?php echo esc_url('http://www.flohauck.de'); ?>" target="_blank"><?php printf( __( 'Theme by %s', 'mota' ), 'Flo Hauck' ); ?></a>
		</div>
		<div class="clear"></div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>