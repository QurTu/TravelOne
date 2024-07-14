<?php
// Custom permalink structure for posty ( adds 2 category)
$GLOBALS['my_custom_post_types'] = array('hotels-resorts');

add_filter('post_type_link', 'custom_post_type_link', 10, 2);
function custom_post_type_link($post_link, $post) {
    if (!empty($post->post_type) && in_array($post->post_type, $GLOBALS['my_custom_post_types'])) {
        $terms = get_the_terms($post->ID, 'hotels_resorts_category');
        if ($terms) {
            $term_hierarchy = array();
            $current_term = $terms[0]; // Get the first term

            // Build the term hierarchy
            while ($current_term) {
                array_unshift($term_hierarchy, $current_term->slug);
                if ($current_term->parent) {
                    $current_term = get_term($current_term->parent, 'hotels_resorts_category');
                } else {
                    break;
                }
            }

            $category_path = implode('/', $term_hierarchy);
            return home_url("/hotels-resorts/{$category_path}/{$post->post_name}/");
        }
    }
    return $post_link;
}

// Modify the main query to include custom post types
add_action('pre_get_posts', 'include_custom_post_types_in_query', 3);
function include_custom_post_types_in_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search() ) {
            $query->set('post_type', array('post', 'hotels-resorts'));
        }
    }
    return $query;
}

// Add rewrite rules for custom permalink structure
add_action('init', 'add_custom_rewrite_rules');
function add_custom_rewrite_rules() {
    add_rewrite_rule(
        '^hotels-resorts/(.+)/([^/]+)/?$',
        'index.php?post_type=hotels-resorts&hotels_resorts_category=$matches[1]&name=$matches[2]',
        'top'
    );
}

// Flush rewrite rules on theme activation
function ws_rewrite_flush() {
    ws_custom_post_types();
    ws_register_taxonomy();
    add_custom_rewrite_rules();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'ws_rewrite_flush');

// Optionally, you can also flush rewrite rules on plugin activation or theme switch
add_action('after_switch_theme', 'flush_rewrite_rules');