<?php
get_header();
?>
<?php $headerNavBar  =  wp_get_menu_array('Side Bar Hotels');   ?>

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
                                    $stars = get_field('stars');
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
                                                    <div class="hotel-stars">
                                                        <?php for ($i = 0; $i < $stars; $i++) : ?>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="star-icon">
                                                                <path d="M23.555 8.729a1.505 1.505 0 0 0-1.406-.98h-6.087a.5.5 0 0 1-.472-.334l-2.185-6.193a1.5 1.5 0 0 0-2.81 0l-.005.016-2.18 6.177a.5.5 0 0 1-.471.334H1.85A1.5 1.5 0 0 0 .887 10.4l5.184 4.3a.5.5 0 0 1 .155.543l-2.178 6.531a1.5 1.5 0 0 0 2.31 1.684l5.346-3.92a.5.5 0 0 1 .591 0l5.344 3.919a1.5 1.5 0 0 0 2.312-1.683l-2.178-6.535a.5.5 0 0 1 .155-.543l5.194-4.306a1.5 1.5 0 0 0 .433-1.661"></path>
                                                            </svg>
                                                        <?php endfor; ?>
                                                    </div>
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

                                            <a href="<?php the_permalink(); ?>" class="hotel-tags"> <?php
                                                if ($perks) :
                                                    foreach ($perks as $perk) : ?>
                                                        <span> <?php echo $perk; ?></span>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </a>
                                            <a href="<?php the_permalink(); ?>" class="hotel-info-button">Details </a>

                                            <a href="<?php the_permalink(); ?>" class="hotel-raitings">
                                                <div class="rating-wrapper">
                                                    <div class="hotel-raiting-value"><?php echo get_field('rating') ?></div>
                                                    <div class="hotel-rating-text">raiting</div>
                                                </div>


                                            </a>
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
                            // If you're using a plugin like WP PageNavi, you can use it here
                            if (function_exists('wp_pagenavi')) {
                                wp_pagenavi();
                            } else {
                                // Default WordPress pagination
                                the_posts_pagination(array(
                                    'mid_size'  => 2,
                                    'prev_text' => __('« Previous', 'textdomain'),
                                    'next_text' => __('Next »', 'textdomain'),
                                ));
                            }
                            ?>
                        </div>
                        test
                    </div>
                </div>


        </div>

       
        <?php
        get_footer();
