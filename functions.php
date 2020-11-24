<?php
function twentytwentyone_supports () {
    add_theme_support('title-tag');
}

function twentytwentyone_register_assets (){
    wp_register_style('bootstap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery']);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js');
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js');
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}


add_action('after_setup_theme', 'twentytwentyone_supports');
add_theme_support('title-tag'); // permet d'indiquer ce que supporte le theme add_theme_support

add_action('wp_enqueue_scripts', 'twentytwentyone_register_assets');