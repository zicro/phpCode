<?php
session_start();

 ?>
<form method="post" action="login.php">
  <input type="text" name="user"/>
  <input type="password" name="pass"/>
<input type="checkbox" name="remember" value="1"/>
  <input type="submit" name="go"/>
</form>
