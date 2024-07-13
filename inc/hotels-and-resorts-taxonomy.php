<?php
// Custom Taxonomy register
add_action('init', 'ws_register_taxonomy');
function ws_register_taxonomy() {
    $labels = array(
        'name' => 'Hotels Categories',
        'singular_name' => 'Hotel Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category Name',
        'menu_name' => ' Hotels Categories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_menu'       => true,
        'show_in_nav_menus' => true,
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