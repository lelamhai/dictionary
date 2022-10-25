<?php
    get_header();
?>

<style>
    .word-user {
        
    }

    .word-system {
        text-align: right;
    }
</style>

<main>
    <section class="advertisement"></section>
    <section class="center">
        <div class="rule-game">
            <div class="option-game">Chọn luật chơi</div> 
            <div class="group-option-game">
                <div class="item-option-game">
                    <input type="radio" id="html" name="fav_language" value="HTML" checked><label for="html">HTML</label><br>
                </div>
                <div class="item-option-game">
                    <input type="radio" id="css" name="fav_language" value="CSS"><label for="css">CSS</label><br>
                </div>
                <div class="item-option-game">
                    <input type="radio" id="js" name="fav_language" value="JS"><label for="js">JS</label><br>
                </div>
            </div>
            <div class="start-game"><button>Bắt đầu</button></div>
        </div>
        <div class="form">
            <input type="text" id="listId" value="[]">
            <input type="text" id="character" value="a">
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