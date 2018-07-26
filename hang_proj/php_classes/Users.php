<?php
include_once 'Db.php';
class Users extends Db{
  private $user;
  private $password;
  private $level;


  public function __construct($user, $pass, $level = 1){
    $user = mysqli_real_escape_string($this->connect(), trim($user));
    $pass = mysqli_real_escape_string($this->connect(), trim($pass));
    $this->user = $user;
    $this->password = $pass;
    $this->level = $level;


  }
  public function checkUser(){
    $sql = "SELECT * FROM users WHERE user='$this->user'";
    $result = $this->connect()->query($sql);
    if ($result->num_rows > 0){
      return true;
    }else return false;
  }

public function getUser(){
  return $this->user;
}
public function getHPass(){
  return $this->hashS($this->password);
}


public function checkUserPassword($variant){
  if($variant){
    $pass = $this->hashS($this->password);
  }else $pass = $this->password;
  $sql = "SELECT * FROM users WHERE user='$this->user' AND password ='$pass' ";
  $result = $this->connect()->query($sql);
  if ($result->num_rows > 0){
    return true;
  }else return false;
}

  public function insertUser(){
    $pass = $this->hashS($this->password);
    $sql = "INSERT INTO users (user, password, level)
            VALUES ('$this->user', '$pass', '$this->level')";

    if ($this->connect()->query($sql) === TRUE) {
        return "inserted";
    } else {
        return "Error: new user not created. Please try again ";
    }
  }

  public function hashS($string) {
        $fSalt = "{Q9&,Nm[?^^2eHz6n69,9/cXa=<Tw-";
        $pSalt = ":Lq%)N&ax}3f?N_d)+;fwS<f+";

        $string = md5(md5($fSalt) . md5($string) . md5($pSalt));
        for($i=0; $i < 3; $i++) {
            $string = md5($string);
            $string = sha1($string);
            $string = md5($string);
        }
        return $string;
    }

    //doar pentru popularea in baza d date !!!
    public function populateDb(){
      require 'helper_methods/functions.php';
      insertFromFileToDb("list_short", $this->connect(), "functions", "function_list_short");
    }

}

 ?>
