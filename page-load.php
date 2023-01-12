<?php
    get_header();
?>

<section class="container">
    <div class="post-all">

        <?php
        global $post;
            $the_query = new WP_Query(
                array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'order' => 'ASC',

                    )); ?>

            <?php  while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

                    <div class="post-content-main">
                        <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
                        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(__('(more…)')); ?>
                    </div>
            <?php
            endwhile;
            wp_reset_postdata()

        ?>

    </div>


    <div class="text-center mb-3 post-list">
        <button id="load-more" class="btn btn-success" max_num_pages="<?=$the_query->max_num_pages ?>"> Load More Posts </button>
    </div>



</section>


<?php
    get_footer();
?>
