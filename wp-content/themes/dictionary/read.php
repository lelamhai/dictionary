<?php
    /**
    * Template Name: read
    */
    get_header();
?>
<form method="get">
    <input type="number" name="number"><br>
    <button>Submit</button>
</form>
<?php
    
    $default = 10;
    if(!empty($_GET["number"]) && (int)$_GET["number"] > 0)
    {   
        $listSound = array();
        $pathRoot = "https://www.oxfordlearnersdictionaries.com";
        $option = (int)$_GET['number'];
        require get_template_directory() . '/data.php';
        $arrs = explode('@', $text);
        // print "<pre>";
        // print_r($arrs);
        // print "</pre>";


        $end = $_GET["number"] * $default;
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
    
                    
                    foreach($words as $word){
                        if($flag == 0){
                            echo "Word: ".$word; echo "<br>";
                        } else {
                            $content = explode('/', $word);
                            $count = count($content);
                            if($count == 1)
                            {
                                echo $content[0]; echo "<br>";
                            } else {
                                // echo $word; echo "<br>"; link file sound
                                $url = $pathRoot. $word;
                                array_push($listSound, trim($url));
                            }
                        }
                        $flag ++;
                    }
    
                    echo "<br><br><br>";
                }
            }
            // var_dump($listSound); echo "<br><br><br>";
            // $urls = [
            //     'https://www.oxfordlearnersdictionaries.com/media/english/uk_pron/e/eat/eat__/eat__gb_1.mp3',
            //     'https://www.oxfordlearnersdictionaries.com/media/english/uk_pron/a/abo/above/above__gb_1.mp3'
            // ];

            // var_dump($urls);echo "<br><br><br>";

            multiple_download($listSound);
        } else {
            echo "Not data";
        }
    } else {
        echo $_GET["number"];
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


<form method="get">
    <input type="number" name="number"><br>
    <button>Submit</button>
</form>

<?php
    get_footer();
?>