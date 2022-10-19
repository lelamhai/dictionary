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
                            } else if($flag == 1)
                            {
                                echo "IPA: "."/".$word."/"; echo "<br>";
                            }
                            $flag ++;
                        }
                    } 
                    else {
                        $new = str_replace('-', '<br>- ', trim($content));
                        $specialCharacter = $specialCharacter . "*" . trim(ucfirst($new)) . "<br>";
                    }
                    $first ++;
                }
                echo $specialCharacter; echo "<br>";
                echo "<br><br><br><br>";
            }
        }
    }
?>

<form method="get">
    <input type="number" name="number"><br>
    <button>Submit</button>
</form>

<?php
    get_footer();
?>