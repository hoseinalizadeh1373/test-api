<?php
if(file_exists('data.json')){
  $jsonString = file_get_contents('data.json');
  $data = json_decode($jsonString, true);
}
?>

