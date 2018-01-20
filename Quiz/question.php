<?php 
include 'db.php'; 
session_start();

// get the number from the link
$number = (int)$_GET['n'];

# get the question

$query = "SELECT * FROM `questions` WHERE q_num = ".$number;

# get the result

$result = $db->query($query) or die($db->error.__LINE__);

$question = $result->fetch_assoc();

#### get the choices

$query2 = "SELECT * FROM `choice` 
				WHERE  q_num = ".$number;

# get the result

$choices = $db->query($query2) or die($db->error.__LINE__);

# check for the total number of question

	$queryTotal  = "SELECT * FROM `questions`";
	$resultTotal = $db->query($queryTotal) or die($db->error.__LINE__);
	$total		 = 	$resultTotal->num_rows;	

?>
 
 
 Question <?php echo $question['q_num'].'/'.$total.' <br>';?>
<?php echo $question['q_text']; ?>
 <form method="post" action="process.php">
 <ul>
 <?php while($row = $choices->fetch_assoc()): ?>
	<li><input name="choice" type="radio" value="<?php echo $row['id'];?>" /><?php echo $row['c_text'];?></li>
 <?php endwhile;?>
 </ul>
 <input type="submit" value="submit" name="submit" />
 <input type="hidden" value="<?=$number;?>" name="num" />
 </form>