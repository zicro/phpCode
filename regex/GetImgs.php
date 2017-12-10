<?php

$data = file_get_contents("http://www.xlion.org/");

$pattern = "/src=[\"']?([^\"']?.*(png|gif|jpg))[\"']?/i";

preg_match_all($pattern, $data, $imgs);

echo $imgs;
?>
