<?php

# on importe les donnes de cnx a la DB
require_once 'init.php';

	if(isset($_GET['article'], $_GET['rating'])){
	
// a l'aide de la function (int) on effectue un caste de type int
// si la valeur de type int c ok, c non il va le caster	
	$article = (int)$_GET['article'];
	$rating  = (int)$_GET['rating'];
	
	if(in_array($rating, [1,2,3,4,5])){
		# on verifier si l'article exist dans la DB ou non
	$exists = $db->query("SELECT id_article from articles WHERE id_article = {$article}")->num_rows ? true : false;

	if($exists){
		# dans le cas d'article exist on ajoute la rating
		$db->query("INSERT INTO articles_ratings(article, rating) VALUES ({$article}, {$rating})");
	}
	
	}
	
	// redirection l'utilisateur vers le meme articles d'ou il Vient
	header('Location: article.php?id='.$article);
	
}


?>