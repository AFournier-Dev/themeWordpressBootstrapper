<?php
class AgenceMenuPage
{

    const GROUP = 'agence_options';

    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
    }
    public static function registerSettings()
    {
        register_setting(self::GROUP, 'agence_horaire', ['default' => 'Année']);
       // get_option('agence_horaire');
    }

    public static function addMenu()
    {
        add_options_page("Gestion de l'agence", "Agence", "manage_options", self::GROUP, [self::class, 'render']);
    }

    public static function render(){
?>
        <!-- <h2>Gestion de l'agence</h2> -->

        <?=get_option('agence_horaire')?>

        <form action="option.php" method="post">
            <?php settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button();
            ?>
        </form>
<?php
    }
}
