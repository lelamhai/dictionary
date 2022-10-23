$("#submit" ).click(function() {
   var word = $("#word").val();
   var character = $("#character").val();
   var listId = $("#listId").val();
   $.ajax({
        type : "GET", 
        dataType: 'html',
        contentType: "application/json; charset=utf-8",
        url : "./wp-admin/admin-ajax.php",
        data : {
            action: "find_word",
            word: word,
            character: character,
            listId: listId
        },
        beforeSend: function(){

        },
        success: function(response) {
            $("#listId").val("");
            $("#listId").val(response);
            console.log(response);
        },
        error: function( jqXHR, textStatus, errorThrown ){

        }
    });
});