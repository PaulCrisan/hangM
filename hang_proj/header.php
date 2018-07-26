<?php
  // linkul catre home sa nu functioneze daca esti in home
echo '<a href="#" onclick="(function(){

          if(window.location.href.indexOf(\'signIn\') !== -1 || window.location.href.indexOf(\'logIn\') !== -1){
            window.location = \'index.php\';
          }
            })()"><div class="center-content no-top">
        <div >
          <p class="title">Hangman with PHP functions</p>
        </div>
        <img id="header-img" src="images/PHANGMAN.png">

      </div></a>'
 ?>
