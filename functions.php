<?php
function twentytwentyone_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');

}

function twentytwentyone_register_assets()
{
    wp_register_style('bootstap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery'); // attention si plugin ou widget de wordpress ont besoin de cette version de Jquery alors disfonctionnement
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function twentytwentyone_title_separator()
{
    return '|';
}

function twentytwentyone_document_title_parts($title)
{
   
    unset($title['tagline']);
    $title['demo'] = 'Bonjour le futur qui deviendra le passé';
    return $title;
}

add_action('after_setup_theme', 'twentytwentyone_supports');
// add_theme_support('title-tag'); // permet d'indiquer ce que supporte le theme add_theme_support

add_action('wp_enqueue_scripts', 'twentytwentyone_register_assets');
add_filter('document_title_separator', 'twentytwentyone_title_separator');
add_filter('document_title_parts', 'twentytwentyone_document_title_parts');
