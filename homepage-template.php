<?php
/*
Template Name: Homepage Template
*/
get_header(); // This includes the header.php file


?>
<div class="homepage-container homepage">
  <div class="hero-section">
    <div class="blog-article-container">
      <div class="welcome-hero-txt">
        <h1 class="">
          TripTalesToday <br />
          Discover and Explore <br />
          the World's Best Destinations
        </h1>
        <p class="">
          Find Best Place, Activities, Hotel and many more think
          in just One click
        </p>
      </div>
    </div>
  </div>
</div>



<div class="product-page-container">
  <div class="product-sections-container">
    <div class="product-section-header">
      <h2>Hotels and Resorts</h2>
      <p>
        Discover unparalleled luxury and breathtaking experiences with our handpicked
        selection of hotels and resorts across three iconic destinations: Turkey, Greece, and Egypt.
        Your perfect getaway awaits in the heart of these timeless destinations.
      </p>
    </div>
  </div>
  <div class="product-section-main-container">

    <?php
    $category_slugs = array('turkey', 'greece', 'egypt');
    $categories_info = get_category_info_by_slugs($category_slugs);

    // Display the retrieved information
    foreach ($categories_info as $category) {
    ?>
      <a href=<?php echo $category['archive_url'] ?> class="product-section-main-info">
        <div class="product-section-image-part">
          <img src="<?php echo $category['image_url'] ?>" alt="" loading="lazy" />
        </div>
        <div class="product-section-texts-part">
          <h3> <?php echo $category['name'] ?></h3>
          <p> <?php echo $category['description'] ?></p>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
</div>





<div id="statistics" class="statistics">
  <div class="blog-article-container stats-container">
    <div class="statistics-counter">
      <div class="col-md-3 col-sm-6">
        <div class="single-ststistics-box">
          <div class="statistics-content">
            <div class="counter">90</div>
            <span>+</span>
          </div>
          <!--/.statistics-content-->
          <h3>Articles</h3>
        </div>
        <!--/.single-ststistics-box-->
      </div>
      <!--/.col-->
      <div class="col-md-3 col-sm-6">
        <div class="single-ststistics-box">
          <div class="statistics-content">
            <div class="counter">40</div>
            <span>+</span>
          </div>
          <!--/.statistics-content-->
          <h3>Hotels</h3>
        </div>
        <!--/.single-ststistics-box-->
      </div>
      <!--/.col-->
      <div class="col-md-3 col-sm-6">
        <div class="single-ststistics-box">
          <div class="statistics-content">
            <div class="counter">65</div>
            <span>+</span>
          </div>
          <!--/.statistics-content-->
          <h3>Activities</h3>
        </div>
        <!--/.single-ststistics-box-->
      </div>
      <!--/.col-->
      <div class="col-md-3 col-sm-6">
        <div class="single-ststistics-box">
          <div class="statistics-content">
            <div class="counter">10</div>
            <span>k+</span>
          </div>
          <!--/.statistics-content-->
          <h3>Visitors</h3>
        </div>
        <!--/.single-ststistics-box-->
      </div>
      <!--/.col-->
    </div>
    <!--/.statistics-counter-->
  </div>
  <!--/.container-->
</div>

<div class="product-page-container">
  <div class="product-sections-container">
    <div class="product-section-header">
      <h2>Our Blog</h2>
      <p>
      Join us as we traverse the globe, one story at a time. 
      Let TripTalesToday be your compass in the vast world of travel,
       guiding you to new horizons and unforgettable experiences.
        Pack your bags, open your mind, and let the journey begin!
      </p>
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


<?php
get_footer();
