<?php

get_header();

?>

<section class="container">
    <div class="post-all">

        <?php
            $the_query = new WP_Query( 'posts_per_page=6' ); ?>
        <?php
            while ($the_query -> have_posts()) : $the_query -> the_post();
        ?>
                <div class="post-content-main">
                    <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(__('(more…)')); ?>
                </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>

    <div class="API-btn">
        <button id="btn-post" class="btn btn-info"> Show Post For API </button>
    </div>

    <section class="container">
        <div class="post-all">
            <div id="post-continue-for-API">

            </div>
        </div>
    </section>

</section>

<?php get_footer(); ?>