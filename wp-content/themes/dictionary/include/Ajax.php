<?php
    add_filter( 'posts_where', 'custom_search', 10, 2 );
    function custom_search( $where, $query ) {
        global $wpdb;
    
        $condition = esc_sql( $query->get( 'condition' ) );
        $option = esc_sql( $query->get( 'option' ) );
        $word = esc_sql( $query->get( 'word' ) );
        $letter =  esc_sql( $query->get( 'letter' ) );
        
        if($option == 1)
        {
            $where .= " AND $wpdb->posts.post_title = '$word'";
        } else {
            if($condition == 1)
            {
                $where .= " AND $wpdb->posts.post_title LIKE '$letter%'";
            } else {
                $where .= " AND $wpdb->posts.post_title LIKE '%$letter'";
            }
        }

        return $where;
    }
    
    add_action('wp_ajax_find_word', 'find_word_function');
    add_action('wp_ajax_nopriv_find_word', 'find_word_function');
    function find_word_function() {
        if(!empty($_GET["word"]) )
        {
            $json = array();
            $listId = json_decode($_GET["listId"]);
            $index = 0;

            if($_GET["condition"] == 2)
            {
                $index = strlen($_GET["word"])-1;
            }

            if(substr($_GET["word"], $index, 1) != $_GET["letter"])
            {
                $json["result"] = false;
                $json["newWord"] = null;
                $json["listId"] = json_encode($listId);
                $json["message"] = "Hệ thống đang tìm lỗi!";
            }

            $currentPosts = find_word($listId, $_GET["word"], $_GET["letter"], $_GET["condition"], 1);

            if(count($currentPosts) > 0) {
                array_push($listId, $currentPosts[0]->ID);

                $NewPosts = find_word($listId, $_GET["word"], $_GET["letter"], $_GET["condition"], 2);
                
                if(count($NewPosts) > 0)
                {
                    array_push($listId, $NewPosts[0]->ID);
                    $json["result"] = true;
                    $json["newWord"] = $NewPosts[0]->post_title;
                    $json["listId"] = json_encode($listId);
                    $json["message"] = "Đã tìm thấy từ vựng";
                } else {
                    $json["result"] = false;
                    $json["newWord"] = null;
                    $json["listId"] = json_encode($listId);
                    $json["message"] = "Không tìm thấy từ vựng";
                }
            } else {
                $json["result"] = false;
                $json["newWord"] = null;
                $json["listId"] = json_encode($listId);
                $json["message"] = "Không tìm thấy từ vựng";
            }

            wp_send_json_success($json);
        }
        wp_die(); 
    }

    function find_word($listId, $word, $letter=null, $condition=null, $option)
    {
        $args = array(  
            'post_type' => 'dictionary',
            'post_status' => 'publish',
            'post__not_in' => $listId,
            'option' => $option,
            'condition' => $condition,
            'word' => $word,
            'letter' => $letter,
            'posts_per_page' => 1
        );
        $query = new WP_Query( $args ); 
        $currentPosts = $query->posts;

        return $currentPosts;
    }
?>