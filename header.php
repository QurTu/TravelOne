<?php global $woocommerce; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <title><?php wp_title(''); ?></title>
    <link rel="shortcut icon" type="image/jpg" href="<?php echo get_template_directory_uri() . "/assets/images/favicon.ico"  ?>" />
   
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
   
    <?php wp_head(); ?>

    
    <?php $headerNavBar  =  wp_get_menu_array('Header Nav Menu');   ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <div class="header-logo">
            <a href="/">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/logo.jpg"  ?>" alt="">

            </a>
        </div>
        <div class="header-nav-menu">
            <?php
            $current_url = home_url($_SERVER['REQUEST_URI']);
            foreach ($headerNavBar as $item) {
            ?>
                <div class="nav-eliment-dropdown">
                    <a href="<?php echo $item['url'] ?>" class="nav-eliment">
                        <p class="<?php if ($item['url'] == $current_url) echo 'nav-menu-p-active' ?>"> <?php echo $item['title'] ?></p>
                    </a>

                    <?php
                    if (!empty($item['children'])) {
                    ?>
                        <div class="nav-dropdown">
                            <?php
                            foreach ($item['children'] as $child) {
                            ?>
                                <div class="nav-eliment-dropdown second-level">
                                    <a href="<?php echo $child['url'] ?>" class="dropdown-item"> <?php echo $child['title'] ?></a>
                                    <?php
                                    if (!empty($child['children'])) {
                                    ?>
                                        <div class="nav-dropdown second-level-dropdown">
                                            <?php
                                            foreach ($child['children'] as $childLevel) {
                                            ?>
                                                <a href="<?php echo $childLevel['url'] ?>" class="dropdown-item"> <?php echo $childLevel['title'] ?></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                <?php
                    }
                    echo '</div>';
                }
                ?>
                </div>

                <div class="header-buttons">
                    <div class="header-hamburger">
                        <?php echo file_get_contents(get_template_directory() . '/assets/icons/hamburger.svg'); ?>
                    </div>
                </div>

                <!-- toggle  bar-->
                <div class="navbar-toggle">
                    <div class="toggle-menu">
                        <div class="toggle-background">
                            <div class="toggle-header">
                                <div></div>
                                <button class="toggle-close">
                                    <?php echo file_get_contents(get_template_directory() . '/assets/icons/x.svg'); ?>
                                </button>

                            </div>

                            <div class="toggle-menu-main-nav">
                                <?php
                                $current_url = home_url($_SERVER['REQUEST_URI']);
                                foreach ($headerNavBar as $item) {
                                ?>
                                    <div class="toggle-main-main-nav-item">
                                        <div class="toggle-main-main-nav-item-self">
                                            <a href="<?php echo $item['url'] ?>">
                                                <p class="<?php if ($item['url'] == $current_url) echo 'nav-menu-p-active' ?>"><?php echo $item['title'] ?></p>
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

                                                        if (!empty($child['children'])) {

                                                    ?>
                                                            <div class="toggle-main-main-nav-item-self">


                                                                <a href="<?php echo $child['url'] ?>"> <?php echo $child['title'] ?></a>

                                                                <?php
                                                                echo file_get_contents(get_template_directory() . '/assets/icons/arrow-down.svg');
                                                                ?>

                                                            </div>

                                                            <div class="toggle-dropdown second-level">
                                                                <?php
                                                                foreach ($child['children'] as $childLevel) {
                                                                ?>
                                                                    <a href="<?php echo $childLevel['url'] ?>" class="dropdown-item"> <?php echo $childLevel['title'] ?></a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>


                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?php echo $child['url'] ?>"> <?php echo $child['title'] ?></a>
                                            <?php
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                                echo ' </div>';
                                            }
                                            ?>
                                                </div>


                                        </div>
                                    </div>
                            </div>
                        </div>
    </header>