<?php

class SponsoMetabox
{
const META_KEY = 'twentytwentyone_sponso';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render'], 'post', 'side');
    }
    public static function render($post){
        $value = get_post_meta($post->ID, self::META_KEY, true);
        ?>
        <input type="hidden" value="0" name="<?= self::META_KEY ?>">
         <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?= $value === '1' ? 'checked' : ''?>> <!-- A la place de $value === '1' ? 'checked' : ''?>  POSSIBILITE D UTILISER LA FONCTION: checked()-->
        <label for="twentytwentyonesponso">Cet article à été ou sera sponsorisé !</label>
       
        <?php
    }
    public static function save($post){
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can('edit_post', $post /*si il peut ajouter un article il peut cocher que l'article est sponsorisé    https://wordpress.org/support/article/roles-and-capabilities/   */)) {
            //var_dump($_POST);
            // die();
            if ($_POST[self::META_KEY] === '0') {
                delete_post_meta($post, self::META_KEY);
            } else {
                update_post_meta($post, self::META_KEY, 1);
            }
        }
    }
}
