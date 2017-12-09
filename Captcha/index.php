<?php
session_start();

if (isset($_POST['do']) && $_POST['do'] == 'send'){
	
	if ($_POST['captcha'] != $_SESSION['code'] || empty($_POST['captcha'])){
		echo "Wrong Captcha Code";
	}else{
		echo "All things are GoOd :) ";
	}
	
}

echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>
Name : <input type='text' name='name' /><br>
Message : <textarea name='msg'></textarea><br>
Captcha : <img src='captcha.php' alt='Captcha'/><input type='text' size='6' name='captcha' /><br>
<input type='submit' name='sub' />
<input type='hidden' name='do' value='send' />
</form>"
?>