<?php

//kill gutenberg
add_filter( 'use_block_editor_for_post', '__return_false' );

//remove admin bar
show_admin_bar(false);

function register_my_menu() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('social-menu',__( 'Social Menu' ));
  register_nav_menu('policies-menu',__( 'Policies Menu' ));
}

add_action( 'init', 'register_my_menu' );



// enqueue scripts
function jquery_scripts() {
	wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'scrollreveal', 'https://unpkg.com/scrollreveal', array(), '', true );
  wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true );
  wp_localize_script('custom', 'wpAjax',  array(
   'ajaxUrl' => admin_url('admin-ajax.php')  )
 );
}

add_action( 'wp_enqueue_scripts', 'jquery_scripts' );

//enqueue css
function register_theme_styles() {
  wp_register_style( 'style', get_template_directory_uri() . '/assets/css/style.css' );
  wp_enqueue_style( 'style' );
}
add_action( 'wp_enqueue_scripts', 'register_theme_styles' );

add_theme_support( 'post-thumbnails' ); 

// remove_filter('the_content', 'wpautop');

//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// img attachment defaults
function default_attachment_display_settings() {
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'full' );
}

add_action( 'after_setup_theme', 'default_attachment_display_settings' );

// options page
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Settings',
    'menu_title'  => 'Settings',
    'menu_slug'   => 'settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}

add_action('admin_head', 'my_custom_wysiwyg');
function my_custom_wysiwyg() {
  echo '<style>
    .acf-editor-wrap iframe {
      min-height: 100px !important;
      height: 100px;
    } 
    .acf-gallery {
    	height: 200px !important;
    }
    // .wp-editor-area {
    // 	height: 70px !important;
    // }
  </style>';
}

// slugify
function slugify($text, string $divider = '-') {
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, $divider);
  $text = preg_replace('~-+~', $divider, $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

// ajax
function filterCat() {
  $cat = $_POST['category'];
  $tag = $_POST['tag'];

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'cat' => $cat,
    'orderby' => 'date', 
    'order' => 'DESC',
  );
  
  $filteredArticles = new WP_Query( $args ); 

  if($filteredArticles->have_posts()):
    while($filteredArticles->have_posts()) : $filteredArticles->the_post();
      include('snippets/articles-query.php');
    endwhile;
  else:
    echo 'No results';
  endif;
  wp_reset_postdata();

  die();
}
add_action('wp_ajax_filterCat', 'filterCat');
add_action('wp_ajax_nopriv_filterCat', 'filterCat');

// Register Custom Taxonomy
function main_tag_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Main tags', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Main tag', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Main tag', 'text_domain' ),
    'all_items'                  => __( 'All Main tags', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Item Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Item', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    'show_in_rest'               => true,
  );
  register_taxonomy( 'main_tag', array( 'post' ), $args );

}
add_action( 'init', 'main_tag_taxonomy', 0 );

// Register Custom Post Type
function place_post_type() {

  $labels = array(
    'name'                  => _x( 'Places', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Place', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Places', 'text_domain' ),
    'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
    'archives'              => __( 'Place Archives', 'text_domain' ),
    'attributes'            => __( 'Place Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Place:', 'text_domain' ),
    'all_items'             => __( 'All Places', 'text_domain' ),
    'add_new_item'          => __( 'Add New Place', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Item', 'text_domain' ),
    'edit_item'             => __( 'Edit Item', 'text_domain' ),
    'update_item'           => __( 'Update Item', 'text_domain' ),
    'view_item'             => __( 'View Item', 'text_domain' ),
    'view_items'            => __( 'View Items', 'text_domain' ),
    'search_items'          => __( 'Search Item', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Place', 'text_domain' ),
    'description'           => __( 'Post Type Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'            => array( 'zone', ' type' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 20,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'show_in_rest'          => true,
  );
  register_post_type( 'place', $args );

}
add_action( 'init', 'place_post_type', 0 );

// Register Custom Taxonomy
function zone_tax() {

  $labels = array(
    'name'                       => _x( 'Zones', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Zone', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Zones', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Item Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Item', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
  );
  register_taxonomy( 'zone', array( 'place' ), $args );

}
add_action( 'init', 'zone_tax', 0 );


// Register Custom Taxonomy
function type_tax() {

  $labels = array(
    'name'                       => _x( 'Types', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Types', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Item Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Item', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'show_in_rest'               => true,
  );
  register_taxonomy( 'type', array( 'place' ), $args );

}
add_action( 'init', 'type_tax', 0 );

?>