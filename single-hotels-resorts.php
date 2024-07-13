<?php

get_header();
?>
<div class="product-page-container">

    <?php
    if (have_posts()) :
        while (have_posts()) :
            $hotel_categories = get_the_terms(get_the_ID(), 'hotels_resorts_category');
            $stars = get_field('stars');
            $gallery = get_field('gallery');
            $perks = get_field('perks');
            $sections = get_field('sections');
    ?>
            <div class="product-header-container">
                <div class="product-header-information">
                    <div class="product-header-images">
                        <section id="main-carousel" class="splide" aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Hotel header image" loading="lazy">
                                    </li>
                                    <?php
                                    if ($gallery) :
                                        foreach ($gallery as $image) :
                                    ?>
                                            <li class="splide__slide">
                                                <img src="<?php echo esc_url($image); ?>" alt="" loading="lazy">
                                            </li>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </section>


                        <section id="thumbnail-carousel" class="splide" aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                            <div class="splide__track">
                                <ul class="splide__list">

                                    <li class="splide__slide">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Hotel slider image" loading="lazy">
                                    </li>
                                    <?php
                                    if ($gallery) :
                                        foreach ($gallery as $image) :
                                    ?>
                                            <li class="splide__slide">
                                                <img src="<?php echo esc_url($image); ?>" alt="" loading="lazy">
                                            </li>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div class="product-header-all-info">
                        <div class="hotel-info">
                            <div class="hotel-name-stars">
                                <h1 class="hotel-name"><?php the_title(); ?></h1>
                                <div class="hotel-stars">
                                    <?php for ($i = 0; $i < $stars; $i++) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="star-icon">
                                            <path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <?php if ($hotel_categories && !is_wp_error($hotel_categories)) : ?>
                                <div class="hotel-category">
                                    <?php
                                    $category_links = array();
                                    foreach ($hotel_categories as $category) {
                                        $category_link = get_term_link($category, 'hotels_resorts_category');
                                        if (!is_wp_error($category_link)) {
                                            $category_links[] = sprintf(
                                                '<a href="%s">%s</a>',
                                                esc_url($category_link),
                                                esc_html($category->name)
                                            );
                                        }
                                    }
                                    echo implode(', ', $category_links);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div  class="hotel-tags">

                                <?php
                                if ($perks) :
                                    foreach ($perks as $perk) :
                                ?>
                                        <span> <?php echo $perk; ?></span>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                            <a href="<?php echo esc_url(get_field('link')); ?>" target="_blank" rel="noopener noreferrer nofollow sponsored" class="hotel-info-button">Book Now!</a>
                            <?php the_content(); ?>
                            <div class="hotel-raitings">
                                <div class="rating-wrapper">
                                    <div class="hotel-raiting-value"><?php echo get_field('rating') ?></div>
                                    <div class="hotel-rating-text">raiting</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            if ($sections) :
            ?>
                <div class="products-navigation-bar">
                    <?php foreach ($sections as $section) : ?>
                        <a href="#<?php echo esc_attr($section['slug']); ?>" class="navigation-bar-elemints">
                            <?php echo esc_html($section['section_header']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;

            if ($sections) :
            ?>
                <?php foreach ($sections as $section) : ?>
                    <div class="product-section-all" id=<?php echo esc_attr($section['slug']); ?>>
                        <div class="product-sections-container">
                            <div class="product-section-header">
                                <h2> <?php echo esc_html($section['section_header']); ?></h2>
                                <p> <?php echo esc_html($section['section_description']); ?></p>
                            </div>
                        </div>
                        <div class="product-section-main-container">
                            <?php foreach ($section['section_part'] as $section_part) : ?>
                                <div class="product-section-main-info">
                                    <div class="product-section-image-part">
                                        <img src="<?php echo esc_html($section_part['image']); ?>" alt="" loading="lazy">
                                    </div>
                                    <div class="product-section-texts-part">
                                        <h3><?php echo esc_html($section_part['header']); ?></h3>
                                        <p><?php echo esc_html($section_part['text']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php
            endif;
            ?>

            <!-- 
<div class="splide slider-container" role="group" aria-label="Splide Basic HTML Example">
    <div class="slider-sections-header">
     <h2>Similar hotels</h2>
    </div>
    
     <div class="splide__track">
           <ul class="splide__list">
              
             <li class="splide__slide">
                <div class="slider-simple-img-container">
                    <img src="/img/test3.jpg" alt="" loading="lazy">
                </div>
             <div class="product-section-texts-part">
                <a href="">
                    <h3>Lorem ipsum dolor sit.</h3>
                </a>
                 
                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nemo ipsam quidem accusamus reprehenderit magni sint earum, minus quas dolores!</p>
             </div>
             
        
             </li>
             <li class="splide__slide">
                <div class="slider-simple-img-container">
                    <img src="/img/test.jpg" alt="" loading="lazy">
                </div>
                 <div class="product-section-texts-part">
                     <h3>Lorem ipsum dolor sit.</h3>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nemo ipsam quidem accusamus reprehenderit magni sint earum, minus quas dolores!</p>
                 </div>
              
                     
                 </li>
                 <li class="splide__slide">

                    <div class="slider-simple-img-container">
                        <img src="/img/test.jpg" alt="" loading="lazy">
                    </div>
                     <div class="product-section-texts-part">
                         <h3>Lorem ipsum dolor sit.</h3>
                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nemo ipsam quidem accusamus reprehenderit magni sint earum, minus quas dolores!</p>
                     </div>
                    
                        
                     </li>
                     <li class="splide__slide">
                        <div class="slider-simple-img-container">
                            <img src="/img/test1.png" alt="" loading="lazy">
                        </div>
                         <div class="product-section-texts-part">
                            <a href="/">
                                <h3>Lorem ipsum dolor sit.</h3>
                            </a>
                             
                             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nemo ipsam quidem accusamus reprehenderit magni sint earum, minus quas dolores!</p>
                         </div>
                        
                            
                                 
                         </li>
                         <li class="splide__slide">
                            <div class="slider-simple-img-container">
                                <img src="/img/test1.png" alt="" loading="lazy">
                            </div>
                             <div class="product-section-texts-part">
                                 <h3>Lorem ipsum dolor sit.</h3>
                                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa nemo ipsam quidem accusamus reprehenderit magni sint earum, minus quas dolores!</p>
                             </div>
                            
                             </li>
          
            
              
           </ul>
     </div>
 </div> -->

            <div class="hotel-booking-button-container">
                <a href="<?php echo esc_url(get_field('link')); ?>" rel="noopener noreferrer nofollow sponsored" class="hotel-info-button product-page-button">Book Now! </a>
            </div>
    <?php
    the_post();
        endwhile;
    endif;
    ?>

</div>

<?php
get_footer();
