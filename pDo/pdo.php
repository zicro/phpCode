<?php
function connect(){
  return new PDO('mysql:host=localhost;dbname=test', 'root', '', array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
 ?>
