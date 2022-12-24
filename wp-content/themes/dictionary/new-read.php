<?php
    /**
    * Template Name: new read
    */
    get_header();
?>
<form method="get">
    <input type="number" name="number"><br>
    <button>Submit</button>
</form>

<?php
    require get_template_directory() . '/data/newA1.php';
    $arrs = explode('@', $text);

    $total = 0;
    if(count($arrs) > 0)
    {
        $wordOld = "";
        foreach($arrs as $arr){
            if(trim($arr) != "")
            {
                $words = explode(' ', $arr);
                $flag =  0;
                foreach($words as $word){
                    if($flag == 0 && $wordOld != $word){
                        // echo "New: ".$word; echo "<br>";
                        // echo "Old: ".$wordOld; echo "<br>";
                        // echo "<br><br><br>";
                        $wordOld = $word;
                        $total ++;
                    } 
                    $flag ++;
                }
            }
        }

    } else {
        echo "Not data";
    }

    echo "Total: ".$total;
?>



<?php
    get_footer();
?>