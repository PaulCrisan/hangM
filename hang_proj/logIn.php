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
      if($user->checkUserPassword(true)){
        $_SESSION['user'] = $user->getUser();
        if (isset($_POST['rem'])) {

        //  cookie pentru 30 sec
          setcookie('username', $user->getUser(), time()+30);
          setcookie('password', $user->getHPass(), time()+30);
      }
      header('Location: index.php');
      exit("Something went wrong");
    }else $warning = "Password or username wrong";
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
                    <p class="title bold align mar max">Log In</p>
                    <p class="title mar">User name</p>
                    <input id="user" type="text" name="user" onfocus="checkWarning()" onblur="userV()" autocomplete="off">
                    <!-- change -->
                    <p class="title mar">Password</p>
                    <input id="pass" onfocus="checkWarning()" onblur="passV()" type="text" name="pass" value="" autocomplete="off">
                    <p class="title mar"></p>
                    <input class="button-click" type="submit" onclick="return validateF()" name="submit" value="Log-in">
                    <p class="title mar"></p>
                    <input id="checkbox" type="checkbox" name="rem" value="1">
                    <span class="title mar">remember me</span>
                    <p class="title mar"></p>
                    <div class="display-row">
                        <p class="txt">Don't have an account?&nbsp; </p>
                        <a href="signIn.php">
                            <p class="link-text">sign in </p>
                        </a>
                    </div>

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
