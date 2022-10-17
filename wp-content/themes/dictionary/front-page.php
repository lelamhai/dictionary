<?php
    get_header();
?>

<?php
    $text = "
        @a /ei, ə/
        *  danh từ,  số nhiều as,  a's
        - (thông tục) loại a, hạng nhất, hạng tốt nhất hạng rất tốt
        =his health is a+ sức khoẻ anh ta vào loại a
        - (âm nhạc) la
        =a sharp+ la thăng
        =a flat+ la giáng
        - người giả định thứ nhất; trường hợp giả định thứ nhất
        =from a to z+ từ đầu đến đuôi, tường tận
        =not to know a from b+ không biết tí gì cả; một chữ bẻ đôi cũng không biết
        *  mạo từ
        - một; một (như kiểu); một (nào đó)
        =a very cold day+ một ngày rất lạnh
        =a dozen+ một tá
        =a few+ một ít
        =all of a size+ tất cả cùng một cỡ
        =a Shakespeare+ một (văn hào như kiểu) Sếch-xpia
        =a Mr Nam+ một ông Nam (nào đó)
        - cái, con, chiếc, cuốn, người, đứa...;
        =a cup+ cái chén
        =a knife+ con dao
        =a son of the Party+ người con của Đảng
        =a Vietnamese grammar+ cuốn ngữ pháp Việt Nam
        *  giới từ
        - mỗi, mỗi một
        =twice a week+ mỗi tuần hai lần
    
        @a b c /'eibi:'si:/
        *  danh từ
        - bảng chữ cái
        - khái niệm cơ sở, cơ sở
        =a_b_c of chemistry+ khái niệm cơ sở về hoá học, cơ sở hoá học
        - (ngành đường sắt) bảng chỉ đường theo abc

        @abdicator /'æbdikeitə/ (abdicant) /'æbdikənt/
        *  danh từ
        - người từ bỏ
        - người thoái vị

        @aberrancy /æ'berəns/ (aberrancy) /æ'berənsi/
        *  danh từ
        - sự lầm lạc
        - (sinh vật học) sự khác thường
    ";

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
get_footer();