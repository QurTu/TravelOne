<?php

remove_filter('term_description', 'wpautop');
remove_filter('acf_the_content', 'wpautop');
add_theme_support('post-thumbnails');
// Menus
add_theme_support('menus');

add_action('init', 'ws_remove_support', 100);
function ws_remove_support() {
    remove_post_type_support('page', 'editor');
}

add_action('admin_menu', 'ws_remove_menus');
function ws_remove_menus() {
    remove_menu_page('upload.php');
    remove_menu_page('edit-comments.php');
}

add_filter('upload_mimes', 'ws_allow_svg', 10, 1);
function ws_allow_svg($upload_mimes) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}

add_action('wp_enqueue_scripts', 'ws_load_scripts');
function ws_load_scripts() {
    wp_enqueue_style('style_css', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('script_js', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);
    wp_enqueue_script('splide_js', get_template_directory_uri() . '/assets/js/splide/dist/js/splide.min.js', array('jquery'), '', true);
}

add_action('admin_enqueue_scripts', 'ws_load_admin_scripts');
function ws_load_admin_scripts() {
    if (isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'hotels_resorts_category') {
        wp_enqueue_media();
        wp_enqueue_script('ws-taxonomy-image', get_template_directory_uri() . '/assets/js/taxonomy-image.js', array('jquery'), '', true);
    }
}

