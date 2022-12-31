<?php
    get_header();
    $listChar = array("a", "b", "c", "d", "e", "f", "g", "h", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "i", "u", "t", "v", "w", "x", "y", "z");
    
    do {
        $first = array_rand($listChar, 1);
        $last = array_rand($listChar, 1);
    } while($first==$last);
?>

<style>
    body {
        background-color: #0f0f0f;
    }

    .main .row {
        margin-right: 0;
        margin-left: 0;
    }
    .word-user {
        
    }

    .word-system {
        text-align: right;
    }

    .form {
        display: none;
    }

    #result-game .modal-title {
        float: left;
    }

    .wrap-top {
        display: none;
        justify-content: space-between;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="result-game" tabindex="-1" role="dialog" aria-labelledby="result-gameLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<main>
    <div class="main">
        <div class="row">
            <div class="col-md-2">
                <div class="advertisement">advertisement</div>
            </div>

            <div class="col-md-8">
                <div class="wrap-center">
                    <div class="wrap-top">
                        <div class="wrap-time">Điếm ngược: <span id="time">10</span></div>      
                        <div class="wrap-fail">Số lần sai: <span id="fail">0</span></div>
                    </div>
                    

                    <div class="rule-game">
                        <div class="option-game">Chọn luật chơi</div> 
                        <div class="group-option-game">
                            <div class="item-option-game">
                                <input type="radio" id="<?php echo $listChar[$first];?>" name="letter" value="<?php echo $listChar[$first];?>" data-condition="1" checked><label for="<?php echo $listChar[$first];?>">Một từ vựng bắt đầu ký tự "<?php echo $listChar[$first];?>"</label><br>
                            </div>
                            <div class="item-option-game">
                                <input type="radio" id="<?php echo $listChar[$last];?>" name="letter" value="<?php echo $listChar[$last];?>" data-condition="2"><label for="<?php echo $listChar[$last];?>">Một từ vựng kết thúc ký tự "<?php echo $listChar[$last];?>"</label><br>
                            </div>
                            <!-- <div class="item-option-game">
                                <input type="radio" id="middle" name="character" value="a" data-condition="2"><label for="middle">Một từ vựng dựa vào ký tự kết thúc của từ vựng trước</label><br>
                            </div> -->
                        </div>
                        <div id="start-game"><button>Bắt đầu</button></div>
                    </div>

                    <div class="result-option"></div>

                    <div class="form">
                        <input type="hidden" id="listId" value="[]">
                        <input type="hidden" id="letterSystem" value="<?php echo $listChar[$first];?>">
                        <input type="hidden" id="conditionSystem" value="1">
                        <div>
                            <div id="first-char">first</div>
                            <input type="text" id="word">
                            <div id="last-char">last</div>
                        </div>
                        <div>
                            <button id="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="words">
                    <div class="title">Danh sách từ</div>
                    <div id="ajax-list-words">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>



<?php
    get_footer();
?>