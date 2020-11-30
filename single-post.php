<?php get_header() ?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <p>
            <img src="<?phpthe_post_thumbnail_url()?>" alt="" style="width:auto; height:100%;">
        </p>
        <?php the_post_thumbnail() ?>
        <?php the_content() ?>

        <h2>articles relatifs</h2>

        <div class="row">
            <?php
            $sport = array_map(function ($term) {
                return $term->term_id;
            }, get_the_terms(get_post(), 'sport'));
            $query = new WP_Query([
                'post__not_in' => [get_the_ID()],
                'post_type' => 'post',
                'post_per_page' => 3,
                'orderby' => 'rand',
                'tax_query' => [
                    [
                        'taxonomy' => 'sport',
                        'field' => 'slug',
                        'terms' => $sport,
                    ]
                ],
                'meta_query' => [ //DANS LE CADRE DE L EXEMPLE INCLUS UNIQUEMENT LES SPONSORISES
                    'key' => SponsoMetabox::META_KEY,
                    'compare' => 'EXISTS' //GRACE A EXISTS SUR LA METAKEY
                ]
            ]);
            while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-sm-4">
                    <?php get_template_part('parts/post'); ?>
                </div>
            <?php endwhile;
            wp_reset_postdata(); // A FAIRE ---IMPORTANT--- permet de reset les modifs et ne pas entrainer d effets boule de neige sur les indexations ?>

    <?php endwhile;
endif; ?>

    <?php get_footer() ?>