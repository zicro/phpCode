<?php

require_once 'init.php';

# all articles

$query = $db->query('
	SELECT articles.id_article, articles.title,
	AVG(articles_ratings.rating) as rating
	FROM articles
	LEFT Join articles_ratings
	ON articles.id_article = articles_ratings.article
	GROUP BY articles.id_article
	');

$articles = [];

	while($row= $query->fetch_object()){
	$articles[] = $row;
	}
	
	foreach($articles as $article){
		
		echo '<h3><a href="article.php?id='.$article->id_article.'">'.$article->title.'</a></h3>
		<div>rating: '.round($article->rating).'/5</div>';
	}

	
?>