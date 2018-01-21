<?php
//start session
session_start();

if(!empty($_SESSION['status'])){
    //get status from session
    $status = $_SESSION['status'];
    $msg = $_SESSION['msg'];
    
    //remove status from session
    unset($_SESSION['status']);
    unset($_SESSION['msg']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dynamic Email Template Management System using PHP & MySQL by CodexWorld</title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
    <?php
    if(!empty($status) && $status == 'succ'){
        echo '<p style="color: green;">'.$msg.'</p>';
    }elseif(!empty($status) && $status == 'err'){
        echo '<p style="color: red;">'.$msg.'</p>';
    }
    ?>
    <form method="post" action="templateSubmit.php">
        <p>
            Type:
            <select name="type">
                <option value="contact_us">Contact Us</option>
                <option value="registration">Registration</option>
            </select>
        </p>
        <p>
            Title: <input type="text" name="title" />
        </p>
        <p>
            Content: <textarea name="content"></textarea>
        </p>
        <p>Available Variables: [SITE_URL] [SITE_NAME] [USER_NAME] [USER_EMAIL]</p>
        <p>
            <input type="submit" name="submit" value="Add Template">
        </p>
    </form>
</body>
</html>