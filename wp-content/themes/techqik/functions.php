<?php
// add_action( 'after_setup_theme', 'theme_techqik_com_setup' );

// function theme_techqik_com_setup() {
//     add_theme_support( 'wp-block-styles' );
// }


define( 'TECHQIK_THEME_DIR', trailingslashit( get_template_directory() ) );
require_once TECHQIK_THEME_DIR . 'inc/core/common-functions.php';
