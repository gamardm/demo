<section class="block-buy-intro">
	<div class="container">
		<div class="row row__padded">
			<div class="column column-lg-3 column__shift-2">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="column column-lg-5 column__offset-2">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

<section class="block-buy-select">
	<div class="row">
		<div class="column column-lg-6">
			<div class="block-buy-select__type">
				<div class="block-buy-select__type-content">
					<h2><?php esc_html_e( 'Distributors', 'inaset' ); ?></h2>
					<a href="<?php echo esc_url( add_query_arg( 'type', 'distributors' ) ); ?>" title="<?php esc_attr_e( 'Search here', 'inaset' ); ?>" class="button"><?php esc_html_e( 'Search here', 'inaset' ); ?></a>
				</div>
				<div class="background-image">
					<div class="image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/wheretobuy-distributors.jpg');"></div>
				</div>
			</div>
		</div>
		<div class="column column-lg-6">
			<div class="block-buy-select__type">
				<div class="block-buy-select__type-content">
					<h2><?php esc_html_e( 'Sales Offices', 'inaset' ); ?></h2>
					<a href="<?php echo esc_url( add_query_arg( 'type', 'sales' ) ); ?>" title="<?php esc_attr_e( 'Search here', 'inaset' ); ?>" class="button"><?php esc_html_e( 'Search here', 'inaset' ); ?></a>
				</div>
				<div class="background-image">
					<div class="image" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/wheretobuy-salesoffices.jpg');"></div>
				</div>
			</div>
		</div>
	</div>
</section>