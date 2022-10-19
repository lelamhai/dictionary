<?php
    get_header();
?>
<?php
    echo get_template_directory();


    // $args = array(  
    //     'post_type' => 'dictionary',
    //     'post_status' => 'publish',
    //     'posts_per_page' => -1, 
    //     'order' => 'ASC', 
    //     'option' => true,
    //     'custom_search' => 'c',

    // );
    // $loop = new WP_Query( $args ); 
        
    // while ( $loop->have_posts() ) : $loop->the_post(); 
    //     echo the_title(); echo "<br>";
    // endwhile;
    // wp_reset_postdata(); 
?>

<?php
    get_footer();
?>