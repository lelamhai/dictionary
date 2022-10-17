<?php
require get_template_directory() . '/include/post-types.php';

function custom_search_start_with( $where, $query ) {
    global $wpdb;

    $option = esc_sql( $query->get( 'option' ) );
    $custom_search = esc_sql( $query->get( 'custom_search' ) );

    if ( $option ) {
        $where .= " AND $wpdb->posts.post_title LIKE '$custom_search%'";
    } else {
        $where .= " AND $wpdb->posts.post_title LIKE '%$custom_search'";
    }
    return $where;
}
add_filter( 'posts_where', 'custom_search_start_with', 10, 2 );


