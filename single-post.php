<?php get_header() ?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <p>
            <img src="<?phpthe_post_thumbnail_url()?>" alt="" style="width:auto; height:100%;">
        </p>
        <?php the_post_thumbnail() ?>
        <?php the_content() ?>
<?php  endwhile; endif; ?>

<?php get_footer() ?>