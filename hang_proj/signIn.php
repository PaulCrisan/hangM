<?php
require 'php_classes/Users.php';
$warning = "";
session_start();
if(isset($_SESSION['game'])){
  unset($_SESSION['game']);
}

if(isset($_POST['submit'])){
  if(strlen($_POST['user']) > 0){
    if(strlen($_POST['pass']) > 2){
      $user = new Users($_POST['user'], $_POST['pass']);
      if(!$user->checkUser()){
        $response = $user->insertUser();
        if($response == "inserted"){
          $_SESSION['user'] = $user->getUser();
          header('Location: index.php');
          exit("Something went wrong");
        }else $warning = $response;
      }else $warning = "User already exists. Please choose another user name";
    }else $warning = "Password must be minimum 3 characters long";
  }else $warning = "User field empty";
}

 ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title>Sign In</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <?php include 'header.php'; ?>
        <div class="container">

            <div class="center-content">
                <form class="border" method="post">
                    <p class="title bold align mar max">Sign In</p>
                    <p class="title mar">Choose a user name</p>
                    <input id="user" type="text" name="user" onfocus="checkWarning()" onblur="userV()" autocomplete="off">
                    <!-- change -->
                    <p class="title mar">Choose a password</p>
                    <input id="pass" onfocus="checkWarning()" onblur="passV()" type="text" name="pass" value="" autocomplete="off">
                    <p class="title mar"></p>
                    <input class="button-click" type="submit" onclick="return validateF()" name="submit" value="Sign-in">
                    <div id="div1" class="warning">
                        <p id="pwarn">
                            <?php echo $warning ?>
                        </p>
                    </div>
                    <div id="div2" class="hidden warning padd g">
                        <p id="warning"></p>
                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>

        <script type="text/javascript" src="js/formValidation.js">
        </script>
    </body>

    </html>
