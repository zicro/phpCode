<?php
	 
#################### Begin Code 2 Print Name into Certif With Arabic Version
//error_reporting(E_STRICT);

function output_image ( $image_file ) {
   // header("Content-type: image/jpeg");
	header('Content-Type: application/octet-stream'); // change this will work for you.

    header('Content-Length: ' . filesize($image_file));
    ob_clean();
    flush();
    readfile($image_file);
}

function output_img($file){
	
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ext = pathinfo($file, PATHINFO_EXTENSION);
$basename = pathinfo($file, PATHINFO_BASENAME);

header("Content-type: application/".$ext);
// tell file size
header('Content-length: '.filesize($file));
// set file name
header("Content-Disposition: attachment; filename=\"$basename\"");
readfile($file);
// Exit script. So that no useless data is output.
header("Location: certificats.php");
}


if(isset($_POST['get']) && !empty($_POST['name'])){
	

// Set the content-type
//header("Content-type: image/jpeg");

// Create the image
$certifTitle = "img/certif_.jpg";
$im = @ImageCreateFromJPEG("img/card.jpg");

// Create some colors
$black = imagecolorallocate($im, 55, 75, 95);
$blue  = imagecolorallocate($im, 0, 0, 255);
$white = imagecolorallocate($im, 255, 255, 255);

// Replace by your own font full path and name
$path = substr(
    $_SERVER['SCRIPT_FILENAME'], 0, 
    strrpos($_SERVER['SCRIPT_FILENAME'], '/')
);
$font = $path.'/GD/ae_AlHor.ttf';


require 'Arabic.php';
$Arabic = new I18N_Arabic('Glyphs');

$text = $_POST['name'];
$text = $Arabic->utf8Glyphs($text);
//$name = $Arabic->utf8Glyphs("test");
//$level = $Arabic->utf8Glyphs("level");


//imagettftext($im, 20, 0, 10, 100, $blue, $font, 'Arabic Glyphs:');
//imagettftext($im, 14, 0, 680, 190, $black, $font, $name);
//imagettftext($im, 20, 0, 505, 190, $black, $font, $level);


//imagettftext($im, 20, 0, 680, 590, $black, $font, $idCert);
//imagettftext($im, 80, 0, 640, 550, $black, $font, $name);
imagettftext($im, 35, 0, 450, 980, $black, $font, $text);








// Using imagepng() results in clearer text compared with imagejpeg()
//imagepng($im);
//imagedestroy($im);
imagejpeg($im,$certifTitle,100);
			 
			 #################### End Code 2 Print Name into Certif With Arabic Version


	 //echo $certifTitle;

//output_image($certifTitle);


output_img($certifTitle);
         
}
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تهنئة عيد الأضحى المبارك</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
<style>
#canvas{display: none;}
@font-face {
  font-family: myFirstFont;
  src: url(GD/ae_AlHor.ttf);
}
body{
	font-family: myFirstFont;
}
</style>
</head>
<body style="background-color: #ffffff">
<div class="container" align="center">
	<div class="row">
    <div class="box" align="center" style="background-image: url('img/card_bg.jpg') ;     height: 670px;
    background-repeat: no-repeat;
    background-position:  center;     padding-top: 1px;">
        <img src="images/covered.png" class="img-responsive" alt="Header" style="max-width: 282px ; display:none ;margin-top: 108px">

       <div style="padding-top: 30em; ">
           <div class="center">
               <div style=" font-size: 25px; margin-top: 10px; color:#383838">تحميل تهنئة العيد</div>
           </div>

           <div class="row" >
<form method = "post" action="certificats.php">
               <div class=" col-md-4"></div>
               <div class=" col-md-4">

                   <input type="text" name="name" id="textbox" class="form-control"
                          style="width: 100%; margin-top: 8px; direction: rtl; color:#3b3b3b" placeholder="الاسم"
                          required="required">
               </div>
               <div class="col-md-4"></div>
           </div>
           <div class="row">
               <div class="col-md-4"></div>
               <div class="col-md-4">
                   <button type="submit" name="get" id="capture" class="btn btn-primary btn-lg"
                           style="width: 100%; margin-top: 8px; color:#3b3b3b">تحميل التهنئة
                   </button>
               </div>
               <div class="col-md-4"></div>
</form>
           </div>

       </div>


        
    </div>
</div>
</div>


</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- this script helps us to capture any div -->

</html>




