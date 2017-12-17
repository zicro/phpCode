<?php
if ($_POST) {
  require 'validate.php';

  $rules = array(
    'email' => 'email|required',
    'password' => 'required',
    'emailsgoogle' => 'semail',
    'sudo' => 'access'
  );

  $validation = new validation();

  if ($validation->validate($_POST, $rules) == TRUE) {
    var_dump($_POST);
    # here we can now call DB and get data or require a class to .... begin real Work here
  }else {
    echo '<ul>';
    foreach ($validation->errors as $error) {
      echo '<li>'.$error.'</li>';
    }
    echo '</ul>';
  }
}
?>
<form action="" method="post" novalidate>
simple Adresse email : <input type="email" name="email" /><br>
Specifique email (@gmail.com) : <input type="email" name="emailsgoogle" /><br>
Password : <input type="password"  name="password"/><br>
<input type="hidden"  name="sudo" value="admin"/><br>
<input type="submit"  name="sub"/>
</form>
