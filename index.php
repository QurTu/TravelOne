<?php

get_header();

    if(have_posts()) :
    while(have_posts()) :
    the_post(); ?>

    <div id="page_wrapper" class="all-page-wrapper">
        <?php the_content(); ?>
    </div> <!-- .post -->
<?php endwhile;
endif;


get_footer();