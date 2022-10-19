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
    if(!empty($_GET["number"]))
    {
        $option = $_GET['number'];
        require get_template_directory() . '/data.php';

        $arrs = explode('@', $text);

        
        foreach($arrs as $arr)
        {
            $specialCharacter = "";
            if(trim($arr) != "")
            {
                $contents = explode('*', $arr);

                if(count($contents) > 0 && count($contents) < 2)
                {
                    $words = explode('-', $arr);
                    $flag =  0;
                    $specialCharacter = "";
                    foreach($words as $word)
                    {
                        if($flag == 0)
                        {
                            echo "Word: ".$word; echo "<br>";
                            $new_post = array(
                                'post_type'     => 'dictionary',
                                'post_title'    => $word,
                                'post_status'   => 'publish',
                            );
                        
                            $id = wp_insert_post($new_post);
                            if ( is_wp_error( $id ) ) {
                                echo "System errors";
                            } 
                        } 
                        // else {
                        //     $specialCharacter = $specialCharacter . "- " . $word . "<br>";
                        // }
                        $flag ++;
                    }
                    // echo $specialCharacter; echo "<br>";

                } else {
                    $first =  0;
                    foreach($contents as $content)
                    {
                        if($first == 0)
                        {
                            $words = explode('/', $content);
                            $flag = 0;
                            foreach($words as $word)
                            {
                                if($flag == 0)
                                {
                                    echo "Word: ".$word; echo "<br>";
                                    $new_post = array(
                                        'post_type'     => 'dictionary',
                                        'post_title'    => $word,
                                        'post_status'   => 'publish',
                                    );
                                
                                    $id = wp_insert_post($new_post);
                                    if ( is_wp_error( $id ) ) {
                                        echo "System errors";
                                    } 
                                } 
                                // else if($flag == 1)
                                // {
                                //     echo "IPA: "."/".$word."/"; echo "<br>";
                                // }
                                $flag ++;
                            }
                        } 
                        // else {
                        //     $new = str_replace('-', '<br>- ', trim($content));
                        //     $specialCharacter = $specialCharacter . "*" . trim(ucfirst($new)) . "<br>";
                        // } 
                        $first ++;
                    }
                    // echo $specialCharacter; echo "<br>";
                }
                echo "<br><br><br><br>";
            }
        }
    } else {
        echo $_GET["number"];
    }
?>

<form method="get">
    <input type="number" name="number"><br>
    <button>Submit</button>
</form>

<?php
    get_footer();
?>