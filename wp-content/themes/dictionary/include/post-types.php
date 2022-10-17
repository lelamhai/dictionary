<?php
/*Custom Post type start*/
function custom_post_type_dictionary() {
    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Dictionary', 'plural'),
        'singular_name' => _x('dictionary', 'singular'),
        'menu_name' => _x('Dictionary', 'admin menu'),
        'name_admin_bar' => _x('dictionary', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New dictionary'),
        'new_item' => __('New dictionary'),
        'edit_item' => __('Edit dictionary'),
        'view_item' => __('View dictionary'),
        'all_items' => __('All dictionary'),
        'search_items' => __('Search dictionary'),
        'not_found' => __('No dictionary found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'dictionary'),
        'has_archive' => true,
        'hierarchical' => false,
    );
    register_post_type('dictionary', $args);
}
add_action('init', 'custom_post_type_dictionary');