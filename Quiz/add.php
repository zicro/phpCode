<?php
include 'db.php';

	if(isset($_POST['submit'])){
		#Get the Post variables :
		$question_number = $_POST['q_num']; 
		$question_text	 = $_POST['q_text']; 
		$correct_choice	 = $_POST['Correct_choice']; 
		# choices Array
		$choices = array($_POST['choice1'],
						 $_POST['choice2'],
						 $_POST['choice3'],
						 $_POST['choice4'],
						 $_POST['choice5']);
		# Question Query
		$Qquery = "INSERT INTO `questions`(q_num, q_text)
					VALUES($question_number,'$question_text')";
		# Run Query
		$insert_row = $db->query($Qquery) or die($db->error.__LINE__);
		
		# Validate insert_row
			if($insert_row){
				foreach($choices as $choice => $value){
					if($value != ''){
						# we add +1 because the array start from indice 0
						if($correct_choice == $choice+1){
							$is_correct = 1;
						}else{
							$is_correct = 0;
						}
						# Choice Query
						$Cquery = "INSERT INTO `choice`(q_num, is_correct, c_text)
									VALUES($question_number, $is_correct, '$value')";
						
						# Run Query
						$insert_row = $db->query($Cquery) or die($db->error.__LINE__);
						
						# Validate insert
						if($insert_row){
							continue;
						}else{
							die('Error ('.$db->errno.')'.$db->error);
						}
					}
				}
				$msg = "Data was Added succsfully !!";
			}
	}
	
	# check for the total number of question

	$queryTotal  = "SELECT * FROM `questions`";
	$resultTotal = $db->query($queryTotal) or die($db->error.__LINE__);
	$total		 = 	$resultTotal->num_rows;	
?> 
 
 <h2>Add a questions</h2>
 <?php
	if(isset($msg)){
		echo "<pre>".$msg."</pre>";
	}
 ?>
 <form method="post" action="add.php">
	 <p>
		<label>Question Number: </label>
		<input type="number" name="q_num" value="<?=$total+1;?>" />
	 </p>
	 <p>
		<label>Question text: </label>
		<input type="text" name="q_text" />
	 </p>
	<p>
		<label>Choice #1: </label>
		<input type="text" name="choice1" />
	 </p>
	<p>
		<label>Choice #2: </label>
		<input type="text" name="choice2" />
	 </p>
	 <p>
		<label>Choice #3: </label>
		<input type="text" name="choice3" />
	 </p>
	 <p>
		<label>Choice #4: </label>
		<input type="text" name="choice4" />
	 </p>
	 <p>
		<label>Choice #5: </label>
		<input type="text" name="choice5" />
	 </p>
	 <p>
		<label>Correct Choice Number: </label>
		<input type="number" name="Correct_choice" />
	 </p>
	 <p>
		<input type="submit" name="submit" />
	 </p>
 </form>