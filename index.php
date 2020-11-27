<?php get_header() ?>


<?php // wp_list_categories(['taxonomy' => 'sport', 'title_li' => '']); ?>

<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills  my-4">
    <?php foreach ($sports as $sport) : ?>
        <li class="nav-item">           
        <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>         
        </li>
    <?php endforeach; ?>
</ul>

<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->
<!-- ATTENTION REDIRECTION HOME ET INDEX -->

<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <?php require_once('parts/post.php');?>
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