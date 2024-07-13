<?php

add_action('init', 'ws_custom_post_types');
function ws_custom_post_types() {
    $labels = array(
        'name' => 'Hotels and Resorts',
        'singular_name' => 'Hotel and Resort',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Hotel or Resort',
        'edit_item' => 'Edit Hotel or Resort',
        'new_item' => 'New Hotel or Resort',
        'all_items' => 'All Hotels and Resorts',
        'view_item' => 'View Hotel or Resort',
        'search_items' => 'Search Hotels and Resorts',
        'not_found' => 'No hotels or resorts found',
        'not_found_in_trash' => 'No hotels or resorts found in Trash',
        'menu_name' => 'Hotels and Resorts'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'hotels-resorts', 'with_front' => false),
        'query_var' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
        ),
        'taxonomies' => array('hotels_resorts_category'),
    );
    register_post_type('hotels-resorts', $args);
}

add_theme_support('post-thumbnails', array('hotels-resorts'));