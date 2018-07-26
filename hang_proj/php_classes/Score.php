<?php
include_once 'Db.php';
class Score extends Db{

public function insertScore($score, $user){
  $sql = "INSERT INTO usrscore (user, score)
          VALUES ('$user', '$score')";

  if ($this->connect()->query($sql) === TRUE) {

  } else {
      die("Error: " . $this->connect()->error);
  }
}

public function getMultipleScores($user){
  $s = array();
  $sql = "SELECT * FROM usrscore WHERE user='$user' ORDER BY score DESC LIMIT 5";
    $result = $this->connect()->query($sql);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()) {
        $s[] = $row['score'];
     }
     return $s;
   }
 }
}
 ?>
