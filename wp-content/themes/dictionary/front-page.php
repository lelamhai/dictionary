<?php
    get_header();
    // $args = array(  
    //     'post_type' => 'dictionary',
    //     'post_status' => 'publish',
    //     'option' => 0,
    //     'custom_search' => 'alphanumeric-value',
    //     'posts_per_page' => -1
    // );
    // $query = new WP_Query( $args ); 
    // $posts = $query->posts;
    // var_dump($posts);
?>
<main>
    <section class="advertisement"></section>
    <section class="center">
        <div class="form">
            <div>
                <input type="text" class="word">
            </div>
            <div>
                <button id="submit">Submit</button>
            </div>
        </div>
    </section>
    <section class="words">
        <div class="title">Danh sách từ</div>
        <div class="ajax-list-words">
            
        </div>
    </section>
</main>

<?php
    get_footer();
?>