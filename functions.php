<?php
/**
 * Kale functions and definitions
 *
 * @package kale
 */
?>
<?php

/*------------------------------
 Customizer
 ------------------------------*/
 
if ( ! class_exists( 'Kirki' ) ) {
    include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
}
require get_template_directory() . '/customize/theme-defaults.php';
require get_template_directory() . '/customize/kirki-config.php';
require get_template_directory() . '/customize/customizer.php';

function kale_customize_register( $wp_customize ) {
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->get_section('colors')->title = __( 'Custom Colors', 'kale' );
    $wp_customize->get_section('colors')->priority = 75;
}
add_action( 'customize_register', 'kale_customize_register' );

if(is_admin())  add_action( 'customize_controls_enqueue_scripts', 'kale_custom_customize_enqueue' );
function kale_custom_customize_enqueue() {
    wp_enqueue_style( 'kale-customizer', get_template_directory_uri() . '/customize/style.css' );
}

/*------------------------------
 Setup
 ------------------------------*/

function kale_setup() {
    
    global $kale_defaults;
    
    load_theme_textdomain( 'kale', get_template_directory() . '/languages' ); 
    
    register_nav_menus( array('header' => __( 'Main Menu', 'kale' )) );
    
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array('height' => 150, 'width' => 300,'flex-height' => true,'flex-width'  => true ) );
    add_theme_support( 'custom-background');
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    $args = array(
        'flex-width'    => true,
        'width'         => 1200,
        'flex-height'    => true,
        'height'        => 550,
        'default-image' => $kale_defaults['kale_custom_header'],
    );
    add_theme_support( 'custom-header', $args );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 760, 400, true );
    add_image_size( 'kale-slider', 1200, 550, true );
    add_image_size( 'kale-thumbnail', 760, 400, true );

    add_post_type_support('page', 'excerpt');
}
add_action( 'after_setup_theme', 'kale_setup' );

/*------------------------------
 Styles and Scripts
 ------------------------------*/

function kale_scripts() {
    
    /* Styles */
    
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_register_style('bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css' );
    wp_register_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css' );
    wp_register_style('owl-carousel', get_template_directory_uri().'/assets/css/owl.carousel.css' );

    //fonts
    wp_register_style('kale-googlefont1', '//fonts.googleapis.com/css?family=Montserrat:400,700'); #headings
    wp_register_style('kale-googlefont2', '//fonts.googleapis.com/css?family=Lato:400,700,300,300italic,400italic,700italic'); #body
    wp_register_style('kale-googlefont3', '//fonts.googleapis.com/css?family=Raleway:200'); #logo
    wp_register_style('kale-googlefont4', '//fonts.googleapis.com/css?family=Caveat'); #tagline
    wp_enqueue_style('kale-googlefont1');
    wp_enqueue_style('kale-googlefont2');
    wp_enqueue_style('kale-googlefont3');
    wp_enqueue_style('kale-googlefont4');

    //default stylesheet
    $deps = array('bootstrap', 'bootstrap-select', 'font-awesome', 'owl-carousel');
    wp_register_style('kale-style', get_stylesheet_uri(), $deps );
    wp_enqueue_style('kale-style' );
    
    /* Scripts */
    
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', array('jquery','bootstrap'), '', true );
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true );
    wp_enqueue_script('kale-js', get_template_directory_uri() . '/assets/js/kale.js', array('jquery'), '', true );
    
    //comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
}
add_action( 'wp_enqueue_scripts', 'kale_scripts' );

/*------------------------------
 Custom CSS
 ------------------------------*/

function kale_custom_css() {
    $kale_advanced_css = kale_get_option('kale_advanced_css');
    if($kale_advanced_css != '') {    
        echo '<!-- Custom CSS -->';
        $output="<style>" . stripslashes($kale_advanced_css) . "</style>";
        echo $output;
        echo '<!-- /Custom CSS -->';
    }
}
add_action('wp_head','kale_custom_css', 99);

/*------------------------------
 Widgets
 ------------------------------*/
require_once get_template_directory() . '/widgets/widgets.php';

/*------------------------------
 Content Width 
 ------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

/*------------------------------
 wp_bootstrap_navwalker
 ------------------------------*/
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/*------------------------------
 TGM_Plugin_Activation
 ------------------------------*/

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'kale_register_required_plugins' );
function kale_register_required_plugins() {
	$plugins = array(
        array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),
	);
	$config = array(
		'id'           => 'kale',                  // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}

/*------------------------------
 Filters
 ------------------------------*/

#disable comments on media attachments
function kale_filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'kale_filter_media_comment_status', 10 , 2 );

#move comment field to the bottom of the comments form
function kale_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'kale_move_comment_field_to_bottom' );

#excerpt length
function kale_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'kale_excerpt_length', 999 );

#add class to page nav
function kale_wp_page_menu_class( $class ) {
  return preg_replace( '/<ul>/', '<ul class="nav navbar-nav">', $class, 1 );
}
add_filter( 'wp_page_menu', 'kale_wp_page_menu_class' );

