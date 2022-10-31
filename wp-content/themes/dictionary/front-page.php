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

// Files to download
$urls = [
    'https://www.oxfordlearnersdictionaries.com/media/english/uk_pron/e/eat/eat__/eat__gb_1.mp3',
    'https://www.oxfordlearnersdictionaries.com/media/english/uk_pron/a/abo/above/above__gb_1.mp3'
];
multiple_download($urls);
?>


<main>
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