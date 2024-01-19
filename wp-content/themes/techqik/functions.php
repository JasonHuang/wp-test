<?php
// add_action( 'after_setup_theme', 'theme_techqik_com_setup' );

// function theme_techqik_com_setup() {
//     add_theme_support( 'wp-block-styles' );
// }


// define( 'TECHQIK_THEME_DIR', trailingslashit( get_template_directory() ) );
// require_once TECHQIK_THEME_DIR . 'inc/core/common-functions.php';

/**
 * check if the techqik_enqueue_vue exists.
 */

if ( ! function_exists( 'techqik_enqueue_vue' ) ) {

    /**
     * add built vue js, css, images.
     */
    function techqik_enqueue_vue() {
        wp_enqueue_style('techqik-vue-css', get_template_directory_uri() . '/assets/index-MQEElBfH.css');
        wp_enqueue_script('techqik-vue-js', get_template_directory_uri() . '/assets/index-SXCcESYw.js', array(), false, true);
    }
    add_action('wp_enqueue_scripts', 'techqik_enqueue_vue');
}