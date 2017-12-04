<?php
$video = get_post_meta( get_the_ID(), 'header_video', true );
$subtitle = get_post_meta( get_the_ID(), 'header_subtitle', true );
$header_paper_range = get_post_meta( get_the_ID(), 'header_paper_range', true );
?>
<header role="banner" class="block-header" id="js-trigger-menu">
    <div class="background-video js-hide-if-ie" style="display:none;">
        <video class="background-video__video" src="<?php echo esc_url( $video ); ?>" loop autoplay preload poster="<?php the_post_thumbnail_url( 'full' ); ?>">
        </video>
    </div>

    <div class="background-image js-show-if-ie">
        <div class="image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
    </div>

    <?php /*
	<video class="background-video" src="<?php echo esc_url( $video ); ?>" autoplay preload loop poster="<?php the_post_thumbnail_url( 'full' ); ?>"></video>
    */ ?>
    <div class="container">
        <div class="row row__padded">
            <div class="column column-lg-8 column__shift-2 column__offset-2 column__center">
                <h1 data-anim="fadeInUp" data-anim-delay="250"><?php the_title(); ?></h1>
                <?php if( !empty( $subtitle ) ) : ?>
                    <p class="sub-heading" data-anim="fadeInUp" data-anim-delay="500"><?php echo wp_kses_post( $subtitle ); ?></p>
                <?php endif;
                if( !empty( $subtitle ) ) : ?>
                    <p class="paper-weight-range" data-anim="fadeInUp" data-anim-delay="750"><?php echo wp_kses_post( $header_paper_range ); ?></p>
                <?php endif; ?>
            </div>
            <div class="column column__bottom">
                <a href="#" title="<?php esc_attr_e( 'Learn more', 'inaset' ); ?>" class="button js-scroll-down" data-scroll-offset="-1" data-anim="fadeInUp" data-anim-delay="800"><?php esc_html_e( 'Learn more', 'inaset' ); ?></a>
            </div>
        </div>
    </div>
</header>