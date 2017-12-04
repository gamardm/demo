<?php
$apply_link = 'http://www.inasetpaperawards.com/';
?>

<section class="block-splash-page js-vue-splash" v-if="showSplash" v-cloak>
	<div class="awards-bg-level1"></div>
	<div class="container">
		<div class="awards-bg-level2"></div>
		<div class="awards-bg-level3"></div>
		<a @click.prevent="continueToMain" href="#" class="go-to-inaset">
			<span><?php esc_html_e( 'continue to Inaset Paper', 'inaset' ); ?></span>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-inaset-white.svg" alt="Inaset">
		</a>
		<h1 class="awards-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-inaset-awards.svg">
            <span class="hide-text"><?php esc_html_e( 'Inaset Awards 2018 Edition', 'inaset' ); ?></span>
		</h1>
		<h2><?php esc_html_e( 'Make your mark!', 'inaset' ); ?></h2>
		<div class="awards-cta">
			<h3><?php esc_html_e( 'All Printers & Designers get ready! This call is for you!', 'inaset' ); ?></h3>
			<?php if( !empty( $apply_link ) ) : ?>
				<a href="<?php echo esc_url( $apply_link ); ?>" title="<?php esc_attr_e( 'Tell me more', 'inaset' ); ?>" class="button__awards"><?php esc_html_e( 'Tell me more', 'inaset' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>