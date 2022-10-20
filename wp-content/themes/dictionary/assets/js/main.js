$("#submit" ).click(function() {
   var word = $(".word").val();
   $.ajax({
        type : "GET", 
        dataType: 'html',
        contentType: "application/json; charset=utf-8",
        url : "./wp-admin/admin-ajax.php",
        data : {
            action: "find_word",
            word: word
        },
        beforeSend: function(){

        },
        success: function(response) {
            console.log(response);
        },
        error: function( jqXHR, textStatus, errorThrown ){

        }
    });
});