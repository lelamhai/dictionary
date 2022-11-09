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
    <?php
        // update_field('ipa', array('uk'=>'haitho'), 161);
        // update_field('sound', array('pron-uk'=> array('mp3' => 'lelamhai')), 161);

        var_dump(get_post_meta( 232, 'pronunciation_uk_mp3', true ));
    ?>

    

    <section class="advertisement"></section>
    <section class="center">
        <div class="rule-game">
            <div class="option-game">Chọn luật chơi</div> 
            <div class="group-option-game">
                <div class="item-option-game">
                    <input type="radio" id="first" name="character" value="a" data-option="1" checked><label for="first">Một từ vựng bắt đầu ký tự "A"</label><br>
                </div>
                <div class="item-option-game">
                    <input type="radio" id="last" name="character" value="t" data-option="2"><label for="last">Một từ vựng kết thúc ký tự "T"</label><br>
                </div>
            </div>
            <div id="start-game"><button>Bắt đầu</button></div>
        </div>
        <div class="form">
            <input type="text" id="listId" value="[]">
            <input type="text" id="character" value="a">
            <input type="text" id="option" value="1">
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