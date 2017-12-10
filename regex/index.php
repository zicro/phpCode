<?php
// data using to test the patterns below
# you can use it with a form and replace this values
# with the $_POST[] values ...
$email = "admin@xlion.org";
$user  = "xLion";
$pass  = "@zerty123";

// testing the username Value
# "/^[a-z0-9_-]{3-6}$" mean : the username should be :
## letter|chiffre with minimum 3 characters and maximum 6 characters
matching("/^[a-zA-Z0-9_-]{3,6}$/", $user, 'Username');

// testing the pass Value
# '/^[a-zA-Z0-9_@-]{6,18}$/' means : the password should contain :
## chiffres and letters with minumu lenght of 6 characteres
# and maximum of 18 characters and it may contains _ Or - or @
matching('/^[a-zA-Z0-9_@-]{6,18}$/', $pass, 'Password');

// testing the Email Value
matching('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $email, 'Email Adresse');

# matching Fucntion, accept 3 parameteres
/**
$pattern = regular expression check
$data = data to check
$type = type of data checked using for echo message
*/
function matching($pattern, $data, $type){
  if(preg_match($pattern, $data)){
    echo $type.' Correct <br>';
  }else{
    echo $type.' incorrect <br>';
  }
}
?>
