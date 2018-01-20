<?php
include 'db.php';


# get Total number of question
$query = "SELECT * FROM questions";
# get results
$results = $db->query($query) or die($db->error.__LINE__);
$total = $results->num_rows;
?>

Test your Knowledge : <br>
<p>with this miltiple choice quiz</p>

<p>Number of question : <?php echo $total;?></p>
<p>type of question : Multiple Choice</p>
<p>Estimated Time : <?php echo $total*.5;?> Minutes.</p>