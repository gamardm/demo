<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'parts/header', 'product' ); ?>

	<?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>