var word_id;
var word_count;
var word_sizes;
$(function () {
    $.ajax({
        url: "/php/game/start_game.php",
        type: "GET",
        dataType: "json",
        method: "GET",
        success:function(data)
        {
            word_id = data.word_id;
            word_count = data.word_count;
            word_sizes = data.sizes;
        }
        ,
        error: function(data)
        {
            console.log('nie wyszło!');
        }

    });
    $(".keyboard-button").click(function () {
        //console.log(this.value);
        let response = $.ajax({
            url: "/php/game/check_letter.php",
            type: "POST",
            dataType: "json",
            method: "POST",
            async: false,
            data: {
                'id': word_id,
                'letter': this.value
            },
            success:function(data)
            {
            }
            ,
            error: function(data)
            {
                console.log('Fatal error');
            }

        });
        let contains_letter = response.responseJSON.contains;
        if(contains_letter)
        {

        }
    })
});

function drawLetterFields(w_count, sizes)
{

}