<?php get_header() ?>

<?php // wp_list_categories(['taxonomy' => 'sport', 'title_li' => '']); ?>

<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills">
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

<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-3">
                <div class="card">
                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']); ?>
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title() ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
                        <p class="card-text">
                            <?php the_content('En voir plus') ?>
                        </p>
                        <a href="<?php the_permalink() ?>" class="card-link">Voir l'article</a>
                    </div>
                </div>
            </div>
            <?php twentytwentyone_pagination() ?>
    </div>
<?php endwhile ?>
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>

<?php get_footer() ?>