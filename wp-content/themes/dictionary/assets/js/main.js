$(document).ready(function(){
    $("#start-game" ).click(function() {
        let char = $('input[name="character"]:checked').val();
        let option = $('input[name="character"]:checked').data("option");
        $("#character").val(char);
        $("#option").val(option);
    });
    
    $("#submit" ).click(function() {
        var wordUser = $("#word").val();
        var character = $("#character").val();
        var listId = $("#listId").val();
        var option = $("#option").val();

        if($.trim(wordUser).length == 0)
        {
            return false;
        }

       $.ajax({
            type : "GET", 
            dataType: 'html',
            contentType: "application/json; charset=utf-8",
            url : "./wp-admin/admin-ajax.php",
            data : {
                action: "find_word",
                word: wordUser,
                character: character,
                listId: listId,
                option: option
            },
            beforeSend: function(){
    
            },
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj.data.result)
                {
                    $("#listId").val(obj.data.listId);
                    let htmlUser = '<div class="word-user">'+wordUser+'</div>';
                    $("#ajax-list-words").append(htmlUser);
    
                    let wordSystem = obj.data.newWord;
                    let htmlSystem = '<div class="word-system">'+wordSystem+'</div>';
                    $("#ajax-list-words").append(htmlSystem);
    
                } else {
                    console.log(response);
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
    
            }
        });
    });
});