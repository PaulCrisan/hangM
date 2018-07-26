<?php
include_once 'Db.php';
class Hangman extends Db{

private $guessString;
private $nrOfGuesses;
private $timeLimit;
private $winArray;
private $usedChars;
const SCORE = 100;
private $sessionScore;
private $hintsArray;

public function __construct($timeLimit = 2, $nrOfGuesses = 10 ){
    $this->nrOfGuesses = $nrOfGuesses;
    $this->timeLimit = $timeLimit;
    $this->winArray = array();
    $this->usedChars = array();
    $this->guessString = $this->queryRdmStr();
    $this->hintsArray = str_split($this->guessString);
     var_dump($this->guessString);
  }

  public function queryRdmStr(){
    //alegem random un string din baza de date in functie de cate sunt introduse
    $minId;
    $maxId;
    $str ="";
    $sql = "SELECT `id_` FROM `functions` WHERE id_ = (SELECT MIN(id_) FROM functions)";
    $sql2 = "SELECT `id_` FROM `functions` WHERE id_ = (SELECT MAX(id_) FROM functions)";
    $result = $this->connect()->query($sql);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $minId = $row["id_"];
    }
    $result = $this->connect()->query($sql2);
    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $maxId = $row["id_"];
    }
    // daca accidental avem un id fara un string cautam in continuare
    do {
      $rdm = rand($minId, $maxId);
      $sql3 = "SELECT `function_list_short` FROM `functions` WHERE id_ = '$rdm'";
      $result = $this->connect()->query($sql3);
      if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $str = $row["function_list_short"];
      }
    } while (strlen($str) == 0);
    return $str;
  }

  public function useHint(){
    //logica pentru afisarea hint-urilor
      $char ="";
      //verificare cate litere mai sunt in array fara cele null
    if(count(array_filter($this->hintsArray)) > 1){
       do {
          $char = $this->hintsArray[rand(0, count($this->hintsArray)-1)];
    } while ($char == null);

  }else return array("hint" => "none");
    //folosim metoda checkChar deja creata pentru verificari
    $s = $this->checkChar($char);

    $this->removePoints('hint');
    return $s;
  }

  public function checkWin(){
    if(count(array_diff(str_split($this->guessString),$this->winArray)) == 0)
        return "win";
  }

public function checkChar($char_){
  $positions = array();
  if(strpos($this->guessString, $char_) !== false){
    $tempArray = str_split($this->guessString);
    for ($i=0; $i < count($tempArray) ; $i++) {
      if($tempArray[$i] == $char_){
          $positions[] = $i;
          $this->winArray[] = $char_ ;
          // eliminam literele gasite din array de hint pentru a nu fi repetate
          $this->hintsArray[$i] = null;
      }
    }
    $positions = array($char_ => $positions);
    return $positions;
  }else {
    if(!in_array($char_ ,$this->usedChars)){
      $this->usedChars[] = $char_;
      $this->nrOfGuesses --;
      $this->removePoints('check');
    }
  }
  return $positions;
}

public function removePoints($type){
  if($type == 'hint'){
    //adaugam 20 puncte respectiv 1 punct
    $this->sessionScore += 20;
  }elseif($type == 'check'){
    $this->sessionScore += 5;
  }
}

public function calculateScore($time){
  if($time != null && strpbrk($time, '1234567890') !== false){
    $baseTime = ($this->timeLimit * 60)/120;
    $time = round(60-(($time/$baseTime)/2));
  }else $time = 0;
  $score = (Hangman::SCORE - $this->sessionScore)-$time;
  if($score <= 0){
    $score = 0;
  }
  return $score;
}

public function getNrOFGuesses(){
  return $this->nrOfGuesses;
}

public function getUsedChars(){
  return $this->usedChars;
}

public function getGuessStringCount(){
  return strlen($this->guessString);
}

public function getGuessString(){
  return $this->guessString;
}

public function getTimeLimit(){
  return $this->timeLimit;
}


}



 ?>
