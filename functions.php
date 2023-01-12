<?php
/**
 * API_LESS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package API_LESS
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function api_less_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on API_LESS, use a find and replace
		* to change 'api_less' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'api_less', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'api_less' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'api_less_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'api_less_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function api_less_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'api_less_content_width', 640 );
}
add_action( 'after_setup_theme', 'api_less_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function api_less_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'api_less' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'api_less' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'api_less_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function api_less_scripts() {
	wp_enqueue_style( 'api_less-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'api_less-style', 'rtl', 'replace' );

	wp_enqueue_script( 'api_less-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

//    my style
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/main-style.css', '1.1', 'all');

//    my javascript
    wp_enqueue_script('javascript', get_template_directory_uri() . '/js/main-request.js', array(), '1.1', true);

    wp_localize_script('javascript', 'magicalData', array(
        'nonce' => wp_create_nonce('wp_rest'),
        'siteURL' => get_site_url()
    ));

//   bootstrap style and script ------------
    wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' );

}
add_action( 'wp_enqueue_scripts', 'api_less_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



function load_scripts() {
    global $wp_query;
    wp_enqueue_script( 'load-custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true );


//    localize the script with new data

    $date_array = array(
         'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 2,
        'security'  =>  wp_create_nonce('load_more_posts'),
        'max_page' => $wp_query->max_num_pages
    );
    wp_localize_script('load-custom-script', 'load', $date_array);

    wp_enqueue_script( 'load-custom-script' );


}
add_action( 'wp_enqueue_scripts', 'load_scripts' );




function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');

    $args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 3,
        'order'             => 'ASC',
        'paged'             =>  $_POST['paged'],
    );
    $blog_posts = new WP_Query( $args );

    $response = '';
    $max_pages = $blog_posts->max_num_pages;

    ?>
    <?php if ($blog_posts ->have_posts()) : ?>

        <?php while ($blog_posts -> have_posts() ) : $blog_posts -> the_post() ; ?>
            <div class="post-content-main">
                <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
                <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(__('(more…)')); ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>

    <?php
    wp_die();
}

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');






