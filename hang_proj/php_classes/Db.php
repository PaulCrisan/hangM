<?php
class Db{
  protected function connect(){
    require 'config.in';
    $link = new mysqli($servername, $username, $password, $db);
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
    return $link;
  }
}

 ?>
