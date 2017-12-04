<?php // 404 template ?>

<?php get_header(); ?>

	<header role="banner" class="block-header">
		<div class="background-image"></div>
		<div class="container">
			<div class="row row__padded">
				<div class="column column-lg-6 column__shift-3 column__offset-3 column__center">
					<h1><?php esc_html_e( 'Error 404', 'inaset' );  ?></h1>
					<p class="intro-text"><?php esc_html_e( 'Unfortunately the content you’re looking for isn’t here. There may be a misspelling in your web address or you may have clicked a link for content that no longer exists.', 'inaset' ); ?></p>
				</div>
				<div class="column column__bottom">
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php esc_attr_e( 'Back to homepage', 'inaset' ); ?>" class="button"><?php esc_html_e( 'Back to homepage', 'inaset' ); ?></a>
				</div>
			</div>
		</div>
	</header>

<?php get_footer(); ?>