<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Upload Video</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
		<?php require ('dbconn.php'); ?>
	</head>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>

<body>

    <div class="row-fluid">
        <div class="span12">
            <div class="container">
		<br>
		<br>
				<form method="post" enctype="multipart/form-data" >
						<?php
							if(isset($_FILES['file'])){
							
								$name = $_FILES['file']['name'];
								$extension = explode('.', $name);
								$extension = end($extension);
								$type = $_FILES['file']['type'];
								$size = $_FILES['file']['size'] /1024/1024;
								$random_name = rand();
								$tmp = $_FILES['file']['tmp_name'];
								
								
								if ((strtolower($type) != "video/mpg") && (strtolower($type) != "video/wma") && (strtolower($type) != "video/mov") 
								&& (strtolower($type) != "video/flv") && (strtolower($type) != "video/mp4") && (strtolower($type) != "video/avi") 
								&& (strtolower($type) != "video/qt") && (strtolower($type) != "video/wmv") && (strtolower($type) != "video/wmv")
								&& (strtolower($type) != "video/3gpp")&& (strtolower($type) != "audio/mp3"))
								{
									$message= "Video Format Not Supported !";

								}else
								{
									move_uploaded_file($tmp, 'upload/'.$random_name.'.'.$extension);	
									$conn->query("insert into videos (title,location) values ('$name','$random_name.$extension')");
									$message="Video Uploaded Successfully!";
								}
								
								?>
								<?php
								echo "<script type='text/javascript'>alert('$message\\n\\nUpload: $name\\nSize: $size\\nType: $type\\nStored in: uploads/$name');</script>";
								?>
								
								<?php
							}
					
						?>
	
					<h4> Select a Video : </h4>
					<input name="UPLOAD_MAX_FILESIZE" value="20971520"  type="hidden"/>
					<input type="file" name="file" id="file" />
					
					<input type="submit" value="Click to Upload" />
			</form>
			
			<hr>
			
	       <!-- List of Videos -->
				<h4>List of Videos:</h4>
		 
		   
					<ul>
							<?php
								$query = $conn->query("SELECT * FROM videos");
								while($row = $query->fetch()){
								$video_id = $row['video_id'];
							?>
							
								Click to Watch ---><a href="#Video_Modal<?php echo $video_id; ?>" data-toggle="modal"><?php echo $row['title'];?> </a><br>
							<?php include ('video_modal.php'); ?>
							<?php
							} 
							?>
					</ul>
          
        </div>
        </div>
        </div>
    



</body>
</html>


