<?php
get_header();
?>
<?php $headerNavBar  =  wp_get_menu_array('Articles Side Bar');   ?>

<div class="archive-container">
    <div class="sidebar">
        <h2>Search by Category:</h2>
        <div class="toggle-menu-main-nav">
            <?php
            foreach ($headerNavBar as $item) {
            ?>
                <div class="toggle-main-main-nav-item">
                    <div class="toggle-main-main-nav-item-self">
                        <a href="<?php echo $item['url'] ?>">
                            <?php echo $item['title'] ?>
                        </a>
                        <?php
                        if (!empty($item['children'])) {
                            echo file_get_contents(get_template_directory() . '/assets/icons/arrow-down.svg');
                        }
                        echo '</div>';
                        if (!empty($item['children'])) {
                        ?>
                            <div class="toggle-dropdown">
                                <?php
                                foreach ($item['children'] as $child) {
                                ?>
                                    <a href="<?php echo $child['url'] ?>"> <?php echo $child['title'] ?></a>
                        <?php
                                }
                                echo '</div>';
                            }
                            echo ' </div>';
                        }
                        ?>
                            </div>
                    </div>


                    <div class="content-container">
                        <div class="main-content">
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post();
                                    $hotel_categories = get_the_terms(get_the_ID(), 'hotels_resorts_category');
                                    $perks = get_field('perks');
                                ?>
                                    <div class="hotel-container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                        <div class="hotel-slider">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" loading="lazy" alt="<?php the_title(); ?> main image">
                                            </a>
                                        </div>
                                        <div class="hotel-info">
                                        <a href="<?php the_permalink(); ?>">
                                                <div class="hotel-name-stars">
                                                    <h2 class="hotel-name"><?php the_title(); ?></h2>
                                                   
                                                </div>
                                            </a>
                                           
                                            <?php if ($hotel_categories && !is_wp_error($hotel_categories)) : ?>
                                                <div class="hotel-category">
                                                    <?php
                                                    $category_links = array();
                                                    foreach ($hotel_categories as $category) {
                                                        $category_link = get_term_link($category, 'hotels_resorts_category');
                                                        if (!is_wp_error($category_link)) {
                                                            $category_links[] = sprintf(
                                                                '<a href="%s">%s</a>',
                                                                esc_url($category_link),
                                                                esc_html($category->name)
                                                            );
                                                        }
                                                    }
                                                    echo implode(', ', $category_links);
                                                    ?>
                                                </div>
                                            <?php endif; ?>

                                            <a href="<?php the_permalink(); ?>" class="hotel-tags"> 
                                            <p><?php echo custom_excerpt(30); ?></p>
                                            </a>
                                            <a href="<?php the_permalink(); ?>" class="hotel-info-button">Read Article </a>

                                           
                                        </div>




                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p><?php _e('Sorry, no posts matched your criteria.', 'textdomain'); ?></p>
                            <?php endif; ?>
                        </div>










                        <!-- Pagination -->
                        <div class="pagination">
                            <?php
                           custom_woocommerce_style_pagination();
                            ?>
                        </div>  
                    </div>
                </div>


        </div>

       
        <?php
        get_footer();
