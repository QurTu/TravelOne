<?php



define('THEME_DIR', get_template_directory());



require_once THEME_DIR . '/inc/base.php';
require_once THEME_DIR . '/inc/hotels-and-resorts.php';
require_once THEME_DIR . '/inc/hotels-and-resorts-taxonomy.php';
require_once THEME_DIR . '/inc/permalink-structure-cutom-type.php';
require_once THEME_DIR . '/inc/menu.php';






function get_category_info_by_slugs($category_slugs) {
    $categories_info = array();

    foreach ($category_slugs as $slug) {
        $term = get_term_by('slug', $slug, 'hotels_resorts_category');
        
        if ($term && !is_wp_error($term)) {
            $image_id = get_term_meta($term->term_id, 'category-image-id', true);
            $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

            $categories_info[] = array(
                'id' => $term->term_id,
                'name' => $term->name,
                'slug' => $term->slug,
                'description' => $term->description,
                'count' => $term->count,
                'image_url' => $image_url,
                'archive_url' => get_term_link($term)
            );
        }
    }
    return $categories_info;
}


function get_latest_posts($post_type = 'post', $posts_per_page = 3) {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish'
    );

    $latest_posts = new WP_Query($args);

    return $latest_posts;
}

function custom_woocommerce_style_pagination() {
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="woocommerce-pagination">';
    echo '<ul class="page-numbers">';

    if ( get_previous_posts_link() ) {
        printf( '<li>%s</li>', get_previous_posts_link( '&larr;' ) );
    }

    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="current"' : '';
        printf( '<li><a href="%s"%s>%s</a></li>', esc_url( get_pagenum_link( 1 ) ), $class, '1' );

        if ( ! in_array( 2, $links ) ) {
            echo '<li class="dots">…</li>';
        }
    }

    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="current"' : '';
        printf( '<li><a href="%s"%s>%s</a></li>', esc_url( get_pagenum_link( $link ) ), $class, $link );
    }

    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) ) {
            echo '<li class="dots">…</li>';
        }
        $class = $paged == $max ? ' class="current"' : '';
        printf( '<li><a href="%s"%s>%s</a></li>', esc_url( get_pagenum_link( $max ) ), $class, $max );
    }

    if ( get_next_posts_link() ) {
        printf( '<li>%s</li>', get_next_posts_link( '&rarr;' ) );
    }

    echo '</ul>';
    echo '</nav>';
}


function custom_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}


