<?php

$lng =  substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);

switch($lng){
	case "ar":
		header("Location:ar.php");
	break;
	case "fr":
		header("Location:fr.php");
	break;
	case "en":
		header("Location:en.php");
	break;
	default:
		header("Location:en.php");
}
?>