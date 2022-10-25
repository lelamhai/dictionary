$("#submit" ).click(function() {
   var wordUser = $("#word").val();
   var character = $("#character").val();
   var listId = $("#listId").val();
   $.ajax({
        type : "GET", 
        dataType: 'html',
        contentType: "application/json; charset=utf-8",
        url : "./wp-admin/admin-ajax.php",
        data : {
            action: "find_word",
            word: wordUser,
            character: character,
            listId: listId
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