let interval;
let letter;
let option;
let fail = 0;

$(document).ready(function(){
    // let total = 0;
    // let string = "";
    // let wordLast = "";
    // $('.top-g li').each(function(i, obj) {
    //     // let data = $(obj).data('ox3000');
    //     let data = $(obj).data('ox5000');
    //     if(data == 'b2')
    //     {   
    //         if(wordLast != $.trim($(obj).children("a").text()))
    //         {
    //             total ++;
    //             string = string + 
    //             "@"+ $(obj).children("a").text()+"\n"+ 
    //             "*"+ $(obj).children("div").children(".belong-to").text()+"\n"+
    //             "*"+ $(obj).children("div").children(".pron-uk").data("src-mp3")+"\n"+
    //             "*"+ $(obj).children("div").children(".pron-uk").data("src-ogg")+"\n"+
    //             "*"+ $(obj).children("div").children(".pron-us").data("src-mp3")+"\n"+
    //             "*"+ $(obj).children("div").children(".pron-us").data("src-ogg")+"\n"
    //             ;
    //             wordLast = $.trim($(obj).children("a").text());
    //         }
            
    //     }
    // });
    // console.log(string);
    // console.log(total);



    

    
    $("#start-game" ).click(function() {
        letter = $('input[name="letter"]:checked').val();
        condition = $('input[name="letter"]:checked').data("condition");

        $("#letterSystem").val(letter);
        $("#conditionSystem").val(condition);

        var label = $("label[for='"+letter+"']").text();
        $('.rule-game').css("display", "none");
        $('.result-option').text(label);
        $('.form').css("display", "block");
        $('.wrap-top').css("display", "flex");
        
        if(condition == 1)
        {
            $('#first-char').text(letter);
            $('#last-char').css("display", "none");
        } else {
            $('#last-char').text(letter);
            $('#first-char').css("display", "none");
        }

        // startDownCount(10);
    });

    $("#submit" ).click(function() {
        sendWordServer();
        if(option == 1)
        {
            $('#first-char').text(letter);
            $('#last-char').css("display", "none");
        } else {
            $('#last-char').text(letter);
            $('#first-char').css("display", "none");
        }
    });

    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            sendWordServer(); 
        }
    });
});

function startDownCount(counter) {
    interval = setInterval(function() {
        counter--;
        if (counter <= 0) {
            $('#time').text("Hết giờ");
            $('#result-game').modal('toggle');
            stopCountDown(); 
            return;
        }else{
            $('#time').text(counter);
        }
    }, 1000);
}

function stopCountDown()
{
    clearInterval(interval);
    interval = null;
}

function sendWordServer() {
    var wordUser = $("#word").val();
    var letterSystem = $("#letterSystem").val();
    var conditionSystem = $("#conditionSystem").val();
    var listId = $("#listId").val();

    if ($.trim(wordUser).length == 0) {
        return false;
    }

    $.ajax({
        type: "GET",
        dataType: "html",
        contentType: "application/json; charset=utf-8",
        url: "./wp-admin/admin-ajax.php",
        data: {
        action: "find_word",
        word: wordUser,
        letter: letterSystem,
        condition: conditionSystem,
        listId: listId,
        },
        beforeSend: function () {},
        success: function (response) {
            console.log(response);
            var obj = jQuery.parseJSON(response);
            if (obj.data.result) {
                stopCountDown();
                $("#listId").val(obj.data.listId);
                let htmlUser = '<div class="word-user">' + wordUser + "</div>";
                $("#ajax-list-words").append(htmlUser);

                let wordSystem = obj.data.newWord;
                let htmlSystem = '<div class="word-system">' + wordSystem + "</div>";
                $("#ajax-list-words").append(htmlSystem);

                $("#word").val("");
                $("#word").focus();
                startDownCount(10);
            } else {
                console.log(response);
                fail++;
                $('#fail').text(fail);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
}