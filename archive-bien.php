<?php get_header() ?>


<?php // wp_list_categories(['taxonomy' => 'sport', 'title_li' => '']); ?>

<h1>Voir tous nos biens</h1>

<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->

<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <?php get_template_part('parts/post');?>
            </div>
        <?php endwhile ?>
    </div>
    <?php twentytwentyone_pagination() ?>

    <?= previous_post_link(); ?>
    <?= next_post_link();  ?>

<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>

<?php get_footer() ?>