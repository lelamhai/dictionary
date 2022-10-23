<?php
require get_template_directory() . '/include/post-types.php';

add_action('wp_enqueue_scripts', 'regsiter_styles');
function regsiter_styles()
{
    $version = "6";
    
    wp_enqueue_style('dictionary-bootstrap', get_template_directory_uri() ."/assets/bootstrap/css/bootstrap.min.css", array(), $version);


    wp_enqueue_script('dictionary-jquery-3.6.0.min', get_template_directory_uri() . "/assets/js/jquery.js", array(), $version, true);
    wp_enqueue_script('dictionary-bootstrap', get_template_directory_uri() . "/assets/bootstrap/js/bootstrap.min.js", array(), $version, true);
    wp_enqueue_script('dictionary-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version, true);
}

add_filter( 'posts_where', 'custom_search_start_with', 10, 2 );
function custom_search_start_with( $where, $query ) {
    global $wpdb;

    $option = esc_sql( $query->get( 'option' ) );
    $custom_search = esc_sql( $query->get( 'custom_search' ) );

    $first = 'a';

    // $where = null;
    switch ($option) {
        case 0:
            $where .= " AND $wpdb->posts.post_title = '$custom_search' AND $wpdb->posts.post_title LIKE '$first%'";
          break;
        case 1:
            $where .= " AND $wpdb->posts.post_title LIKE '$custom_search%'";
          break;
        case 2:
            $where .= " AND $wpdb->posts.post_title LIKE '%$custom_search'";
          break;
    }
    return $where;
}

add_action('wp_ajax_find_word', 'find_word_function');
add_action('wp_ajax_nopriv_find_word', 'find_word_function');
function find_word_function() {
    if(!empty($_GET["word"]))
    {
        $args = array(  
            'post_type' => 'dictionary',
            'post_status' => 'publish',
            'option' => 0,
            'custom_search' => $_GET["word"],
            'posts_per_page' => -1
        );
        $query = new WP_Query( $args ); 
        $posts = $query->posts;

        if(count($posts) > 0) {
            $args = array(  
                'post_type' => 'dictionary',
                'post_status' => 'publish',
                // 'order' => 'ASC', 
                'orderby' => 'rand',
                'option' => 1,
                'custom_search' => 'a',
                'posts_per_page' => 1
            );
            $query = new WP_Query( $args );
            $posts = $query->posts;
            var_dump($posts);
        } else {
            echo "empty";
        }

        
    }

    wp_die(); 
}