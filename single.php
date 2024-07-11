<?php
// Header
get_header();

// Start the loop
if (have_posts()) :
    while (have_posts()) : the_post(); ?>




        <div class="blog-article-container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>

        <div class="blog-article-container" >
            <amp-ad width="100vw" height="320"
                type="adsense"
                data-ad-client="ca-pub-2804192452844752"
                data-ad-slot="2049943956"
                data-auto-format="mcrspv"
                data-full-width="">
            <div overflow=""></div>
            </amp-ad>
        </div>

<?php endwhile;
else :
    // If no content, include the "No posts found" template.
    echo 'somethign wrong try another page';

endif;

// Footer
get_footer();
?>