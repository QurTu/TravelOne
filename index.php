<?php

get_header();

    if(have_posts()) :
    while(have_posts()) :
    the_post(); ?>

<div class="blog-article-container">
        <?php the_content(); ?>
    </div> <!-- .post -->
<?php endwhile;
endif;


get_footer();