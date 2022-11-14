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


add_action( 'add_meta_boxes_dictionary', 'add_metabox' );
function add_metabox() {
	add_meta_box(
		'dictionary_metabox', // metabox ID
		'Dictionary', // title
		'dictionary_metabox_callback', // callback function
		'dictionary', // post type or post types in array
		'normal', // position (normal, side, advanced)
		'default' // priority (default, low, high, core)
	);
}

// Show layout
function dictionary_metabox_callback( $post ) {
    $level = get_post_meta( $post->ID, 'level', true );

	$ukMP3 = get_post_meta( $post->ID, 'uk_mp3', true );
	$ukOGG = get_post_meta( $post->ID, 'uk_ogg', true );
	$ukIPA = get_post_meta( $post->ID, 'uk_ipa', true );

	$usMP3 = get_post_meta( $post->ID, 'us_mp3', true );
	$usOGG = get_post_meta( $post->ID, 'us_ogg', true );
	$usIPA = get_post_meta( $post->ID, 'us_ipa', true );

	wp_nonce_field( 'dictionarynonce', '_softkeymktnonce' );
    

    $metabox    =   '<div class="dictionary">
                        <div class="col">
                            <div class="wrap-pronunciation">
                                <div class="group-pronunciation">
                                    <div class="pronunciation-label">Pronunciation UK</div> 
                                    <div class="pronunciation-input">
                                        <div class="pronunciation-field">
                                            <div class="field-label">MP3</div>
                                            <input value="'.esc_attr($ukMP3).'" name="uk_mp3">
                                        </div>
                                        <div class="pronunciation-field">
                                            <div class="field-label">OGG</div>
                                            <input value="'.esc_attr($ukOGG).'" name="uk_ogg">
                                        </div>
                                        <div class="pronunciation-field">
                                            <div class="field-label">IPA</div>
                                            <input value="'.esc_attr($ukIPA).'" name="uk_ipa">
                                        </div>
                                    </div>       
                                </div>
                                <div class="group-pronunciation">
                                    <div class="pronunciation-label">Pronunciation US</div>
                                    <div class="pronunciation-input">
                                        <div class="pronunciation-field">
                                            <div class="field-label">MP3</div>
                                            <input value="'.esc_attr($usMP3).'" name="us_mp3">
                                        </div>
                                        <div class="pronunciation-field">
                                            <div class="field-label">OGG</div>
                                            <input value="'.esc_attr($usOGG).'" name="us_ogg">
                                        </div>
                                        <div class="pronunciation-field">
                                            <div class="field-label">IPA</div>
                                            <input value="'.esc_attr($usIPA).'" name="us_ipa">
                                        </div>
                                    </div>       
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="wrap-level">
                                <div class="level-label">Level</div>
                                <div class="level-content">';
                                    switch(trim($level))
                                    {
                                        case 'a1':
        $metabox .=                     '<div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1" checked>
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2">
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1">
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2">
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1">
                                            <label for="c1">C1</label>
                                        </div>
                                        ';
                                        break;

                                        case 'a2':
        $metabox .=                     '<div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1">
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2" checked>
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1">
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2">
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1">
                                            <label for="c1">C1</label>
                                        </div>
                                        ';
                                        break;

                                        case 'b1':
        $metabox .=                     '
                                        <div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1">
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2">
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1" checked>
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2">
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1">
                                            <label for="c1">C1</label>
                                        </div>
                                        ';
                                        break;

                                        case 'b2':
        $metabox .=                     '
                                        <div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1">
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2">
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1">
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2" checked>
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1">
                                            <label for="c1">C1</label>
                                        </div>
                                        ';
                                        break;

                                        case 'c1':
        $metabox .=                     '
                                        <div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1">
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2">
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1">
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2">
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1" checked>
                                            <label for="c1">C1</label>
                                        </div>';
                                        break;
                                        default:
        $metabox .=                     '
                                        <div class="item-level">
                                            <input type="radio" id="a1" name="level" value="a1">
                                            <label for="a1">A1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="a2" name="level" value="a2">
                                            <label for="a2">A2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b1" name="level" value="b1">
                                            <label for="b1">B1</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="b2" name="level" value="b2">
                                            <label for="b2">B2</label>
                                        </div>
                                        <div class="item-level">
                                            <input type="radio" id="c1" name="level" value="c1">
                                            <label for="c1">C1</label>
                                        </div>';
                                    }
       
        $metabox .=            '</div>
                            </div>
                        </div>



                    </div>';
	echo $metabox;
}


// Save data
add_action( 'save_post_dictionary', 'softkeymkt_save_meta', 10, 2 );
function softkeymkt_save_meta( $post_id, $post ) {
	// nonce check
	if ( ! isset( $_POST[ '_softkeymktnonce' ] ) || ! wp_verify_nonce( $_POST[ '_softkeymktnonce' ], 'dictionarynonce' ) ) {
		return $post_id;
	}

	// check current user permissions
	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}
	

	// Do not save the data if autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

    if( isset( $_POST[ 'level' ] ) ) {
		update_post_meta( $post_id, 'level', sanitize_text_field( $_POST[ 'level' ] ) );
	} else {
		delete_post_meta( $post_id, 'level' );
	}

	if( isset( $_POST[ 'uk_mp3' ] ) ) {
		update_post_meta( $post_id, 'uk_mp3', sanitize_text_field( $_POST[ 'uk_mp3' ] ) );
	} else {
		delete_post_meta( $post_id, 'uk_mp3' );
	}

	if( isset( $_POST[ 'uk_ogg' ] ) ) {
		update_post_meta( $post_id, 'uk_ogg', sanitize_text_field( $_POST[ 'uk_ogg' ] ) );
	} else {
		delete_post_meta( $post_id, 'uk_ogg' );
	}

	if( isset( $_POST[ 'uk_ipa' ] ) ) {
		update_post_meta( $post_id, 'uk_ipa', sanitize_text_field( $_POST[ 'uk_ipa' ] ) );
	} else {
		delete_post_meta( $post_id, 'uk_ipa' );
	}

	if( isset( $_POST[ 'us_mp3' ] ) ) {
		update_post_meta( $post_id, 'us_mp3', sanitize_text_field( $_POST[ 'us_mp3' ] ) );
	} else {
		delete_post_meta( $post_id, 'us_mp3' );
	}

	if( isset( $_POST[ 'us_ogg' ] ) ) {
		update_post_meta( $post_id, 'us_ogg', sanitize_text_field( $_POST[ 'us_ogg' ] ) );
	} else {
		delete_post_meta( $post_id, 'us_ogg' );
	}

	if( isset( $_POST[ 'us_ipa' ] ) ) {
		update_post_meta( $post_id, 'us_ipa', sanitize_text_field( $_POST[ 'us_ipa' ] ) );
	} else {
		delete_post_meta( $post_id, 'us_ipa' );
	}
    
	return $post_id;
}