<?php
$subheading = get_post_meta( get_the_ID(), 'header_subheading', true );
$subtitle = get_post_meta( get_the_ID(), 'header_subtitle', true );
$button_label = get_post_meta( get_the_ID(), 'header_button_label', true );
$button_label = empty( $button_label ) ? __( 'Continue reading', 'inaset' ) : $button_label;

$html_id =  is_page_template('tpl-art-gallery.php' )  ? 'id="js-trigger-menu"' : '';


?>
<header role="banner" class="block-header" <?php echo $html_id; ?>>
	<div class="background-image">
		<div class="image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
	</div>
	<div class="container">
		<div class="row row__padded">
			<div class="column column-lg-10 column__shift-1 column__offset-1 column__center">
				<h1 data-anim="fadeInUp" data-anim-delay="250"><?php the_title(); ?></h1>
				<?php if( !empty( $subheading ) ) : ?>
                    <p class="sub-heading" data-anim="fadeInUp" data-anim-delay="500"><?php echo wp_kses_post( $subheading ); ?></p>
				<?php endif; ?>
				<?php if( !empty( $subtitle ) ) : ?>
					<p class="intro-text" data-anim="fadeInUp" data-anim-delay="500"><?php echo wp_kses_post( $subtitle ); ?></p>
				<?php endif; ?>
			</div>
			<div class="column column__bottom">
				<a data-anim="fadeInUp" data-anim-delay="750" href="#" title="<?php echo esc_attr( $button_label ); ?>" class="button js-scroll-down"><?php echo esc_html( $button_label ); ?></a>
			</div>
		</div>
	</div>
</header>