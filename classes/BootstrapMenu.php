<?php

/**
 * Add bootstrap classes to individual menu list items
 */

function filter_bootstrap_nav_menu_css_class($classes, $item, $args)
{
    if (isset($args->bootstrap)) {
        $classes[] = 'nav-item';

        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }

        if (in_array('dropdown-header', $classes)) {
            unset($classes[array_search('dropdown-header', $classes)]);
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'filter_bootstrap_nav_menu_css_class', 10, 3);

/**
 * Add bootstrap attributes to individual link elements.
 */

function filter_bootstrap_nav_menu_link_attributes($atts, $item, $args, $depth)
{
    $atts["class"] = "nav-link";

    return $atts;
}

add_filter('nav_menu_link_attributes', 'filter_bootstrap_nav_menu_link_attributes', 10, 4);

/**
 * Add bootstrap classes to dropdown menus.
 */

function filter_bootstrap_nav_menu_submenu_css_class($classes, $args, $depth)
{
    if (isset($args->bootstrap)) {
        $classes[] = 'dropdown-menu';
    }
    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'filter_bootstrap_nav_menu_submenu_css_class', 10, 3);
