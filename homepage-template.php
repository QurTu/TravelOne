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
      <h2>Our Blog</h2>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil
        exercitationem obcaecati repudiandae repellat eos ea itaque
        inventore harum dolore. Saepe illum possimus sequi ex necessitatibus
        deleniti, cupiditate voluptates explicabo maxime!
      </p>
    </div>
  </div>
  <div class="product-section-main-container">
    <div class="product-section-main-info">
      <div class="product-section-image-part">
        <img src="/img/test3.jpg" alt="" loading="lazy" />
      </div>
      <div class="product-section-texts-part">
        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>Lorem ipsum dolor sit amet consectetur.</p>
      </div>
    </div>
    <div class="product-section-main-info">
      <div class="product-section-image-part">
        <img src="/img/test.jpg" alt="" loading="lazy" />
      </div>
      <div class="product-section-texts-part">
        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas
          quo facilis molestiae recusandae, quisquam modi odit nisi
          laudantium veniam id officia maiores, ipsam fugit. Consectetur
          soluta quibusdam incidunt earum magnam similique, nam distinctio
          quos et, cumque laborum debitis magni perferendis. Voluptatibus
          saepe labore perferendis debitis illo ullam voluptatum ratione
          similique.
        </p>
      </div>
    </div>
    <div class="product-section-main-info">
      <div class="product-section-image-part">
        <img src="/img/test3.jpg" alt="" loading="lazy" />
      </div>
      <div class="product-section-texts-part">
        <h3>Lorem ipsum dolor sit amet.</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas
          quo facilis molestiae recusandae, quisquam modi odit nisi
          laudantium veniam id officia maiores, ipsam fugit. Consectetur
          soluta quibusdam incidunt earum magnam similique, nam distinctio
          quos et, cumque laborum debitis magni perferendis. Voluptatibus
          saepe labore perferendis debitis illo ullam voluptatum ratione
          similique.
        </p>
      </div>
    </div>
  </div>
</div>

<div id="statistics" class="statistics">
  <div class="blog-article-container">
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

<amp-ad width="100vw" height="320" type="adsense" data-ad-client="ca-pub-2804192452844752" data-ad-slot="2049943956" data-auto-format="mcrspv" data-full-width="">
  <div overflow=""></div>
</amp-ad>



<?php
get_footer();
