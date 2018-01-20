<?php
session_start();
?>
 <h2>You are all Done</h2>
 <p>Congrats : you Score is : <?=$_SESSION['score']; ?></p>
 <a href="question.php?n=1">Take Again</a>
 <?php
 $_SESSION['score'] = 0;
 ?>