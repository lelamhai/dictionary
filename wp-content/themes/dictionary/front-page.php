<?php
    get_header();
    $listChar = array("a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "i", "u", "t", "v", "w", "x", "y", "z");
    
    do {
        $first = array_rand($listChar, 1);
        $last = array_rand($listChar, 1);
    }while($first==$last);
?>

<style>
    .word-user {
        
    }

    .word-system {
        text-align: right;
    }

    body {
        background-color: #0f0f0f;
        color: #fff;
    }

    .form {
        display: none;
    }
</style>

<main>
    <section class="advertisement"></section>
    <section class="center">
        <div class="rule-game">
            <div class="option-game">Chọn luật chơi</div> 
            <div class="group-option-game">
                <div class="item-option-game">
                    <input type="radio" id="<?php echo $listChar[$first];?>" name="character" value="<?php echo $listChar[$first];?>" data-option="1" checked><label for="<?php echo $listChar[$first];?>">Một từ vựng bắt đầu ký tự "<?php echo $listChar[$first];?>"</label><br>
                </div>
                <div class="item-option-game">
                    <input type="radio" id="<?php echo $listChar[$last];?>" name="character" value="<?php echo $listChar[$last];?>" data-option="2"><label for="<?php echo $listChar[$last];?>">Một từ vựng kết thúc ký tự "<?php echo $listChar[$last];?>"</label><br>
                </div>
                <!-- <div class="item-option-game">
                    <input type="radio" id="middle" name="character" value="a" data-option="2"><label for="middle">Một từ vựng dựa vào ký tự kết thúc của từ vựng trước</label><br>
                </div> -->
            </div>
            <div id="start-game"><button>Bắt đầu</button></div>
        </div>

        <div class="result-option">

        </div>

        <div class="form">
            <input type="hidden" id="listId" value="[]">
            <input type="hidden" id="character" value="<?php echo $listChar[$first];?>">
            <input type="hidden" id="option" value="1">
            <div>
                <input type="text" id="word">
            </div>
            <div>
                <button id="submit">Submit</button>
            </div>
        </div>
    </section>
    <section class="words">
        <div class="title">Danh sách từ</div>
        <div id="ajax-list-words">
            
        </div>
    </section>
</main>

<?php
    get_footer();
?>