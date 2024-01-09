<?php
add_action( 'after_setup_theme', 'theme_techqik_com_setup' );

function theme_techqik_com_setup() {
    error_log(get_stylesheet_uri());
    error_log(get_theme_file_uri( 'assets/css/primary.css' ));
    add_theme_support( 'wp-block-styles' );
}