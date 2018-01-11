<?php

require_once 'init.php';

#  article by id

$article = null;

	if(isset($_GET['id'])){
		
	 $id = (int)$_GET['id'];
		
}

$query = $db->query('
SELECT articles.id_article, articles.title,articles.content,
	AVG(articles_ratings.rating) as rating
	FROM articles
	LEFT Join articles_ratings
	ON articles.id_article = articles_ratings.article
 WHERE id_article = '.$id);

$articles = [];

	while($row = $query->fetch_object()){
	$articles[] = $row;
	}
	
		
		echo '<h3>'.$articles[0]->title.'</a></h3>';
		echo '<h5>'.$articles[0]->content.'</a></h5>';
		echo '<b>Rating:  '.round($articles[0]->rating).'/5</b><br />';
		foreach( range(1, 5) as $rating){
			echo '<a href="rate.php?article='.$articles[0]->id_article.'&rating='.$rating.'">'.$rating.'</a>';
		}
	

	
?>