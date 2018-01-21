<?php
//start session
session_start();

if(isset($_POST['submit'])){
    if(!empty($_POST['type']) && !empty($_POST['title']) && !empty($_POST['content'])){
        //Include database configuration file
        require_once 'dbConfig.php';
        
        //Insert email template data
        $type = $db->real_escape_string($_POST['type']);
        $title = $db->real_escape_string($_POST['title']);
        $content = $db->real_escape_string($_POST['content']);
        $dataTime = date("Y-m-d H:i:s");
        
        $insert = $db->query("INSERT into email_templates (type, title, content, created, modified, status) VALUES ('$type', '$title', '$content', '$dataTime', '$dataTime', '1')");
        if($insert){
            $_SESSION['status'] = 'succ';
            $_SESSION['msg'] = 'Email template has been created successfully.';
        }else{
            $_SESSION['status'] = 'err';
            $_SESSION['msg'] = 'Some problem occurred, please try again.';
        }
    }else{
        $_SESSION['status'] = 'err';
        $_SESSION['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
}
header("Location: add-template.php");
?>