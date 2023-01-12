<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package API_LESS
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );


        ?>


            <div class="post-all">
                <?php
                    $post_same = get_posts(
                            array(
                                    'category__in' => wp_get_post_categories($post->ID),
                                    'numberposts' => 3, 'post__not_in' => array($post->ID),
                                    'order'    => 'DESC'
                            ));
                    if( $post_same ):
                        foreach( $post_same as $post ) : ?>
                            <div class="post-content-main">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                <span class="show-category-post"><b>Category: </b>  <?php the_category(); ?> </span>
                                <h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
                                <?php the_content(); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                   <?php wp_reset_postdata(); ?>
            </div>



                <?php
                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'api_less' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'api_less' ) . '</span> <span class="nav-title">%title</span>',
                    )
                );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>



	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
