<?php if( is_singular( 'product' ) ) :

	$post = get_post();
	$current_id = $post->ID;

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 3,
	);
	$products = new WP_Query( $args );

	if( $products->have_posts() ): ?>
		<ul class="context-menu" v-if="!isMobile">
			<?php while( $products->have_posts() ): $products->the_post();
				$class = $current_id == get_the_ID() ? 'current-menu-item' : ''; ?>
				<li class="<?php echo $class; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; $products->rewind_posts();  ?>
		</ul>
		<!-- mobile menu -->
        <span class="select context-menu-mobile" v-else>
            <select class="js-open-link">
                <?php while( $products->have_posts() ): $products->the_post(); ?>
                    <option value="<?php the_permalink(); ?>" <?php selected( $current_id, get_the_ID() ); ?>><?php the_title(); ?></option>
                <?php endwhile; wp_reset_postdata(); ?>
            </select>
        </span>
	<?php endif; ?>

<?php elseif( is_page_template( 'tpl-art-gallery.php' ) ):
	$args = array(
		'taxonomy' => 'art_set',
		'hide_empty' => true,
	);
    $sets = get_terms( $args );

	if( !empty( $sets ) ) :

	    wp_localize_script( 'inaset-js', 'INASET_ART_MENU', array( 'sets' => $sets ) );

	    ?>

        <ul class="context-menu" v-if="!isMobile">
            <li v-for="(art, index) in artSets" :class="{ 'current-menu-item': index === currentArtSet }">
                <a href="#" @click.prevent=" currentArtSet = index " :title="art.name">{{ art.name }}</a>
            </li>
        </ul>
        <span class="select context-menu-mobile" v-else>
            <select v-model="currentArtSet">
                <option v-for="(art, index) in artSets" :value="index">{{ art.name }}</option>
            </select>
        </span>

    <?php endif; ?>

<?php endif; ?>
