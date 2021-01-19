<?php
/**
 * online_mart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package online_mart
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.1' );
}

if ( ! function_exists( 'online_mart_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function online_mart_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on online_mart, use a find and replace
		 * to change 'online_mart' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'online_mart', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'online_mart' ),
			)
		);

		add_filter('nav_menu_link_attributes','clase_menu_enlace', 10,3);
		  function clase_menu_enlace ($atts, $item, $args){
		  	$class = 'nav-link';
		  	$atts['class'] = $class;
		  	return $atts;
          }
          

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
				'online_mart_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'online_mart_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_mart_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'online_mart_content_width', 640 );
}
add_action( 'after_setup_theme', 'online_mart_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function online_mart_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'online_mart' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'online_mart' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'online_mart_widgets_init' );

/**
 *  Extra  Widgets
 */

if (! function_exists('online_mart_widgets')) {
    add_action('widgets_init', 'online_mart_widgets');

    function online_mart_widgets()
    {

        // Menu Sidebar
        register_sidebar(
            array(
                'name'          => __('Menu Sidebar', 'online_mart'),
                'id'            => 'menu-sidebar',
                'description'   => __('The widgets added in this sidebar will appear on index.', 'online_mart'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="widget-title"><h5>',
                'after_title'   => '</h5></div>',
            )
        );

        // Content Sidebar
        register_sidebar(
            array(
                'name'          => __('Content Sidebar', 'online_mart'),
                'id'            => 'content-sidebar',
                'description'   => __('The widgets added in this sidebar will appear in footer section from front page.', 'online_mart'),
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="widget-title"><h5>',
                'after_title'   => '</h5></div>',
            )
        );

        // Page Sidebar
        register_sidebar(
            array(
                'name'          => __('Page Sidebar', 'online_mart'),
                'id'            => 'page-sidebar',
                'description'   => __('The widgets added in this sidebar will appear in page section from front page.', 'online_mart'),
                'before_widget' => '<div id="%1$s" class="mb-4 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_h4">',
                'after_title'   => '</h4>',
            )
        );
        // Single sidebar
        register_sidebar(
            array(
                'name'          => __('Single sidebar', 'online_mart'),
                'id'            => 'single-sidebar',
                'description'   => __('The widgets added in this sidebar will appear in page section from front page.', 'online_mart'),
                'before_widget' => '<div id="%1$s" class="mb-4 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_h4">',
                'after_title'   => '</h4>',
            )
        );
    }
}

    /**
     * Enqueue scripts and styles.
     */
    function online_mart_scripts()
    {
        wp_enqueue_style('online_mart-bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css', );

        wp_enqueue_style('online_mart-style', get_stylesheet_uri(), array(), _S_VERSION);
        wp_style_add_data('online_mart-style', 'rtl', 'replace');

        wp_enqueue_style('online_mart-style2', get_template_directory_uri() . '/css/style2.css', );

        wp_enqueue_style('online_mart-animate', get_template_directory_uri() . '/css/animate.min.css', );

        wp_enqueue_style('online_mart-fa', get_template_directory_uri() . '/fa/css/all.css', );

        wp_enqueue_script('online_mart-bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20151215', true);
    
        wp_enqueue_script('online_mart-wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '20161004', true);

        wp_enqueue_script('online_mart-navigation', get_template_directory_uri() . '/js/modal.js', array('jquery'), _S_VERSION, true);

        wp_enqueue_script('online_mart-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'online_mart_scripts');

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
    if (defined('JETPACK__VERSION')) {
        require get_template_directory() . '/inc/jetpack.php';
    }

    /**
     * Load WooCommerce compatibility file.
     */
    if (class_exists('WooCommerce')) {
        require get_template_directory() . '/inc/woocommerce.php';
    }


    function sanitize_text($text)
    {
        $allowed_html = array("a" => array( "href" => array(), "title" => array(), "target" => array(),"class" => array(), "id" => array() ), "span" => array( "class" => array(), "id" => array() ), "br" => array(), "em" => array(), "strong" => array(),);
        return wp_kses($text, $allowed_html);
    }
    /**
     * Section Title
     */
    add_action("customize_register", "themesgenchild_register_theme_customizer");
    
    function themesgenchild_register_theme_customizer($wp_customize)
    {
        $wp_customize->add_panel("panel_A", array(	"priority" => 65, "theme_supports" => "", "title" => __("Section 1", "online_mart"), "description" => __("texto editable para cierto contenido.", "online_mart"),));

        //section background
        $wp_customize->add_section("customtgback-1", array("title" => __("Change Background section", "online_mart"),	"panel"    => "panel_A","priority" => 18));
        $wp_customize->add_setting("tgback-1", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri().""));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "customtgback-1", array( "label"    => __("Image 1", "online_mart"), "section"  => "customtgback-1", "settings" => "tgback-1" )));
        $wp_customize->selective_refresh->add_partial("tgback-1", array("selector" => "#tgback-1",));

        //section1 texts
        $wp_customize->add_section("Section 1", array("title" => __("Change texts section", "online_mart"),	"panel"    => "panel_A","priority" => 19));

        ##title s1
        $wp_customize->add_setting("tgtext-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtgtext-1", array( "label"    => __("Title section", "online_mart"), "section"  => "Section 1", "settings" => "tgtext-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tgtext-1", array("selector" => "#tgtext-1",));
        ##subtitle s1
        $wp_customize->add_setting("tgtext-2", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtgtext-2", array( "label"    => __("Subtitle section", "online_mart"), "section"  => "Section 1", "settings" => "tgtext-2", "type"     => "textarea" )));
        $wp_customize->selective_refresh->add_partial("tgtext-2", array("selector" => "#tgtext-2",));
        ##button s1
        $wp_customize->add_setting("tgtext-3", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtgtext-3", array( "label"    => __("Button section", "online_mart"), "section"  => "Section 1", "settings" => "tgtext-3", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tgtext-3", array("selector" => "#tgtext-3",));

        //section1 links
        $wp_customize->add_section("customtglink-a", array("title" => __("Change Links section", "online_mart"),	"panel"    => "panel_A","priority" => 20));

        ##link s1
        $wp_customize->add_setting("tglink-a", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-a", array( "label"    => __("Button Link", "online_mart"), "section"  => "customtglink-a", "settings" => "tglink-a", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-a", array("selector" => "#tglink-a",));
    }

    /**
     * Section Categories
     */
    add_action("customize_register", "themegenchild_register_theme_customizer2");
    
    function themegenchild_register_theme_customizer2($wp_customize)
    {
        $wp_customize->add_panel("panel_B", array("priority" => 66, "theme_supports" => "","title" => __("Section 2", "online_mart"), "description" => __("Set information.", "online_mart"), ));
    
        ##Category 1
        $wp_customize->add_section("Category 1", array("title" => __("Change category 1", "online_mart"),	"panel"    => "panel_B","priority" => 20));
    
        $wp_customize->add_setting("tgimg-1", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-1", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 1", "settings" => "tgimg-1" )));
        $wp_customize->selective_refresh->add_partial("tgimg-1", array("selector" => "#tgimg-1",));
        
        $wp_customize->add_setting("categ-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-1", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 1", "settings" => "categ-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-1", array("selector" => "#categ-1",));

        $wp_customize->add_setting("categ-1s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-1s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 1", "settings" => "categ-1s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-1s", array("selector" => "#categ-1s",));

        $wp_customize->add_setting("tglink-1", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-1", array( "label"    => __("Link", "online_mart"), "section"  => "Category 1", "settings" => "tglink-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-1", array("selector" => "#tglink-1",));

        ##Category 2
        $wp_customize->add_section("Category 2", array("title" => __("Change category 2", "online_mart"),	"panel"    => "panel_B","priority" => 21));

        $wp_customize->add_setting("tgimg-2", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-2", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 2", "settings" => "tgimg-2" )));
        $wp_customize->selective_refresh->add_partial("tgimg-2", array("selector" => "#tgimg-2",));

        $wp_customize->add_setting("categ-2", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-2", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 2", "settings" => "categ-2", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-2", array("selector" => "#categ-2",));

        $wp_customize->add_setting("categ-2s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-2s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 2", "settings" => "categ-2s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-2s", array("selector" => "#categ-2s",));

        $wp_customize->add_setting("tglink-2", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-2", array( "label"    => __("Link", "online_mart"), "section"  => "Category 2", "settings" => "tglink-2", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-2", array("selector" => "#tglink-2",));

        ##Category 3
        $wp_customize->add_section("Category 3", array("title" => __("Change category 3", "online_mart"),	"panel"    => "panel_B","priority" => 21));

        $wp_customize->add_setting("tgimg-3", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-3", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 3", "settings" => "tgimg-3" )));
        $wp_customize->selective_refresh->add_partial("tgimg-3", array("selector" => "#tgimg-3",));

        $wp_customize->add_setting("categ-3", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-3", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 3", "settings" => "categ-3", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-3", array("selector" => "#categ-3",));

        $wp_customize->add_setting("categ-3s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-3s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 3", "settings" => "categ-3s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-3s", array("selector" => "#categ-3s",));

        $wp_customize->add_setting("tglink-3", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-3", array( "label"    => __("Link", "online_mart"), "section"  => "Category 3", "settings" => "tglink-3", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-3", array("selector" => "#tglink-3",));

        ##Category 4
        $wp_customize->add_section("Category 4", array("title" => __("Change category 4", "online_mart"),	"panel"    => "panel_B","priority" => 23));

        $wp_customize->add_setting("tgimg-4", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-4", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 4", "settings" => "tgimg-4" )));
        $wp_customize->selective_refresh->add_partial("tgimg-4", array("selector" => "#tgimg-4",));

        $wp_customize->add_setting("categ-4", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-4", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 4", "settings" => "categ-4", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-4", array("selector" => "#categ-4",));

        $wp_customize->add_setting("categ-4s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-4s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 4", "settings" => "categ-4s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-4s", array("selector" => "#categ-4s",));

        $wp_customize->add_setting("tglink-4", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-4", array( "label"    => __("Link", "online_mart"), "section"  => "Category 4", "settings" => "tglink-4", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-4", array("selector" => "#tglink-4",));

        ##Category 5
        $wp_customize->add_section("Category 5", array("title" => __("Change category 5", "online_mart"),	"panel"    => "panel_B","priority" => 23));

        $wp_customize->add_setting("tgimg-5", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-5", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 5", "settings" => "tgimg-5" )));
        $wp_customize->selective_refresh->add_partial("tgimg-5", array("selector" => "#tgimg-5",));

        $wp_customize->add_setting("categ-5", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-5", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 5", "settings" => "categ-5", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-5", array("selector" => "#categ-5",));

        $wp_customize->add_setting("categ-5s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-5s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 5", "settings" => "categ-5s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-5s", array("selector" => "#categ-5s",));

        $wp_customize->add_setting("tglink-5", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-5", array( "label"    => __("Link", "online_mart"), "section"  => "Category 5", "settings" => "tglink-5", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-5", array("selector" => "#tglink-5",));

        ##Category 6
        $wp_customize->add_section("Category 6", array("title" => __("Change category 6", "online_mart"),	"panel"    => "panel_B","priority" => 23));

        $wp_customize->add_setting("tgimg-6", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri()."/img/200x200.png"));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "img-6", array( "label"    => __("Image 1", "online_mart"), "section"  => "Category 6", "settings" => "tgimg-6" )));
        $wp_customize->selective_refresh->add_partial("tgimg-6", array("selector" => "#tgimg-6",));

        $wp_customize->add_setting("categ-6", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-6", array( "label"    => __("Title Category", "online_mart"), "section"  => "Category 6", "settings" => "categ-6", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-6", array("selector" => "#categ-6",));

        $wp_customize->add_setting("categ-6s", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customcateg-6s", array( "label"    => __("Subtitle Category", "online_mart"), "section"  => "Category 6", "settings" => "categ-6s", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("categ-6s", array("selector" => "#categ-6s",));

        $wp_customize->add_setting("tglink-6", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customtglink-6", array( "label"    => __("Link", "online_mart"), "section"  => "Category 6", "settings" => "tglink-6", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("tglink-6", array("selector" => "#tglink-6",));
    }

    /**
     * Section products
     */
    add_action("customize_register", "themegenchild_register_theme_customizer_pc1");
    function themegenchild_register_theme_customizer_pc1($wp_customize)
    {
        $wp_customize->add_panel("panel_C", array("priority" => 69, "theme_supports" => "","title" => __("Section 3", "online_mart"), "description" => __("Set page content block page.", "online_mart"), ));

        $wp_customize->add_section("Content", array("title" => __("Page Content", "online_mart"),"priority" => 20,"capability"  => "edit_theme_options","description" => __("Set the page content block", "online_mart"),));

        $wp_customize->add_setting("page_A", array("sanitize_callback" => "esc_attr", "default" => "default","type" => "theme_mod", "capability" => "edit_theme_options",));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "content_page_A", array("label" => __("Page to show", "online_mart"), "section" => "Content", "settings" => "page_A", "priority" => 10,  "type" => "dropdown-pages")));
        $wp_customize->selective_refresh->add_partial("page_A", array( "selector" => "#page_A"));
    }

    /**
     * Section footer
     */

    add_action("customize_register", "footer_customizer");
    
    function footer_customizer($wp_customize)
    {
        $wp_customize->add_panel("panel_D", array("priority" => 68, "theme_supports" => "","title" => __("footer", "online_mart"), "description" => __("Set information.", "online_mart"), ));
    
        ##footer
        $wp_customize->add_section("footer", array("title" => __("Change footer info", "online_mart"),	"panel"    => "panel_D","priority" => 20));
    
        $wp_customize->add_setting("foot-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customfoot-1", array( "label"    => __("Title contact", "online_mart"), "section"  => "footer", "settings" => "foot-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("foot-1", array("selector" => "#foot-1",));

        $wp_customize->add_setting("footLinkTitle", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "footLinkTitle", array( "label"    => __("Link Title", "online_mart"), "section"  => "footer", "settings" => "footLinkTitle", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("footLinkTitle", array("selector" => "#footLinkTitle",));

        $wp_customize->add_setting("foot-2", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customfoot-2", array( "label"    => __("Address", "online_mart"), "section"  => "footer", "settings" => "foot-2", "type"     => "textarea" )));
        $wp_customize->selective_refresh->add_partial("foot-2", array("selector" => "#foot-2",));

        $wp_customize->add_setting("footLink", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "footLink", array( "label"    => __("Link address", "online_mart"), "section"  => "footer", "settings" => "footLink", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("footLink", array("selector" => "#footLink",));

        $wp_customize->add_setting("foot-3", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customfoot-3", array( "label"    => __("Phone", "online_mart"), "section"  => "footer", "settings" => "foot-3", "type"     => "textwrap" )));
        $wp_customize->selective_refresh->add_partial("foot-3", array("selector" => "#foot-3",));
    }

    /**
     * Section about
     */
    add_action("customize_register", "about_customizer");
    
    function about_customizer($wp_customize)
    {
        $wp_customize->add_panel("panel_E", array("priority" => 67, "theme_supports" => "","title" => __("About", "online_mart"), "description" => __("Set information.", "online_mart"), ));
        
        $wp_customize->add_section("About", array("title" => __("Change about us info", "online_mart"),	"panel"    => "panel_E","priority" => 20));

        $wp_customize->add_setting("about-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customabout-1", array( "label"    => __("Title about", "online_mart"), "section"  => "About", "settings" => "about-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("about-1", array("selector" => "#about-1",));

        $wp_customize->add_setting("about-2", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customabout-2", array( "label"    => __("Content about", "online_mart"), "section"  => "About", "settings" => "about-2", "type"     => "textarea" )));
        $wp_customize->selective_refresh->add_partial("about-2", array("selector" => "#about-2",));

        $wp_customize->add_setting("about-3", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customabout-3", array( "label"    => __("Button about", "online_mart"), "section"  => "About", "settings" => "about-3", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("about-3", array("selector" => "#about-3",));

        $wp_customize->add_setting("about-btn", array( "sanitize_callback" => "esc_attr", "default" => "https://github.com/AbelardoR"));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "about-btn", array( "label"    => __("Link address", "online_mart"), "section"  => "About", "settings" => "about-btn", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("about-btn", array("selector" => "#about-btn",));

        $wp_customize->add_setting("aboutback-1", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri().""));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "customaboutback-1", array( "label"    => __("About Image", "online_mart"), "section"  => "About", "settings" => "aboutback-1" )));
        $wp_customize->selective_refresh->add_partial("aboutback-1", array("selector" => "#aboutback-1",));
    }

    
    /**
     * Section separator
     */
    add_action("customize_register", "separator_customizer");
    
    function separator_customizer($wp_customize)
    {
        $wp_customize->add_panel("panel_F", array("priority" => 73, "theme_supports" => "","title" => __("Separator", "online_mart"), "description" => __("Set information.", "online_mart"), ));
        
        $wp_customize->add_section("Separator", array("title" => __("Change about us info", "online_mart"),	"panel"    => "panel_F","priority" => 20));

        $wp_customize->add_setting("septxt-1", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customsep-1", array( "label"    => __("Title septxt", "online_mart"), "section"  => "Separator", "settings" => "septxt-1", "type"     => "text" )));
        $wp_customize->selective_refresh->add_partial("septxt-1", array("selector" => "#septxt-1",));

        $wp_customize->add_setting("septxt-2", array( "default" => __("Insert your text here", "online_mart"), "sanitize_callback" => "sanitize_text"	));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "customsep-2", array( "label"    => __("Title septxt", "online_mart"), "section"  => "Separator", "settings" => "septxt-2", "type"     => "textarea" )));
        $wp_customize->selective_refresh->add_partial("septxt-2", array("selector" => "#septxt-2",));

        $wp_customize->add_setting("sepback-1", array( "sanitize_callback" => "esc_attr", "default" => "".get_template_directory_uri().""));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "customsepback-1", array( "label"    => __("Separator Image", "online_mart"), "section"  => "Separator", "settings" => "sepback-1" )));
        $wp_customize->selective_refresh->add_partial("sepback-1", array("selector" => "#sepback-1",));
    }
