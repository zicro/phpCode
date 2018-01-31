<?php


echo $_POST['name'];
# il Contient le nom du fichier a charger
$name	  = $_FILES["myfile"]["name"];
# contient le type du fichier a charger
$type 	  = $_FILES["myfile"]["type"];
#l'emplacement temporaire du ficher a charger
$temp	  = $_FILES["myfile"]["tmp_name"];
# le size du fichier a charger
$size 	  = $_FILES["myfile"]["size"];
# return 0 si tous ce passe bien
$error 	  = $_FILES["myfile"]["error"];


	if ($error > 0){
		die("Error Uploading File .. ");
	}else{

			# envoyer le fichier a charger vers le dossier (up) et lui attribuer le $name (en peut changer son nom).
			move_uploaded_file($temp,"up/".$name);
			echo "File Uploaded Successfully !!";
	}
?>