<?php
//index.php
//include autoloader

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();


$connect = mysqli_connect("localhost", "root", "", "pet_adoption");

$query = "
	SELECT *
	FROM birds 
";
$result = mysqli_query($connect, $query);

$output = "
	<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table>
	<tr>
		<th>Category</th>
		<th>Product Name</th>
		<th>Price</th>
	</tr>
";

while($row = mysqli_fetch_array($result))
{
	$output .= '
		<tr>
			<td>'.$row["bird_name"].'</td>
			<td>'.$row["bird_age"].'</td>
			<td>$'.$row["bird_breed"].'</td>
		</tr>
	';
}

$output .= '</table>';

//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser
ob_end_clean();
$document->stream("Webslesson", array("Attachment"=>1));
//1  = Download
//0 = Preview


?>