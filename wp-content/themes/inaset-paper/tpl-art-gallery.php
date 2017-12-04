<?php /** Template Name: Art Gallery */ ?>

<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'parts/header', 'page' ); ?>

	<?php get_template_part( 'parts/art-gallery', '' ); ?>

	<?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>