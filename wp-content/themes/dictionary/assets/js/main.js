let interval;
let char;
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
        char = $('input[name="character"]:checked').val();
        option = $('input[name="character"]:checked').data("option");
        $("#character").val(char);
        $("#option").val(option);

        var label = $("label[for='"+char+"']").text();
        $('.rule-game').css("display", "none");
        $('.result-option').text(label);
        $('.form').css("display", "block");
        $('.wrap-top').css("display", "flex");
        
        if(option == 1)
        {
            $('#first-char').text(char);
            $('#last-char').css("display", "none");
        } else {
            $('#last-char').text(char);
            $('#first-char').css("display", "none");
        }

        startDownCount(10);
    });


    $("#submit" ).click(function() {
        sendWordServer();
        if(option == 1)
        {
            $('#first-char').text(char);
            $('#last-char').css("display", "none");
        } else {
            $('#last-char').text(char);
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
            console.log("Timer --> " + counter);
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
    var character = $("#character").val();
    var listId = $("#listId").val();
    var option = $("#option").val();

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
        character: character,
        listId: listId,
        option: option,
        },
        beforeSend: function () {},
        success: function (response) {
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