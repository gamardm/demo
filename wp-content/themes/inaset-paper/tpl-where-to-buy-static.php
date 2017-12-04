<?php /** Template Name: Where To Buy Static */ ?>

<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

    <style>
        /*CSS MARKER*/
        #map .marker{
            max-width: 270px;
        }
        #map .marker p{
            margin-bottom: 5px;
        }
        #map .marker p.address{
            margin-bottom: 15px;
        }
        #map .marker h1{
            padding-top: 15px;
            font-size: 20px;
            color: #9c1f40;
        }
        #map .marker img{
            max-width: 100%;
            padding-bottom: 15px;
        }
        #map .marker strong{
            color: #9c1f40;
        }
    </style>

	<section class="block-buy-locations">
		<div class="container">
			<div class="row row__padded">
				<div class="column column-lg-6">
					<div class="button-group">
						<a href="#" title="Distributors" id="B2C-button" class="button current">Distributors</a>
						<a href="#" title="Sales Offices" id="offices-button" class="button">Sales Offices</a>
					</div>
                    <div id="B2CContent">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <span class="select">
                            <select name="country" id="countries-b2b">
                                <option value="empty">Loading ... </option>
                            </select>
                        </span>
                        <ul class="buy-location__list"></ul>
                    </div>
                    <div id="officesContent" style="display: none;">
                        <h1><?php the_title(); ?></h1>
                        <span class="select">
                            <select name="countryOffice" id="countries-offices">
                                <option value="empty">Loading ... </option>
                            </select>
                        </span>
                    </div>
				</div>
			</div>
		</div>
		<!-- <div class="map-canvas"></div> -->
		<div class="background-image">
            <div id="map" style="height: 100%"></div>
		</div>
	</section>

<?php endwhile; ?>

<?php get_footer(); ?>

<!--jQuery-->
<script src="<?php echo get_template_directory_uri(); ?>/source/scripts/jquery-3.2.1.min.js"></script>

<!--WhereToBuy-->
<script src="<?php echo get_template_directory_uri(); ?>/source/scripts/whereToBuy.js"></script>

<!--Mapa-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA87qaNljcTvPeoWjx6-YrhHoGYC8UkSy0&callback=initMap" async defer></script>