<?php
require get_template_directory() . '/include/post-types.php';

add_action('wp_enqueue_scripts', 'regsiter_styles');
function regsiter_styles()
{
    $version = "34";
    
    wp_enqueue_style('dictionary-bootstrap', get_template_directory_uri() ."/assets/bootstrap/css/bootstrap.min.css", array(), $version);


    wp_enqueue_script('dictionary-jquery-3.6.0.min', get_template_directory_uri() . "/assets/js/jquery.js", array(), $version, true);
    wp_enqueue_script('dictionary-bootstrap', get_template_directory_uri() . "/assets/bootstrap/js/bootstrap.min.js", array(), $version, true);
    wp_enqueue_script('dictionary-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version, true);
}

add_filter( 'posts_where', 'custom_search_start_with', 10, 2 );
function custom_search_start_with( $where, $query ) {
    global $wpdb;

    $condition = esc_sql( $query->get( 'condition' ) );
    $option = esc_sql( $query->get( 'option' ) );
    $custom_search = esc_sql( $query->get( 'custom_search' ) );
    $character =  esc_sql( $query->get( 'character' ) );

    $category = "'$character%'";
    if($option == 2)
    {
        $category = "'%$character'";
    }

    if($condition == 0)
    {
        $where .= " AND $wpdb->posts.post_title = '$custom_search' AND $wpdb->posts.post_title LIKE $category";
    } else {
        if($option == 1)
        {
            $where .= " AND $wpdb->posts.post_title LIKE '$custom_search%'";
        } else {
            $where .= " AND $wpdb->posts.post_title LIKE '%$custom_search'";
        }
    }
    
    // switch ($option) {
    //     case 0:
    //         $where .= " AND $wpdb->posts.post_title = '$custom_search' AND $wpdb->posts.post_title LIKE $condition";
    //       break;
    //     case 1:
    //         $where .= " AND $wpdb->posts.post_title LIKE '$custom_search%'";
    //       break;
    //     case 2:
    //         $where .= " AND $wpdb->posts.post_title LIKE '%$custom_search'";
    //       break;
    // }
    return $where;
}

add_action('wp_ajax_find_word', 'find_word_function');
add_action('wp_ajax_nopriv_find_word', 'find_word_function');
function find_word_function() {
    if(!empty($_GET["word"]) )
    {
        $json = array();

        $listId = json_decode($_GET["listId"]);
        $args = array(  
            'post_type' => 'dictionary',
            'post_status' => 'publish',
            'post__not_in' => $listId,
            'condition' => 0,
            'option' => $_GET["option"],
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
                'condition' => 1,
                'option' => $_GET["option"],
                'custom_search' => $_GET["character"],
                'posts_per_page' => 1
            );
            $query = new WP_Query( $args );
            $NewPosts = $query->posts;
            if(count($NewPosts) > 0)
            {
                array_push($listId, $NewPosts[0]->ID);
                $json["result"] = true;
                $json["newWord"] = $NewPosts[0]->post_title;
                $json["listId"] = json_encode($listId);
            } else {
                $json["result"] = false;
                $json["newWord"] = null;
                $json["listId"] = json_encode($listId);
            }
        } else {
            $json["result"] = false;
            $json["newWord"] = null;
            $json["listId"] = json_encode($listId);
        }
        wp_send_json_success($json);
        
    }
    wp_die(); 
}