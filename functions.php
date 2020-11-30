<?php
function twentytwentyone_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');

    add_image_size('post_thumbmail', 225, 350, true); // attention Wordpress ne fait pas de levelup of size image
  //  remove_image_size('medium');
  //  add_image_size('medium', 500, 750);
}
function wpbootstrap_styles_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), 1, true);
    wp_enqueue_script('boostrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery', 'popper'), 1, true);
}
add_action('wp_enqueue_scripts', 'wpbootstrap_styles_scripts');

/*
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
*/

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

// add_action('wp_enqueue_scripts', 'twentytwentyone_register_assets');

/*
function twentytwentyone_menu_class($classes)
{
    //var_dump(func_get_args());
    // die();
    $classes[] = 'nav-item';
    return $classes;
}
function twentytwentyone_menu_link_class($attrs)
{
    //var_dump(func_get_args());
    // die();
    $attrs['class'] = 'nav-link';
    return $attrs;
}
*/
add_filter('document_title_separator', 'twentytwentyone_title_separator');
add_filter('document_title_parts', 'twentytwentyone_document_title_parts');

/*
add_filter('nav_menu_css_class', 'twentytwentyone_menu_class');
add_filter('nav_menu_link_attributes', 'twentytwentyone_menu_link_class');

*/


function twentytwentyone_pagination(){
    $pages = paginate_links(['type' => 'array']);
    
    if ($pages === null){ // SI PAS ASSEZ D ARTICLE POUR PAS D ERREUR
        return; 
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">'; // LIENS PAGINES SOUS FORME DE TABLEAU
    
    //  var_dump($pages);
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false; // SI WP A MIS LA CLASS COURANTE PAR DEFAUT RESTE A GENERER LE HTML EN FONCTION DE CE QUE JE VEUX

        //ECRIRE HTML AU PLUS PROCHE DE WP POUR EVITER DE TRAVAIL PAS FORCEMENT UTILE

        // echo $page;
        $class = 'page-item';
        if ($active) {
            $class .= 'active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-number', 'page-link', $page);
        // var_dump($pages);
        // echo $pages;
        echo "</li>";
    };
    echo "</ul>";;
    echo '</nav>';
}

function twentytwentyone_init(){
    register_taxonomy('sport', 'post', [
        'labels' => [ //CHANGER LES LIBELLER DANS L INTERFACE ADMIN
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true,  // INCLURE LE PANNEAU DE TAXONOMY DANS L INTERFACE ADMIN
        'hierarchical' =>true, // METTRE EN CHECKBOX
        'show_admin_column' =>true, //DANS L ADMIN DE L ARTICLE
    ]);
    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'has_archive' => true, // ATTENTION RESAUVEGARDER LES PERMALIENS
    ]);
}


add_action('init', 'twentytwentyone_init');


// METABOX DANS UNE METHODE
require_once('metaboxes/sponso.php');
require_once('options/agence.php');

SponsoMetabox::register();
AgenceMenuPage::register();

add_filter('manage_bien_posts_columns', function($columns){
    return[
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date'],

    ];
});

add_filter('manage_bien_post_custom_column', function($column, $postId){
    if ($column === 'thumbnail'){
        the_post_thumbnail('thumbnail', $postId);
    }
    //var_dump(func_get_args());
}, 10, 2);

add_action('admin_enque_scripts', function(){
wp_enqueue_style('admin_twentytwentyone', get_template_directory_uri() . '/assets/admin.css');
});