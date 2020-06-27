var word_id;
var word_count;
var word_sizes;
var hang_count=0;
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
            drawLetterFields(word_count,word_sizes);
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
        $(this).attr("disabled", "disabled");
        $(this).removeClass("keyboard-button");
        if(contains_letter)
        {
            $(this).addClass("keyboard-button-good");
        }
        else
        {
            $(this).addClass("keyboard-button-bad");
            hang_count++;
            $("#hangman-img").attr("src", `/img/hang${hang_count}.png`);
        }
        $(this).blur();
        if(hang_count===12)
        {
            alert("You hanged!");
        }
    })
});

function drawLetterFields(w_count, sizes)
{
    for(let i=0; i<w_count; i++)
    {
        $("#words_container").append(`
        <div class="btn-group word_group" role="group" aria-label="Word${i}" id="container_word_${i}"></div><br/>
        `);
        for(let j=0; j<sizes[i]; j++)
        {
            $(`#container_word_${i}`).append(`<input type="button" class="btn hangman-button" id="letter_${i}_${j}" disabled/>`);
        }
    }
}