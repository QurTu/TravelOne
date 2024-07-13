<?php
// 3 levels menu
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
