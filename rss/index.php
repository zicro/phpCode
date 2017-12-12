<?php
$ch = curl_init("SITE_FROM_WHERE_WE_RECEIVE_DATA");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);

$data = curl_exec($ch);
curl_close($ch);

$doc = new SimpleXMLElement($data, LIBXML_NOCDATA);

function Rss($xml){
  echo "<b>".$xml->channel->title."</b><br>";
  $items = count($xml->channel->item);

  for ($i=0; $i < $items; $i++) {
    $url = $xml->channel->item[$i]->link;
    $title = $xml->channel->item[$i]->title;

    echo "<br><a href='".$url."'>".$title."</a>";
  }
}

Rss($doc);
?>
