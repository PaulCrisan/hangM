<?php

// luam continutul din adresa specifica de html in functie stringul trimis
function getContentByClass($funcStr){
  $s = "";
  $s2 = array();
  $d = str_replace("_", "-", $funcStr);
  $html = file_get_contents("http://php.net/manual/en/function.".$d.".php");
  $doc_ = new DOMDocument();
  libxml_use_internal_errors(TRUE);
  if(!empty($html)){
  	$doc_->loadHTML($html);
  	libxml_clear_errors();
  	$xpath_ = new DOMXPath($doc_);
  	//$row2 = $xpath_->query("//div[@class='methodsynopsis dc-description']");
    $row = $xpath_->query("//span[@class='dc-title']");
  	if($row->length > 0){
  		foreach($row as $row_){
  			$s .= $row_->nodeValue;

  		}return $s;
  	}
  }
}

// luam continutul din adresa de html dupa un tag specific
function getContentByTags($url, $tag){
  $html = file_get_contents($url);
  $doc_ = new DOMDocument();
  libxml_use_internal_errors(TRUE);
  if(!empty($html)){
  	$doc_->loadHTML($html);
  	libxml_clear_errors();
    $tagTxt = array();
    $arr = $doc_->getElementsByTagName("a");
      foreach($arr as $item) {
        $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
        array_push($tagTxt, $text."\n");
      }
      return $tagTxt;
  }
}
//inseram data din txt file in baza de date -- folosit doar odata !!
function insertFromFileToDb($txtFileURL, $link, $table, $column){
  echo $txtFileURL;
    $s = file_get_contents(__DIR__."\\$txtFileURL");
    $sAr = explode("\n", $s);
    $sAr = array_map('trim',$sAr); //remove possible white space
    for ($i=0; $i < count($sAr) ; $i++) {
      $sql = "INSERT INTO `$table`(`$column`) VALUES ('$sAr[$i]')";
      if ($link->query($sql) !== TRUE) echo "Error: " . $sql . "<br>" . $link->error;
    }
}

?>
