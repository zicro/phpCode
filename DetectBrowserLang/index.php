<?php
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    //$acceptLang = ['fr', 'it', 'en']; 
    //$lang = in_array($lang, $acceptLang) ? $lang : 'en';
    
	if($lang == "ar"){
		//redirect to Arabe version
		echo "Arabe version here ...";
	}

?>