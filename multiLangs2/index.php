<?php


// function qui permet de cree une session, suite au button
// clicker, soit(anglais/Arabe)
function make_lang (){
	
	if (isset($_POST['ar'])){
		$_SESSION['arabic'] = true;
		//supprimer la session de l'autre session
		unset($_SESSION['english']);
	} 

	if (isset($_POST['en'])){
		$_SESSION['english'] = true;
		unset($_SESSION['arabic']);
	}
}

// function qui permet de retourner le chemin du fichier qui contient
// la langue, on test la valeur du session cree et suite a  elle
// on importe le fichier de la langue Voulue.
function get_lang_path(){
	
	if(!isset($_SESSION['english']))
		$_SESSION['arabic'] = true;
	
	if (isset ($_SESSION['arabic']))
		$lang = "ar";

	if (isset ($_SESSION['english']) )
		$lang = "en";
	
	$path = dirname(__FILE__)."/lang/".$lang.".php";
	
return $path;
}

// on appel la function
make_lang ();

// get the language file Destination
$lang_file = get_lang_path();

// on importe le fichier de la langue.
include ($lang_file);


?>
<form action="index.php" method="post">
<input type="submit" name="en" value="English" />
<input type="submit" name="ar" value="عربي" />
</form>
<ul>
	<li><?=$lang['main'];?></li>
	<li><?=$lang['page1'];?></li>
	<li><?=$lang['contact'];?></li>
	<li><?=$lang['about'];?></li>
</ul>