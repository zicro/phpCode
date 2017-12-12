<?php
session_start();
#DB cnx string ...

if (!empty($_POST['user']) && !empty($_POST['pass'])) {
  # check if the user and pass exist in the DB

  $_SESSION['user'] = $user;
  $_SESSION['pass'] = $pass;
  $_SESSION['Login'] = 1;
}

?>
