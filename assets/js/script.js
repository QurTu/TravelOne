jQuery(document).ready(function($){ 
    console.log('test');
})


jQuery(document).on('touchend', 'header .header-buttons .header-button', function(e) {
    jQuery(this).click();

});


// hide nav bar when in search
let model = document.getElementsByClassName('navbar-toggle')[0];
jQuery('.header-hamburger').click(function() {
    jQuery('.navbar-toggle').toggle();
});
window.onclick = function(e) {
    if (e.target == model) {
        jQuery('.navbar-toggle').toggle();
    }
}
jQuery(".toggle-close").click(function() {
    jQuery('.navbar-toggle').toggle();
})



jQuery( document ).ready( function () {
    jQuery(".toggle-main-main-nav-item-self").each( function() {
            jQuery(this).next().toggle();

    })
})

jQuery(".toggle-main-main-nav-item-self").each( function() {
    jQuery(this).click(function() {
        jQuery(this).find('svg').toggleClass('flip');
        jQuery(this).next().toggle();
    })
})


       

        
jQuery( document ).ready( function () {
      var sliderContainer = document.querySelector('.slider-container');
      
      if (sliderContainer) {
          const splide = new Splide('.slider-container', {
              type   : 'loop',
              drag   : 'free',
              focus  : 0,
              perPage: 4,
              autoScroll: {
                speed: 1,
              },
              breakpoints: {
                  1100: {
                      perPage: 3,
                  },
                  897: {
                      perPage: 2,
                  },
                  597: {
                      perPage: 1,
                  }
              }
          });
          splide.mount();
      }

  var thumbnailCarousel = document.getElementById('thumbnail-carousel');
  var mainCarousel = document.getElementById('main-carousel');
 
  if (mainCarousel && thumbnailCarousel) {
      var main = new Splide(mainCarousel, {
          type      : 'fade',
          rewind    : true,
          pagination: false,
          arrows    : false,
      });

      var thumbnails = new Splide(thumbnailCarousel, {
          fixedWidth  : 150,
          fixedHeight : 100,
          gap         : 10,
          arrows      : false,
          rewind      : true,
          pagination  : false,
          isNavigation: true,
          breakpoints : {
              600: {
                  fixedWidth : 90,
                  fixedHeight: 60,
              },
          },
      });

      main.sync(thumbnails);
      main.mount();
      thumbnails.mount();
  }
});

