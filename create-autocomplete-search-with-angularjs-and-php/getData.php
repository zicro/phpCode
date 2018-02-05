<?php

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

$search = $data->searchText;

$sel = mysqli_query($con,"select * from users where name like '%".$search."%' limit 5");
$data = array();

while ($row = mysqli_fetch_array($sel)) {
    $data[] = array("name"=>$row['name']);
}

echo json_encode($data);
