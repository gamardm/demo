<?php /** Template Name: Awards */ ?>

<?php get_header(); ?>


<?php while( have_posts() ) : the_post();

	$header_logo = get_post_meta( get_the_ID(), 'header_logo', true );
	$subheading = get_post_meta( get_the_ID(), 'header_subheading', true );
	$title = get_post_meta( get_the_ID(), 'header_title', true );
	$subtitle = get_post_meta( get_the_ID(), 'header_subtitle', true );

	$intro = get_post_meta( get_the_ID(), 'header_intro', true );
	$apply_link = get_post_meta( get_the_ID(), 'header_cta_link', true );

	$prizes_title = get_post_meta( get_the_ID(), 'prizes_title', true );
	$prizes_intro = get_post_meta( get_the_ID(), 'prizes_intro', true );
	$prizes_link = get_post_meta( get_the_ID(), 'prizes_cta_link', true );

?>

	<section class="block-page-awards">
		<div class="awards-bg-level1"></div>
		<div class="container">
			<div class="awards-bg-level2"></div>
			<div class="awards-bg-level3"></div>
			<h1 class="awards-logo">
				<img src="<?php echo esc_url( $header_logo ); ?>">
				<?php if( !empty( $subheading ) ) : ?>
					<span class="hide-text"><?php echo wp_kses_post( $subheading ); ?></span>
				<?php endif; ?>
			</h1>
			<h2><?php echo esc_html( $title ); ?></h2>
			<h3><?php echo wp_kses_post( $subtitle ); ?></h3>
			<div class="awards-text__intro">
				<?php echo wpautop( wp_kses_post( $intro )); ?>
				<?php if( !empty( $apply_link ) ) : ?>
					<a target="_blank" href="<?php echo esc_url( $apply_link ); ?>" title="<?php esc_attr_e( 'Apply Now', 'inaset' ); ?>" class="button__awards"><?php esc_html_e( 'Apply Now', 'inaset' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="awards-images">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Inaset-Artist-solo.jpg" alt="Inaset Awards artist image" class="awards-images__artist">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/awards_reams.png" alt="Inaset Awards reams image" class="awards-images__reams">
			</div>
			<div class="awards-text__prizes">
				<h4><?php echo esc_html( $prizes_title ); ?></h4>
				<?php echo wpautop( wp_kses_post( $prizes_intro ) ); ?>
				<?php if( !empty( $prizes_link ) ) : ?>
					<a target="_blank" href="<?php echo esc_url( $prizes_link ); ?>" title="<?php esc_attr_e( 'See the prizes', 'inaset' ); ?>" class="button__awards"><?php esc_html_e( 'See the prizes', 'inaset' ); ?></a>
				<?php endif; ?>

			</div>
		</div>
	</section>

<?php endwhile; ?>

<?php get_footer(); ?>