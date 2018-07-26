$(document).ready(function() {
    var timer; // intervalul pentru timer
    // dupa ce pagina este scrisa incarcam async continutul paginii html din www..php.net
    ajax("loadInfo");


    $('#hint').click(function() {
        ajax("hint");
    });



    //@ functie ajax generala de trimis si primit date de la server
    function ajax(value) {
        var x = {
            'info': value
        };
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: x,
            success: function(data) {
                try {
                    getAjPromise(JSON.parse(data));
                } catch (e) {
                    console.log("error");
                }
            }
        });

    }
    //interfata pentru raspunsul serverului
    function getAjPromise(data) {
        if (data.description != null) {
            loadContentHtml(data);
        } else if (data.check_char_array != null) {
            gameStatus(data);
        } else if (data.score != null) {
            returnScore(data);
        }

    }
    // sfarsit functie ajax

    //@ cand jocul s-a sfarsit

    function endGame(type) {
        $('#char-input').hide();
        $('#checkButton').hide();
        if (type == "win") {
            $('.winS').show();
        } else $('.failS').show();


        var x = (min * 60) + sec;
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                'score': x
            },
            success: function(data) {
              try {
                  getAjPromise(JSON.parse(data));
              } catch (e) {
                  console.log("error");
              }

            }
        });

        clearInterval(timer);

    }

    // sfarsit jocul

    //@ pentru log logOut

    $('#logOut').click(function() {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                'info': 'logOut'
            },
            success: function() {
                window.location = "logIn.php";
            }
        });
    })
    //sfarsit log out

    //
    function inArray(needle, haystack) {
        var count = haystack.length;
        for (var i = 0; i < count; i++) {
            if (haystack[i] === needle) {
                return true;
            }
        }
        return false;
    }

    //@  verificari joc
    //trimitem litera din input prin ajax spre server si verificam datele trasmise
    var sameGuess = [];  //retinem caracterele deja ghicite

    $('#checkButton').click(function() {
        console.log(sameGuess.toString());
        var char_in = $("#char-input").val();
        $("#char-input").val("");
        if (char_in.length == 0 || !char_in.match(/^[A-Za-z\_0-9]+$/)) {
            alert("Please enter a letter or number");
            return;
        } else if (inArray(char_in, sameGuess)) {
            alert("Character already guessed");
            return;
        }
        char_in = char_in.toLowerCase();

        ajax(char_in);
    });
    $("#char-input").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#checkButton").click();
        }
    });

    var countDownFlag = true;

    function gameStatus(json) {
        if (countDownFlag && json.time_limit != null) {
            countDownFlag = false;
            startTimer(json.time_limit);
        }
        if (json.check_win != null && json.check_win == "win") {
            endGame("win");
        }
        var g = parseInt($("#guesses_").html());
        if (json.guesses_left != null) {
            if (g > json.guesses_left) $('.im').prepend($('.hang-img').last());
            if (json.guesses_left == 0) endGame("lost");
            $("#guesses_").html(json.guesses_left);
        }
        var key_ = "";
        var value_ = [];
        if (json.check_char_array != null) {
            if (json.check_char_array.hint == null) {
                $.each(json.check_char_array, function(key, value) {
                    key_ = key;
                    value_ = value;
                });

                if (value_.length > 0) {
                    for (var i = 0; i < value_.length; i++) {
                        $('#' + value_[i]).css('color', 'black')
                            .html(key_);

                    }
                    sameGuess.push(key_);
                }
            } else alert("No more hints available ");
        }
        if (json.used_chars != null) {
            var s = json.used_chars;
            $("#usedChars_").html(s.toString());
        }
    }

    var min = 0;
    var sec = 0;
    var timer;

    function startTimer(timeLimit, flag) {
        min = timeLimit - 1;
        sec = 60;
        timer = setInterval(function() {
            if (sec < 10) {
                $("#counter").html(min + ":0" + sec);
            } else $("#counter").html(min + ":" + sec);
            sec--;
            if (sec == 00) {
                min--;
                sec = 60;
            }
            if (min == -1) {
                clearInterval(timer);
                $("#counter").html("0:00");
                endGame("lost");
            }
        }, 1000);
    }
    //sfarsit verificari joc


    //@ afisare statistica in continutul tabului
    function returnScore(json) {


        function addDiv(class_, width_, html_) {
            //inmultim scorul cu 3 pentru a avea bara de scor mai mare
            var div = $("<div/>")
                .addClass(class_)
                .css('width', (width_ * 3) + 4)
                .html(html_);
            return div;
        }
        $('.chart-elements').append(addDiv("empty-chart", 150, "This game score:"));
        if (json.score != null) {
            $('.chart-elements').append(addDiv("chart", json.score, json.score));
        } else $('.chart-elements').append(addDiv("empty-chart", 150, "score not available"));
        $('.chart-elements').append(addDiv("empty-chart", 150, "Your top games score:"));
        if (json.topscore != null) {
            if (json.topscore.length != 0) {
                $.each(json.topscore, function(key, value) {
                    $('.chart-elements').append(addDiv("chart", value, value));
                });
            } else $('.chart-elements').append(addDiv("empty-chart", 150, "need to be logged in"));

        } else $('.chart-elements').append(addDiv("empty-chart", 150, "you have no other games yet"));
        $("#statTab").click();

    }
    //sfarsit afisare statistica

    //restart joc sau aplica setari de timp
    $('#restartBtn').click(function() {
        aRestart(null);
    })
    $('.time').click(function(){
      aRestart(parseInt($(this).html()))
    })


    function aRestart(value) {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                'restart': value
            },
            success: function() {
                location.reload();
            }
        });
    }
    //sfarsit restart joc


    //@ incarcam date din site
    //incarcam promisiunea intoarsa din server site-ul php

    function loadContentHtml(json) {
        if (json.description != null){
         $('#descr_fromUrl').html(json.description);
       }else $('#descr_fromUrl').html("Could not load function description. Try again");
    }
    //sfarsit incarcare date

    //@logica pentru tab-uri
    //
    $("#statTab").click(function() {
        // daca se da click inainte de terminarea jocului
        // si nu exista statistici
        if (!$("#chart-container").children().length > 0) {
            $('.chart-elements').append($("<p>").addClass("txt").html("Stats available at the end of game "));
            tabs(this);
            var x = setInterval(function() {
                tabs(this);
                $("p").remove(":contains('Stats available at the end of game ')");
                clearInterval(x);
            }, 2000)

        } else {
            tabs(this);
        }

    })
    $("#searchTab").click(function() {
        tabs(this);
    })

    function tabs(id) {
        var bodyAr = ["statsBody", "searchBody"];
        var butAr = ["statTab", "searchTab"];
        var id = $(id).attr('id');
        for (var i = 0; i < butAr.length; i++) {
            if (id == butAr[i]) {
                //inchide tab daca a fost dat click pe el insusi
                if ($("#" + bodyAr[i]).css("display") == "none") {
                    $("#" + id).css('background', '#D2E7F2');
                    $("#" + bodyAr[i]).show("slow");
                } else {
                    $("#" + butAr[i]).css('background', '#E5F0F6');
                    $("#" + bodyAr[i]).hide("slow");
                }
                //inchide restul taburilor
            } else {
                $("#" + butAr[i]).css('background', '#E5F0F6');
                $("#" + bodyAr[i]).hide("slow");
            }
        }
    }
    // sfarsit logica taburi


});
