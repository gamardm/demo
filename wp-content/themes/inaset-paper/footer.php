	<footer role="contentinfo" class="footer">
		<div class="container">
			<div class="row row__padded">
				<div class="column column-half column-lg-2">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-printpower.png" alt="logo print power">
				</div>
				<div class="column column-lg-7 column__center">
					<ul class="footer-menu">
						<?php echo inaset_render_navigation('footer'); ?>
					</ul>
				</div>
				<div class="column column-half column-lg-3">
                    <a href="http://thenavigatorcompany.com/" target="_blank" title="The Navigator Company website" rel="external">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-navigator.svg" alt="">
                    </a>
				</div>
			</div>
		</div>
	</footer>

	<!-- begin wp_footer -->
	<?php wp_footer(); ?>
</body>
</html>