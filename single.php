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


<?php endwhile;
else :
    // If no content, include the "No posts found" template.
    echo 'somethign wrong try another page';

endif;
?>

<div class="product-page-container">
  <div class="product-sections-container">
    <div class="product-section-header">
      <h2>Latest Blogs</h2>
    </div>
  </div>
  <div class="product-section-main-container">
  <?php
  $latest_posts = get_latest_posts('post', 3);

if ($latest_posts->have_posts()) :
    while ($latest_posts->have_posts()) : $latest_posts->the_post();
        ?>

      <a href="<?php the_permalink(); ?>"  class="product-section-main-info">
            <div class="product-section-image-part">
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" loading="lazy" />
            </div>
            <div class="product-section-texts-part">
              <h3><?php the_title(); ?></h3>
              <p> <?php the_excerpt(); ?></p>
            </div>
      </a>


        <?php
    endwhile;

    // Restore original post data
    wp_reset_postdata();

endif;
?>
  </div>
</div>


<div class="blog-article-container">
    <amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-2804192452844752" data-ad-slot="2049943956" data-auto-format="mcrspv" data-full-width="">
        <div overflow=""></div>
    </amp-ad>
</div>

<?php

// Footer
get_footer();
?>