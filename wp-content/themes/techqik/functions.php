<?php

add_theme_support('post-thumbnails');


/**
 * check if the techqik_enqueue_vue exists.
 */

if ( ! function_exists( 'techqik_enqueue_vue' ) ) {

    /**
     * add built vue js, css, images.
     */
    function techqik_enqueue_vue() {
        wp_enqueue_style('techqik-vue-css', get_template_directory_uri() . '/assets/index-6yuUNRKH.css');
        wp_enqueue_script('techqik-vue', get_template_directory_uri() . '/assets/index-13_B9SD1.js', array(), false, true);
        wp_localize_script('techqik-vue-js', 'MyThemeApiSettings', array('apiUrl' => rest_url('mytheme/v1')));
    }
    add_action('wp_enqueue_scripts', 'techqik_enqueue_vue');
} 


/**
 * check if the techqik_get_menu_by_location exists.
 */
if ( ! function_exists( 'techqik_get_menu_by_location' ) ) {
    
    /**
     * REST_API,retrieve menu from wordpress
     */
    function techqik_get_menu_by_location($data) {
        $locations = get_nav_menu_locations();
        if (!isset($locations[$data['location']])) {
            return new WP_Error('not_found', 'Menu location not found', array('status' => 404));
        }

        $menu = wp_get_nav_menu_items($locations[$data['location']]);
        return $menu ? $menu : new WP_Error('not_found', 'No menu items found', array('status' => 404));
    }

    add_action('rest_api_init', function () {
        register_rest_route('techqik/v1', '/menu/(?P<location>[a-zA-Z0-9_-]+)', array(
            'methods' => 'GET',
            'callback' => 'techqik_get_menu_by_location',
        ));
    });
}

/**
 * check if the function techqik_register_menus exists
 */
if ( ! function_exists( 'techqik_register_menus' ) ) {
    /**
     * reg the menu
     */
    function techqik_register_menus() {
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'techqik'),
            'mobile' => __('Mobile Menu', 'techqik'),
            'footer' => __('Footer Menu', 'techqik'),
            // 您可以根据需要注册更多的菜单位置
        ));
    }
    add_action('after_setup_theme', 'techqik_register_menus');
}