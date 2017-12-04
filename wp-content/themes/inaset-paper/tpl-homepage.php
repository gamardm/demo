<?php /** Template Name: Homepage */ ?>

<?php get_header(); ?>

<?php get_template_part( 'parts/splash-screen', '' ); ?>

<?php while( have_posts() ) : the_post(); ?>

    <?php

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 3,
    );
    $products = new WP_Query( $args );

	$video = get_post_meta( get_the_ID(), 'header_video', true );

    ?>

	<section class="block-home js-block-home">

        <div class="background-video js-hide-if-ie" style="display:none;">
            <video class="background-video__video js-home-bg-image" src="<?php echo esc_url( $video ); ?>" loop autoplay preload poster="<?php the_post_thumbnail_url( 'full' ); ?>">
            </video>
        </div>

        <div class="background-image js-show-if-ie">
            <div class="image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
        </div>

        <?php /*
        <video class="background-video js-home-bg-image" src="<?php echo esc_url( $video ); ?>" autoplay preload loop poster="<?php the_post_thumbnail_url( 'full' ); ?>"></video>
        <?php /* <div class="background-image">
			<div class="image js-home-bg-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
		</div> */ ?>
		<div class="container">
			<div class="row row__padded">
				<div class="column">
					<p class="sub-heading js-home-heading" data-anim="fadeInUp" data-anim-delay="250"><?php printf( __( 'Let %sart%s be your canvas.', 'inaset' ), '<em>', '</em>' ); ?></p>
					<p class="intro-text" data-anim="fadeInUp" data-anim-delay="350"><?php esc_html_e( 'Premium Quality Paper Brand for the Graphic Arts Industry.', 'inaset' ); ?></p>
				</div>
				<div class="column home-product__group">
					<?php $i = 2;
                    while( $products->have_posts() ): $products->the_post();
						$class = str_replace( 'page-', 'home-', get_post_meta( $post->ID, 'body_class', true ) );
						$title = get_post_meta( $post->ID, 'home_title', true );
						$keyword = get_post_meta( $post->ID, 'home_keyword', true );
						$video = get_post_meta( get_the_ID(), 'header_video', true );
						$bg = get_post_meta( get_the_ID(), 'home_bg', true );
						?>
						<a data-anim="fadeInUp" data-anim-delay="<?php echo $i * 250; ?>" class="home-product <?php echo esc_attr( $class ); ?> js-home-product" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $title ); ?>" data-bgimage="<?php echo esc_url( $bg ); ?>" data-bgvideo="<?php echo esc_url( $video ); ?>" data-keyword="<?php echo esc_attr( $keyword ); ?>">
							<h2><?php echo esc_html( $title ); ?></h2>
							<p><?php printf( __( 'sublime %s', 'inaset' ), '<em>'. esc_html( $keyword ) .'</em>' ); ?></p>
						</a>
					<?php $i++;
                    endwhile; wp_reset_postdata(); ?>
				</div>

				<?php get_template_part( 'parts/cta-button', '' ); ?>

			</div>
		</div>
	</section>

<?php endwhile; ?>

<?php get_footer(); ?>