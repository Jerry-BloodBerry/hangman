var word_id;
var word_count;
var word_sizes;
var hang_count=0;
var score = 120;
var letter_sum =0;
$(function () {
    $.ajax({
        url: "/php/game/start_game.php",
        type: "GET",
        dataType: "json",
        async: false,
        method: "GET",
        success:function(data)
        {
            word_id = data.word_id;
            word_count = data.word_count;
            word_sizes = data.sizes;
            for(let s of word_sizes) {
                letter_sum+= s;
            }
            drawLetterFields(word_count,word_sizes);
        }
        ,
        error: function(data)
        {
            console.log('Fatal error. Server did not respond properly.');
        }

    });
    $.ajax({
        url: "/php/game/load_scores.php",
        type: "POST",
        dataType: "json",
        method: "POST",
        data: {
            'id': word_id
        },
        success:function(data)
        {
            let user_scores = data.scores;
            if(user_scores.length===0)
            {
                let score_table_container = $("#score-table-container");
                score_table_container.empty();
                score_table_container.append(`<h3 class="text-center">No one has solved this word yet!</h3>`);
            }
            else
            {
                let score_table = $("#score-tbody");
                let score_i = 1;
                user_scores = user_scores.sort(compareScores);
                for(u_score of user_scores)
                {
                    let arrkey = Object.keys(u_score)[0];
                    console.log(arrkey);
                    score_table.append
                    (`<tr>
                      <td>${score_i}</td>
                      <td>${arrkey}</td>
                      <td>${u_score[arrkey]}</td> 
                </tr>`);
                    score_i++;
                }
            }
        }
        ,
        error: function(data)
        {
            console.log('Fatal error. Server did not respond properly.');
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
                score = data.score;
                hang_count = data.hang_count;
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
        let score_element = $("#score_container");
        if(contains_letter)
        {
            $(this).addClass("keyboard-button-good");
            score_element.css("color", "#478017");
            let letter_positions = response.responseJSON.positions;
            letter_sum -= letter_positions.length;
            for(position of letter_positions)
            {
                $(`#letter_${position['word']}_${position['index']}`).val(this.value);
            }
        }
        else
        {
            $(this).addClass("keyboard-button-bad");
            $("#hangman-img").attr("src", `/img/hang${hang_count}.png`);
            score_element.css("color", "#80001c");
        }
        score_element.text(response.responseJSON.score);
        $(this).blur();
        if(hang_count===12||letter_sum===0)
        {
            if(hang_count===12)
            {
                $("#end-game-image").attr("src","/img/you_hang.png");
                $("#end-game-title").text("GAME OVER");
                $.ajax({
                    url: "/php/game/reveal_word.php",
                    type: "POST",
                    dataType: "json",
                    method: "POST",
                    async: false,
                    data: {
                        'word_id': word_id
                    },
                    success:function(data)
                    {
                        $("#word-reveal-text").text("The hidden word was: " + data.word);
                    }
                    ,
                    error: function(data)
                    {
                        console.log('Fatal error');
                    }

                });
            }
            if(letter_sum===0)
            {
                $("#end-game-image").attr("src","/img/you_win.png");
                $("#end-game-title").text("VICTORY");

                $.ajax({
                    url: "/php/game/save_score.php",
                    type: "POST",
                    dataType: "json",
                    method: "POST",
                    data: {
                        'word_id': word_id
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
            }
            $('#endGameModal').modal('show');
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

function compareScores(score1,score2)
{
    let comparison = 0;
    if(parseInt(score1[`${Object.keys(score1)[0]}`])<parseInt(score2[`${Object.keys(score2)[0]}`]))
    {
        comparison = 1;
    }
    else comparison = -1;
    return comparison;
}