<?php

class seomaster{
    public function alexaRank($url){
      $xml  = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$url);
      $rank = (int)$xml->SD[1]->POPULARITY->attributes()->TEXT;
      $web = (string)$xml->SD[1]->POPULARITY->attributes()->URL;

      return $rank;
    }
}

$url = "http://www.google.com";
$seo = new seomaster;

echo $seo->alexaRank($url);
?>
