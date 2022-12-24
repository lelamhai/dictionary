<?php
require get_template_directory() . '/include/ajax.php';
require get_template_directory() . '/include/post-types.php';

add_action('wp_enqueue_scripts', 'regsiter_styles');
function regsiter_styles()
{
    $version = "66";
    
    wp_enqueue_style('dictionary-bootstrap', get_template_directory_uri() ."/assets/bootstrap/bootstrap.min.css", array(), $version);

    wp_enqueue_script('dictionary-jquery-3.6.0.min', get_template_directory_uri() . "/assets/js/jquery-3.6.0.min.js", array(), $version, true);
    wp_enqueue_script('dictionary-bootstrap', get_template_directory_uri() . "/assets/bootstrap/bootstrap.min.js", array(), $version, true);
    wp_enqueue_script('dictionary-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version, true);
}

