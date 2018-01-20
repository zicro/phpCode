<?php
include 'db.php';
session_start();

# check for Score
	if(!isset($_SESSION['score'])){
		$_SESSION['score'] = 0;
	}

	
	if(isset($_POST['submit'])){
		$number 		 = $_POST['num'];
		$selected_choice = $_POST['choice'];
		$next 			 = $number+1;

# check for the total number of question

	$queryTotal  = "SELECT * FROM `questions`";
	$resultTotal = $db->query($queryTotal) or die($db->error.__LINE__);
	$total		 = 	$resultTotal->num_rows;	
		#Get Correct Choice
		
		$query = "SELECT * FROM `choice`
					WHERE q_num = $number AND is_correct = 1";
		# Get Result
		$result = $db->query($query) or die($db->error.__LINE__);
		
		# Get Row
		$row = $result->fetch_assoc();
		
		# Set correct choice
		$correct_choice = $row['id'];
		
		# Compare
			if($correct_choice == $selected_choice){
				// answer is correct, increase Score
				$_SESSION['score']++;
			}
		# check if it is the last question
			if($number == $total){
				header('Location: final.php');
				exit();
			}else{
				header("Location: question.php?n=".$next);
			}
	}
?>