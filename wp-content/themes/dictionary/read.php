<?php
    /**
    * Template Name: read
    */
    get_header();
?>
<?php
    $default = 10;

    for ($i=1; $i <= 1; $i++) {
            $listSound = array();
            $pathRoot = "https://www.oxfordlearnersdictionaries.com";
            // $option = $i;
            require get_template_directory() . '/data.php';
            $arrs = explode('@', $text);
            // print "<pre>";
            // print_r($arrs);
            // print "</pre>";
    
    
            $end = $i * $default;
            $begin = $end - $default;
    
            $list = array_slice($arrs, $begin, $end);
            // print "<pre>";
            // print_r($list);
            // print "</pre>";
    
            if(count($list) > 0)
            {
                foreach($list as $arr){
                    if(trim($arr) != "")
                    {
                        $words = explode('-', $arr);
                        $flag =  0;
        
                        $postId = 0;
                        foreach($words as $word){
                            if($flag == 0){
                                echo "Word: ".$word; echo "<br>";
                                $new_post = array(
                                    'post_type'     => 'dictionary',
                                    'post_title'    => $word,
                                    'post_status'   => 'publish',
                                );
                            
                                $postId = wp_insert_post($new_post);
                            } else {
                                $content = explode('/', $word);

                                $url = $pathRoot. $word;
                                echo "Name file: ".basename($url); echo "<br>";
                                array_push($listSound, trim($url));

                                switch($flag)
                                {
                                    case 1;
                                        update_field('pronunciation_uk', array('mp3'=>basename($url)), $postId);
                                        break;

                                    case 2;
                                        update_field('pronunciation_uk', array('ogg'=>basename($url)), $postId);
                                        break;

                                    case 3;
                                        update_field('pronunciation_us', array('mp3'=>basename($url)), $postId);
                                        break;
                                    case 4;
                                        update_field('pronunciation_us', array('ogg'=>basename($url)), $postId);
                                        break;
                                }
                                

    
                            }
                            $flag ++;
                        }
        
                        echo "<br><br><br>";
                    }
                }
    
                multiple_download($listSound);
                sleep(60); // this should halt for 3 seconds for every loop
            } else {
                echo "Not data";
            }
    }
?>

<?php
function multiple_download(array $urls, $save_path = 'wp-content/uploads/english/')
{
    $multi_handle = curl_multi_init();
    $file_pointers = [];
    $curl_handles = [];

    // Add curl multi handles, one per file we don't already have
    foreach ($urls as $key => $url) {
        $file = $save_path . basename($url);
        if(!is_file($file)) {
            $curl_handles[$key] = curl_init($url);
            $file_pointers[$key] = fopen($file, "w");
            curl_setopt($curl_handles[$key], CURLOPT_FILE, $file_pointers[$key]);
            curl_setopt($curl_handles[$key], CURLOPT_HEADER, 0);
            curl_setopt($curl_handles[$key], CURLOPT_CONNECTTIMEOUT, 60);
            curl_multi_add_handle($multi_handle,$curl_handles[$key]);
        }
    }

    // Download the files
    do {
        curl_multi_exec($multi_handle,$running);
    } while ($running > 0);

    // Free up objects
    foreach ($urls as $key => $url) {
        curl_multi_remove_handle($multi_handle, $curl_handles[$key]);
        curl_close($curl_handles[$key]);
        fclose ($file_pointers[$key]);
    }
    curl_multi_close($multi_handle);
}
?>

<?php
    get_footer();
?>