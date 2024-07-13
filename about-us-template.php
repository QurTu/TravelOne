<?php
/*
Template Name: About Us Template
*/
get_header();
?>

<div class="product-page-container">
    <div class="product-sections-container">
        <div class="product-section-header">
            <h1>About Us</h1>
            <p>
                TripTalesToday started with a simple idea: sharing our travel experiences on YouTube.
                As our channel began to grow, we realized that we could turn this into something bigger.
                We began not only documenting our travels but also providing educational content.
                The TripTalesToday website is our way to inspire everyone to fall in love with traveling.
            </p>
        </div>
    </div>
    <div class="product-section-main-container">
        <div class="product-section-main-info">
            <div class="product-section-image-part">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us/hotel.jpg" alt="luxory hotel image" loading="lazy" />
            </div>
            <div class="product-section-texts-part">
                <h3>Luxury Vacation</h3>
                <p>We have numerous pages where you can find all the information you need about the hotels or resorts you like. You can also explore our extensive <a href="/hotels-resorts">library of hotels</a> to find one that truly suits your preferences. What's even better, each hotel features a dedicated video review, so you can see all the amenities the hotel offers. We offer a wide selection of all-inclusive hotels from various locations, including <a href="/hotels-resorts-category/greece">Greece</a>, <a href="/hotels-resorts-category/egypt">Egypt</a>, and <a href="/hotels-resorts-category/turkey">Turkey</a>.</p>
            </div>
        </div>
        <div class="product-section-main-info">
            <div class="product-section-image-part">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us/water.jpg" alt="water activities: surffing" loading="lazy" />
            </div>
            <div class="product-section-texts-part">
                <h3>Travel Activities</h3>
                <p>Discover a world of adventure with our diverse range of travel activities. Whether you're into diving in crystal-clear waters, exploring ancient ruins, or hiking picturesque trails, we have dedicated pages for each activity across various locations. Our extensive collection ensures you find the perfect adventure that suits your interests and preferences. Each activity page provides detailed insights, tips, and recommended spots, making it easier for you to plan your next memorable journey.</p>
            </div>
        </div>
        <div class="product-section-main-info">
            <div class="product-section-image-part">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us/explor.jpg" alt="image of person on the mountain" loading="lazy" />
            </div>
            <div class="product-section-texts-part">
                <h3>Explore The World</h3>
                <p>Step into the world of travel with our blog, where we share a wealth of travel tips, insights into must-visit places in various cities, hidden gems off the beaten path, and everything else related to travel. Whether you're planning your next vacation or simply daydreaming about far-off destinations, our blog is your go-to resource for inspiration and practical advice. Dive into our articles to uncover new adventures, learn about diverse cultures, and discover the beauty of exploring the world.</p>
            </div>
        </div>

    </div>
</div>
<div class="product-page-container">
    <div class="product-sections-container">
        <div class="product-section-header">
            <h2>Our Youtube Channel</h2>
            <p>
               Right now our youtube channel has 1,5k subscribers. We are sharing hotels reviews, top places to visit, to this to do.
               For this time we are focusing on: Turkey, Greece, Egypt, but we have plans to include other popular travel destinations.
               Visit our youtube channel: <a href="https://www.youtube.com/@TripTalesToday">TripTalesToday</a>
            </p>
        </div>
    </div>
    <div class="about-us-image">
        <a href="https://www.youtube.com/@TripTalesToday">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us/youtube.png" alt="TripTalesToday youtube channel image">
        </a>
    </div>
   
    
   
</div>


<?php
get_footer();
