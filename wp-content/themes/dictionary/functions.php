<?php
require get_template_directory() . '/include/post-types.php';

add_action('wp_enqueue_scripts', 'regsiter_styles');
function regsiter_styles()
{
    $version = "11";
    
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
    $character =  esc_sql( $query->get( 'character' ) );

    switch ($option) {
        case 0:
            $where .= " AND $wpdb->posts.post_title = '$custom_search' AND $wpdb->posts.post_title LIKE '$character%'";
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
    if(!empty($_GET["word"]) )
    {
        $listId = json_decode($_GET["listId"]);
        $args = array(  
            'post_type' => 'dictionary',
            'post_status' => 'publish',
            'post__not_in' => $listId,
            'option' => 0,
            'custom_search' => $_GET["word"],
            'character' => $_GET["character"],
            'posts_per_page' => 1
        );
        $query = new WP_Query( $args ); 
        $oldPosts = $query->posts;

        if(count($oldPosts) > 0) {
            array_push($listId, $oldPosts[0]->ID);
            $args = array(  
                'post_type' => 'dictionary',
                'post_status' => 'publish',
                'post__not_in' => $listId,
                'orderby' => 'rand',
                'option' => 1,
                'custom_search' => 'a',
                'posts_per_page' => 1
            );
            $query = new WP_Query( $args );
            $NewPosts = $query->posts;
            if(count($NewPosts) > 0)
            {
                array_push($listId, $NewPosts[0]->ID);
                echo json_encode($listId);
            }
        } else {
            echo "empty";
        }
    }
    wp_die(); 
}