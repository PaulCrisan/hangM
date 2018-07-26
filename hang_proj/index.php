<?php
include 'php_classes/Hangman.php';
include 'helper_methods/functions.php';
include 'php_classes/Score.php';
include 'php_classes/Users.php';
$displayblock = "_" ;
$currUser = "";
$hidden ="";
session_start();
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
  $user = new Users($_COOKIE['username'],$_COOKIE['password']);
  if($user->checkUserPassword(false)){
    $_SESSION['user'] = $user->getUser();
  }
}
if(!isset($_SESSION['game'])){
  if(isset($_SESSION['time'])){
      $_SESSION['game'] = new Hangman($_SESSION['time']);
  }else $_SESSION['game'] = new Hangman();
}
if(isset($_SESSION['user'])){
  $hidden = "style = 'display:none'";
  $currUser = "<div class ='links'>
                  <p id= 'loggedUser' class='txt title'>Welcome, ".$_SESSION['user']. "&nbsp;</p>
                  <a href='logIn.php'>
                  <p id= 'logOut' class='link-text margin-ls'> / Log out </p>
                  </a>
               </div>";
  $_SESSION['score'] = new Score();

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['info']) && strlen($_POST['info']) != 0){
    if($_POST['info'] == 'hint'){
      $ar = array('check_char_array' => $_SESSION['game']->useHint());
      echo json_encode($ar);
      exit;
    }elseif(strlen($_POST['info']) == 1){
      $ar = array('check_char_array' => $_SESSION['game']->checkChar($_POST["info"]),
                    'time_limit'     => $_SESSION['game']->getTimeLimit(),
                     'check_win'     => $_SESSION['game']->checkWin(),
                     'used_chars'    => $_SESSION['game']->getUsedChars(),
                  'guesses_left'     => $_SESSION['game']->getNrOFGuesses());
      echo json_encode($ar);
      exit;
    }elseif($_POST['info'] == 'loadInfo'){
      $ar = array(
                'description'=>getContentByClass($_SESSION['game']->getGuessString())
            );
      echo json_encode($ar);
      exit;
    }elseif($_POST['info'] == 'logOut'){
      $_SESSION[] = array();
      session_destroy();
      setcookie('username', "", 1);
      setcookie('password', "", 1);
      exit;
    }
  }elseif(isset($_POST['score']) && strlen($_POST['score']) != 0){
     $score = $_SESSION['game']->calculateScore($_POST['score']);
     $topscore = array();
     if(isset($_SESSION['score'])){
       $topscore =$_SESSION['score']->getMultipleScores($_SESSION['user']);
       $_SESSION['score']->insertScore($score, $_SESSION['user'] );
     }
      $ar = array(
                'score'=>$score,
             'topscore'=>$topscore
            );

      echo json_encode($ar);
      exit;
  }


  if(isset($_POST['restart'])){
    if($_POST['restart'] != null){
      $_SESSION['time'] = $_POST['restart'] ;
    }
    unset($_SESSION['game']);
  }


}

 ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <title>hangman game</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <?php include 'header.php'; ?>


        <div class="container index">
            <?php echo $currUser ?>
            <div <?php echo $hidden ?> class="links">
                <a href="logIn.php">
                    <p class="link-text">Log in /&nbsp; </p>
                </a>
                <a href="signIn.php">
                    <p class="link-text">Sign in </p>
                </a>
            </div>
            <div class="border s  ">
                <p class="mar-bott txt title">Guess the following php function:</p>
                <p id="descr_fromUrl" class="mar-bott txt"></p>
            </div>
            <div class="divider"></div>
            <div class="flex-start">
                <button id="hint" class="button-click" type="button" name="button">Hint</button>
                <?php for ($i = 0; $i < $_SESSION['game']->getGuessStringCount()  ; $i++) {
                    echo "<span id = '$i' class='title bold marL'> $displayblock</span>";
                    }
           ?>
            </div>
            <p class="txt title mt">Used characters:</p>
            <p id="usedChars_" class="txt "></p>
            <div class="display-row border fit  ">
                <div class="flex-start notop">
                    <input id="char-input" class="input guess" type="text" name="" value="" max="1" maxlength="1">
                    <button id="checkButton" class="button-click" type="button" name="button">Check</button>
                    <div class="hidden-s winS">
                        <img id="win" class="end" src="images/win.png" alt="win">
                    </div>
                    <div class="hidden-s failS">
                        <img id="lost" class="end" src="images/fail.png" alt="fail">
                    </div>
                </div>
                <div class="margin-l rel im">
                    <img class="hang-img" src="images/hangP/11.png" alt="">
                    <img class="hang-img" src="images/hangP/10.png" alt="">
                    <img class="hang-img" src="images/hangP/9.png" alt="">
                    <img class="hang-img" src="images/hangP/8.png" alt="">
                    <img class="hang-img" src="images/hangP/7.png" alt="">
                    <img class="hang-img" src="images/hangP/6.png" alt="">
                    <img class="hang-img" src="images/hangP/5.png" alt="">
                    <img class="hang-img" src="images/hangP/4.png" alt="">
                    <img class="hang-img" src="images/hangP/3.png" alt="">
                    <img class="hang-img" src="images/hangP/2.png" alt="">
                    <img class="hang-img" src="images/hangP/1.png" alt="">
                </div>


            </div>
            <div class="display-row">
                <p class="txt title padd">Time left (min):</p>
                <p id="counter" class="title normal paddmax">
                    <?php echo $_SESSION['game']->getTimeLimit() ?>
                </p>
                <p class="txt title padd">Guesses left:</p>
                <p id="guesses_" class="title normal title">
                    <?php echo $_SESSION['game']->getNrOFGuesses() ?>
                </p>
            </div>
            <!-- tab-uri si buton de restart-->
            <div class="fl-start">
                <button id="restartBtn" class="button-click" type="button" name="button">Restart</button>
            </div>
            <div class="display-row self">

                <div id="statTab" class="tab2">
                    <p>user stats</p>
                </div>
                <div id="searchTab" class="tab2">
                    <p>time settings</p>
                </div>
            </div>
            <!-- sfarsit tab-uri si buton restart-->

            <!-- corpul tab-urilor -->
            <div class="stats">
                <div id="searchBody" class="hidden">
                    <form method="post">
                        <div class="button-click time">2 min(default)</div>
                        <div class="button-click time">3 min</div>
                        <div class="button-click time">4 min</div>
                    </form>
                </div>
                <div id="statsBody" class="hidden">
                    <!--  -->
                    <div id="chart-container" class="chart-elements">
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- sfarsit corp tab-uri -->
        </div>

        <?php include 'footer.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/index.js">
        </script>
    </body>

    </html>
