<?php /** Template Name: Where To Buy */ ?>

<?php get_header(); ?>
<?php //    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> ?>

<?php while( have_posts() ) : the_post();

    $types = array( 'distributors' => 1, 'sales' => 1 );

    if( empty( $_GET['type'] ) || ! array_key_exists( $_GET['type'], $types ) ) :

	    get_template_part('parts/where-to-buy-intro', '' );

    else:  ?>

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
            .block-buy-locations__selector.show{
                display:block;
            }
            .block-buy-locations__selector.hidden{
                display:none;
            }

            .block-buy-locations__selector .list {
                padding: 0 0 45px 0;
                position: absolute;
                background: #9C1F40;
                color: #ffffff;
                display: none;
                right: 0;
                bottom: 180%;
                z-index: 101;
                height: 320px;
                margin-left: -187px;
                width: 320px;
            }

            .block-buy-locations__selector .list li {
                padding: 15px 10px 15px 40px;
                font-size: 12px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.25);
                background: url(/wp-content/themes/inaset-paper/assets/images/mini-marker-icon.png) no-repeat 5px center;
            }

            .block-buy-locations__selector .list li a{color:#ffffff;}

            .block-buy-locations__selector .list ul {
                list-style: none;
                margin: 10px 0 0 0;
                padding: 10px 45px 0 45px;
                text-align: left;
                margin-bottom: 30px;
                height: 95%;
                overflow-y: auto;
            }

            .block-buy-locations .block-buy-locations__selector .button__list-view.beforeArrow:before {
                width: 0;
                height: 0;
                border-left: 20px solid transparent;
                border-right: 20px solid transparent;
                border-top: 20px solid #9C1F40;
                content: ' ';
                position: absolute;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                top: -55px;
                right: 0;
                z-index: 101;
            }

            .block-buy-locations__selector .list .close {
                width: 20px;
                height: 20px;
                position: relative;
                top: 10px;
                left: 10px;
                display: block;
                z-index: 100;
                color: #fff;
                text-shadow: none;
                font-size: 40px;
                opacity: 0.5;
                line-height: 17px;
                cursor: pointer;
            }

            .block-buy-locations .map-overlay {
                width: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 100;
                background: rgba(0,0,0,0.5);
                height: 100%;
                display: none;
            }

            @media (min-width: 1024px) {

                .block-buy-locations__selector .list {
                    bottom: 135%;
                }

                .block-buy-locations .block-buy-locations__selector .button__list-view.beforeArrow:before {
                    top: -48px;
                }
            }

        </style>

        <section class="block-buy-intro">
            <div class="container">
                <div class="row row__padded">
                    <div class="column column-lg-3 column__shift-2">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="column column-lg-5 column__offset-2">
                        <div class="button-group">
                            <a href="<?php echo esc_url( add_query_arg( 'type', 'distributors' ) ); ?>" title="<?php esc_attr_e( 'Distributors', 'inaset' ); ?>" id="B2C-button" class="button <?php echo (isset($_GET['type']) && $_GET['type'] =='sales') ? '' : 'current';?>"><?php esc_html_e( 'Distributors', 'inaset' ); ?></a>
                            <a href="<?php echo esc_url( add_query_arg( 'type', 'sales' ) ); ?>" title="<?php esc_attr_e( 'Sales Offices', 'inaset' ); ?>" id="offices-button" class="button <?php echo (isset($_GET['type']) && $_GET['type'] =='sales') ? 'current' : '';?>"><?php esc_html_e( 'Sales Offices', 'inaset' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="block-buy-locations">

            <div id="map" class="map-canvas"></div>

            <div class="map-overlay"></div>

            <div class="block-buy-locations__selector <?php echo (isset($_GET['type']) && $_GET['type'] =='sales') ? 'hidden' : '';?>" id="B2CContent">
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-8 column__shift-4">
						<span class="select has-button">  <!-- adicionar a classe .has-button quando mostrar o .button__list-view -->
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
								<path fill-rule="evenodd" d="M24.0494491,34.5315903 C20.0718842,30.5607814 20.0718842,24.0631806 24.0494491,20.0923717 C26.0640915,18.0811951 28.6469574,17.1014222 31.2815431,17.1014222 C33.9160421,17.1014222 36.5505411,18.0811951 38.5135504,20.0923717 C42.4912021,24.0631806 42.4912021,30.5607814 38.5135504,34.5315903 C34.5358987,38.5023126 28.0271008,38.5023126 24.0494491,34.5315903 L24.0494491,34.5315903 Z M49,43.5044386 L40.6831786,35.2019247 C44.7640096,30.3545179 44.5573908,23.1349519 40.0115155,18.596897 C35.2074751,13.8010343 27.4071575,13.8010343 22.6030303,18.596897 C17.7989899,23.3927596 17.7989899,31.1796582 22.6030303,35.9754342 C24.9793641,38.34768 28.1820867,39.5852605 31.3331762,39.5852605 C34.174294,39.5852605 36.9637788,38.6054877 39.2883061,36.6974861 L47.6052142,45 L49,43.5044386 Z" transform="translate(-19 -15)"/>
							</svg>

							<select name="country" id="countries-b2b" >
<?php // 							<select name="country" class="selectpicker" id="countries-b2b" data-live-search="true"> ?>
                                <option value="empty"><?php esc_html_e( 'Loading ...', 'inaset' ); ?></option>
							</select>

						</span>
                            <!-- show/hide -->
                            <a href="#" title="List View" id="list-toggle" class="button button__list-view">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 19">
                                    <polygon points="8 19 29 19 29 16 8 16"/>
                                    <polygon points="8 11 29 11 29 8 8 8"/>
                                    <polygon points="8 3 29 3 29 0 8 0"/>
                                    <polygon points="0 19 3 19 3 16 0 16"/>
                                    <polygon points="0 11 3 11 3 8 0 8"/>
                                    <polygon points="0 3 3 3 3 0 0 0"/>
                                </svg>
                                <span><?php esc_html_e( 'List view', 'inaset' ); ?></span>
                            </a>

                            <div class="list">
                                <span class="close">&times;</span>
                                <ul class="buy-location__list">
                                    <li><?php esc_html_e( 'Please, select the country first', 'inaset' ); ?></li>
                                </ul>
                            </div>

                            <!-- .show/hide -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- offices-->
            <div class="block-buy-locations__selector <?php echo (isset($_GET['type']) && $_GET['type'] =='sales') ? 'show' : 'hidden';?>" id="officesContent">
                <div class="container">
                    <div class="row row__padded">
                        <div class="column column-lg-8 column__shift-4">

                            <span class="select">  <!-- adicionar a classe .has-button quando mostrar o .button__list-view -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                                    <path fill-rule="evenodd" d="M24.0494491,34.5315903 C20.0718842,30.5607814 20.0718842,24.0631806 24.0494491,20.0923717 C26.0640915,18.0811951 28.6469574,17.1014222 31.2815431,17.1014222 C33.9160421,17.1014222 36.5505411,18.0811951 38.5135504,20.0923717 C42.4912021,24.0631806 42.4912021,30.5607814 38.5135504,34.5315903 C34.5358987,38.5023126 28.0271008,38.5023126 24.0494491,34.5315903 L24.0494491,34.5315903 Z M49,43.5044386 L40.6831786,35.2019247 C44.7640096,30.3545179 44.5573908,23.1349519 40.0115155,18.596897 C35.2074751,13.8010343 27.4071575,13.8010343 22.6030303,18.596897 C17.7989899,23.3927596 17.7989899,31.1796582 22.6030303,35.9754342 C24.9793641,38.34768 28.1820867,39.5852605 31.3331762,39.5852605 C34.174294,39.5852605 36.9637788,38.6054877 39.2883061,36.6974861 L47.6052142,45 L49,43.5044386 Z" transform="translate(-19 -15)"/>
                                </svg>

<?php //                                <select name="offices" id="countries-offices" data-live-search="true"  class="selectpicker"> ?>
                                <select name="offices" id="countries-offices">
                                    <option value="empty"><?php esc_html_e( 'Loading ...', 'inaset' ); ?></option>
                                </select>

                            </span>

                        </div>
                    </div>
                </div>
            </div>


        </section>

    <?php endif; ?>

<?php endwhile; ?>

<?php //    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> ?>

<?php get_footer(); ?>