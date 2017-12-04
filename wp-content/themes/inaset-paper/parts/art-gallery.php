<section class="block-art-gallery js-vue-art-gallery"  v-cloak>

    <div class="slider-navigation" v-show="originalSlidesLength > 1">
        <a href="#" v-for="n in originalSlidesLength" :class="{'button__slider':1,'slide-item__current': n === currentSlide }" @click.prevent="goToSlide(n)" role="button"></a>
    </div>

	<div class="slider js-slider-container">

        <div class="js-slider-track" :style="{ width: width.track + 'px', transform: 'translate(-' + transform + 'px)', transition: 'transform ease ' + transitionDelay + 'ms'}">

            <div v-if="slides.length > 0" v-for="(slide,index) in slides" :class="{'slide-item': 1, 'slide-item__current': index === currentSlide }" :style="{ width: width.slide + 'px'}">

                <div class="container" v-if="slide">
                    <div class="row row__padded">
                        <div class="column column-lg-4 slide-content">
                            <h2 :class="{'fadeInUp': index === currentSlide }" data-anim-delay="250" v-html="slide.title.rendered"></h2>
                            <p>{{slide.art_year}}<br>{{slide.art_author}}</p>
                            <div v-html="slide.content.rendered"></div>
                        </div>
                        <div class="column column-lg-8">
                            <div class="background-image">
                                <div v-if="slide.featured_image.full.length > 0" class="image" :style="{ backgroundImage: 'url('+ slide.featured_image.full +')' }"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

	</div>
</section>