#add search form to nav
function kale_nav_items_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';
    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';
    // the static link 
    $wrap .= kale_get_nav_search_item();
    // close the <ul>
    $wrap .= '</ul>';
    // return the result
    return $wrap;
}

function kale_get_nav_search_item(){
    return '<li class="search">
        <a href="javascript:;" id="toggle-main_search" data-toggle="dropdown"><i class="fa fa-search"></i></a>
        <div class="dropdown-menu main_search">
            <form name="main_search" method="get" action="'.esc_url(home_url( '/' )).'">
                <input type="text" name="s" class="form-control" placeholder="'.__('Type here','kale').'" />
            </form>
        </div>
    </li>';
}

#default nav top level pages
function kale_default_nav(){
    echo '<div class="navbar-collapse collapse">';
    echo '<ul class="nav navbar-nav">';
    $pages = get_pages();  
    $n = count($pages); 
    $i=0;
    foreach ( $pages as $page ) {
        $menu_name = $page->post_title;
        $menu_link = get_page_link( $page->ID );
        if(get_the_ID() == $page->ID) $current_class = "current_page_item";
        else { $current_class = ''; $home_current_class = ''; }
        $menu_class = "page-item-" . $page_id;
        echo "<li class='page_item $menu_class $current_class'><a href='$menu_link'>$menu_name</a></li>";
        $i++;
        if($n == $i){
            echo kale_get_nav_search_item();
        }
    } 
    echo '</ul>';
    echo '</div>';
}

/*------------------------------
 Helper
 ------------------------------*/
 
function kale_get_random_category(){
    $categories = get_categories(array('hide_empty'   => 0));
    foreach( $categories as $category ) 
        $temp[] = $category->term_id; 
    $rand_key = array_rand($temp, 1); 
    return ($temp[$rand_key]);
}

function kale_get_random_post(){
    $temp = array();
    $posts = get_posts( array( 'numberposts' => -1 ) );
    foreach( $posts as $post ) 
        $temp[] = $post->ID; 
    if($temp) {     
        $rand_key = array_rand($temp, 1); 
        return ($temp[$rand_key]);
    }
    return '';
}

function kale_get_option($key){
    global $kale_defaults;
    if (array_key_exists($key, $kale_defaults)) 
        $value = get_theme_mod($key, $kale_defaults[$key]); 
    else
        $value = get_theme_mod($key);
    return $value;
}

function kale_get_bootstrap_class($columns){
    switch($columns){
        case 1: return 'col-md-12'; break;
        case 2: return 'col-lg-6 col-md-6 col-sm-6 col-xs-6'; break;
        case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
        case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
        case 5: return 'col-md-20'; break;
        case 6: return 'col-lg-2 col-md-2 col-sm-2 col-xs-6'; break;
    }
}
function kale_get_sample($what){
    global $kale_defaults;
    switch($what){
        case 'slide':           $images = $kale_defaults['kale_slide_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-thumbnail':  $images = $kale_defaults['kale_thumbnail_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'full':            $images = $kale_defaults['kale_full_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);
        case 'kale-vertical':   $images = $kale_defaults['kale_vertical_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);    
        case 'kale-index':      $images = $kale_defaults['kale_index_sample']; $rand_key = array_rand($images, 1); return ($images[$rand_key]);    
    }
}

function kale_title() {
    if( is_home() && get_option('page_for_posts') ) :
        echo apply_filters('the_title', get_page( get_option('page_for_posts') )->post_title);
    elseif(is_home() && 'posts' == get_option( 'show_on_front' ) ) :
        _e('Recent Posts', 'kale');
    elseif ( is_page() ) :
        $title = get_the_title(); if($title != '') the_title(); else echo __("Page ID: ", 'kale') . get_the_ID();
    elseif (is_single() ):
        $title = get_the_title(); if($title != '') the_title(); else echo __("Post ID: ", 'kale') . get_the_ID();
    elseif ( is_category() ) :
        single_cat_title();
    elseif ( is_tag() ) :
        _e('Tag: ', 'kale'); single_tag_title();
    elseif ( is_author() ) :
        printf( esc_html__( 'Author: %s', 'kale' ), '<span>' . get_the_author() . '</span>' );
    elseif ( is_day() ) :
        printf( esc_html__( 'Day: %s', 'kale' ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() ) :
        printf( esc_html__( 'Month: %s', 'kale' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'kale' ) ) . '</span>' );
    elseif ( is_year() ) :
        printf( esc_html__( 'Year: %s', 'kale' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'kale' ) ) . '</span>' );
    elseif ( is_404() ) :
        _e('Not Found!', 'kale');
    elseif ( is_search() ) :
        _e('Search Results: ', 'kale'); echo get_search_query();
    else :
        _e( 'Archives', 'kale' );
    endif;
} 
?>