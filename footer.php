<?php wp_footer() ?>

</div>
<footer>
<?php wp_nav_menu([
              'theme_location' => 'footer',
              'container' => false,
              'menu_class' => 'navbar-nav mr-auto'
              ]) ?>
</footer>
<div>
    <?= get_option('agence_horaire')?>
</div>
</body>
</html>