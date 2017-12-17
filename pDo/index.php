<?php
require 'pdo.php';
$pdo = connect();

$email = 'admin@localhost.com';
# we aVoid using $email variable directly into the SQlStatement
# in order to avoid Injection of data
$sql = "SELECT * FROM users WHERE email = :email";

try {
  $query = $pdo->prepare($sql);
  # we integrate parametes (:email) and specifier
  # that is a string parameter by (PDO::PARAM_STR)
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->execute();
  $user = $query->fetch();

  if ($user !== FALSE) {
    echo $user['email'];
  }

} catch (PDOException $e) {
  echo $e->getMessage();
}


 ?>
