<?php
// BASE START
global $theme_url; 
$theme_url = get_template_directory_uri();

remove_filter('term_description', 'wpautop');
remove_filter('acf_the_content', 'wpautop');
add_theme_support('post-thumbnails');

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
// BASE END

// Custom Post Types
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

// Custom Taxonomy
add_action('init', 'ws_register_taxonomy');
function ws_register_taxonomy() {
    $labels = array(
        'name' => 'Categories',
        'singular_name' => 'Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category Name',
        'menu_name' => 'Categories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'hotels-resorts-category', 'with_front' => false),
    );

    register_taxonomy('hotels_resorts_category', array('hotels-resorts'), $args);
}

// Add image to hotels-resorts categories
add_action('hotels_resorts_category_add_form_fields', 'ws_add_category_image', 10, 2);
add_action('hotels_resorts_category_edit_form_fields', 'ws_edit_category_image', 10, 2);

function ws_add_category_image($taxonomy) {
    ?>
    <div class="form-field term-group">
        <label for="category-image-id"><?php _e('Image', 'text_domain'); ?></label>
        <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
        <div id="category-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary category-media-button" id="category-media-button" name="category-media-button" value="<?php _e('Add Image', 'text_domain'); ?>" />
            <input type="button" class="button button-secondary category-media-remove" id="category-media-remove" name="category-media-remove" value="<?php _e('Remove Image', 'text_domain'); ?>" />
        </p>
    </div>
    <?php
}

function ws_edit_category_image($term, $taxonomy) {
    $image_id = get_term_meta($term->term_id, 'category-image-id', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category-image-id"><?php _e('Image', 'text_domain'); ?></label>
        </th>
        <td>
            <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo esc_attr($image_id); ?>">
            <div id="category-image-wrapper">
                <?php if ($image_id) { echo wp_get_attachment_image($image_id, 'thumbnail'); } ?>
            </div>
            <p>
                <input type="button" class="button button-secondary category-media-button" id="category-media-button" name="category-media-button" value="<?php _e('Add Image', 'text_domain'); ?>" />
                <input type="button" class="button button-secondary category-media-remove" id="category-media-remove" name="category-media-remove" value="<?php _e('Remove Image', 'text_domain'); ?>" />
            </p>
        </td>
    </tr>
    <?php
}

add_action('created_hotels_resorts_category', 'ws_save_category_image', 10, 2);
add_action('edited_hotels_resorts_category', 'ws_save_category_image', 10, 2);

function ws_save_category_image($term_id, $tt_id) {
    if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
        $image = $_POST['category-image-id'];
        add_term_meta($term_id, 'category-image-id', $image, true);
    } else {
        update_term_meta($term_id, 'category-image-id', '');
    }
}

// Custom permalink structure
// Custom permalink structure
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
add_action('pre_get_posts', 'include_custom_post_types_in_query', 12);
function include_custom_post_types_in_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search() || $query->is_archive()) {
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


// Menus
add_theme_support('menus');

function wp_get_menu_array($current_menu) {
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();

    // First level: Top-level menu items
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array(
                'ID' => $m->ID,
                'title' => $m->title,
                'url' => $m->url,
                'children' => array()
            );
        }
    }

    // Second level: Children of top-level menu items
    $submenu = array();
    foreach ($array_menu as $m) {
        if (!empty($m->menu_item_parent) && isset($menu[$m->menu_item_parent])) {
            $submenu[$m->ID] = array(
                'ID' => $m->ID,
                'title' => $m->title,
                'url' => $m->url,
                'children' => array()
            );
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }

    // Third level: Children of second-level menu items
    foreach ($array_menu as $m) {
        if (!empty($m->menu_item_parent)) {
            // Find the second-level parent
            foreach ($submenu as &$sub_item) {
                if ($sub_item['ID'] == $m->menu_item_parent) {
                    $sub_item['children'][$m->ID] = array(
                        'ID' => $m->ID,
                        'title' => $m->title,
                        'url' => $m->url,
                        'children' => array()
                    );
                    // Find the top-level parent
                    foreach ($menu as &$top_item) {
                        if (isset($top_item['children'][$sub_item['ID']])) {
                            $top_item['children'][$sub_item['ID']]['children'][$m->ID] = $sub_item['children'][$m->ID];
                            break 2; // Exit both loops
                        }
                    }
                }
            }
        }
    }

    return $menu;
}


