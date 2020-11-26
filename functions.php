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

// METABOX

function twentytwentyone_add_custom_box (){
    add_meta_box('twentytwentyone_sponso', 'Sponsoring', 'twentytwentyone_render_sponso_box', 'post', 'side' );
}

function twentytwentyone_render_sponso_box (){
    ?>
    <input type="hidden" value="0" name="twentytwentyone_sponso">
     <input type="checkbox" value="1" name="twentytwentyone_sponso">
    <label for="twentytwentyonesponso">Cet article à été ou sera sponsorisé !</label>
   
    <?php
// echo 'futur ou passé du sponso';
}

function twentytwentyone_save_sponso ($post_id /*DANS LE POST QUE NOUS SAUVEGARDONS*/){
   if (array_key_exists('twentytwentyone_sponso', $_POST)){
       //var_dump($_POST);
      // die();
      if($_POST['twentytwentyone_sponso'] === '0'){
        delete_post_meta($post_id, 'twentytwentyone_sponso');
      } else {
        update_post_meta($post_id, 'twentytwentyone_sponso', 1);
      }

   }
}


add_action('add_meta_boxes', 'twentytwentyone_add_custom_box');
add_action('save_post', 'twentytwentyone_save_sponso');