<?php
include 'inc/header.php';
include 'lng.php';
// Turn off error reporting
error_reporting(0);

include '../../inc/DB.php';
$db = new DB();
$tblName = 'level';
$tblName2 = 'certif';
$tblName6 = 'studentexam';

//$conditions['where'] = array('id'=>$id);

$levels  	= $db->getRows($tblName);
$certifs  	= $db->getRows($tblName2);


if(isset($_POST) && $_POST != NULL){
	
	
	// Define UploadFile variables 
	$targetDir = "../certif/";
	$fileName = $_FILES['img']['name'];
	$targetFile = $targetDir.$fileName;
	// insert data to DB
	$certifData = array(
                    'description'	 => $_POST['description'],
                    'img' 		     => $fileName,
                    'level'			 => $_POST['level']
                );
                $insert = $db->insert($tblName2,$certifData);
                if($insert){
                    $data['data'] = $insert;
                    $data['status'] = 'OK';
                    $data['msg'] = 'تمت الإضافة بنجاح';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'حدث هناك خطأ .. يرجى إعادة المحاولة';
                }
	
	// move img into img folder

	if(move_uploaded_file($_FILES['img']['tmp_name'],$targetFile)){
		echo $data['msg']."<meta http-equiv='refresh' content='2; url=certif.php' />";
	}
	  
	  
}
	
	#Delete Data from link Click
	
	if (isset($_REQUEST) && $_REQUEST != NULL && $_REQUEST['del'] == 'certif') {
		$id = (int)$_GET['id'];
		
		$conditiondel = array('id' => $id);
        $delete = $db->delete($tblName2,$conditiondel);
                if($delete){
                    $data['status'] = 'OK';
                    $data['msg'] = 'تمت عملية الحذف';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'حدث هناك خطأ .. يرجى إعادة المحاولة';
                }

      
			echo  $data['msg']."<meta http-equiv='refresh' content='2; url=certif.php' />";
  }
#End Delete Data from link Click

  
   # Data Certif from link Click table studyTeacher
	
	if (isset($_REQUEST) && $_REQUEST != NULL && $_REQUEST['certif'] == 'done') {
		$id 	 	= (int)$_GET['id'];
		$idLevel 	= (int)$_GET['l'];
		$idStudent 	= (int)$_GET['s'];
		$certifTitle = "../certif/certif_".$id."_".$idLevel."_".$idStudent.".jpg";
		// update from StudentExam tables
		$stdExamData = array(
                    'getCertif'	  => 1,
					'CertifTitle' => $certifTitle);
					
		$conditionCertif = array('id' => $id);
        $update = $db->update($tblName6, $stdExamData, $conditionCertif);
		// create Student name in the certif and rename the certif 
		// with this name(idStudent_idLevel)
		
		//get Student Name from his id
		$conditionStudent['where'] = array('id'=>$idStudent);
									$Student = $db->getRows('users', $conditionStudent);
		
		// get the certif Level path
		$conditionCertif['where'] = array('level'=>$idLevel);
									$certifs = $db->getRows('certif', $conditionCertif);
									//echo "<a href='../certif/".$certifs[0]['img']."' download>تحميل</a>";
			######### get the Level Name From Id
			$conditionLevel['where'] = array('id'=>$idLevel);
									$level = $db->getRows('level', $conditionLevel);
			#### Calcul ta9dir l 3am
			$conditionNoteGeneral['where'] = array('idStudent'=>$idStudent);
									$notegeneral = $db->getRows($tblName6, $conditionNoteGeneral);
							
							$i=0;
							//print_r($notegeneral);
							foreach($notegeneral as $noteg=>$ng){
								$ngs = $ngs+$ng['degreeExam'];
								$i++;
							}
							$noteall = $ngs/$i;
							if($noteall <= 30){
								$dgr = word2uni('ضعيف');
							}else if($noteall > 30 && $noteall<= 60){
								$dgr = word2uni('متوسط');
							}else if($noteall > 60 && $noteall<= 80){
								$dgr = word2uni('جيد');
							}else if($noteall > 80){
								$dgr = word2uni('ممتاز');
							}
							
									
			 ##### Begin Code Print Name into Certif
								 //Carregar imagem
								 //echo "../certif/".$certifs[0]['img'];
					//$rImg = ImageCreateFromJPEG("../certif/".$certifs[0]['img']);
					 
					//Definir cor
					//$cor = imagecolorallocate($rImg, 25, 25, 0);
					 
					 //$font = 'arial.ttf';
					//Escrever nome
					//imagestring($rImg,14,6,30,urldecode($Student[0]['name']),$cor);
					//imagestring($rImg,14,680,183,urldecode($Student[0]['name']),$cor);
					//imagestring($rImg,14,495,183,urldecode($level[0]['name']),$cor);
					//imagestring($rImg,14,295,183,urldecode($dgrs),$cor);
					 
					//Header e output
					//header('Content-type: image/jpeg');
					//imagejpeg($rImg,$certifTitle,100);
			 ##### End Code Print Name into Certif
			 #################### Begin Code 2 Print Name into Certif With Arabic Version
//error_reporting(E_STRICT);

// Set the content-type
//header("Content-type: image/jpeg");

// Create the image
$im = @ImageCreateFromJPEG("../certif/".$certifs[0]['img']);

// Create some colors
$black = imagecolorallocate($im, 0, 0, 0);
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

$text = 'بسم الله الرحمن الرحيم';
$text = $Arabic->utf8Glyphs($text);
$name = $Arabic->utf8Glyphs($Student[0]['name']);
$level = $Arabic->utf8Glyphs($level[0]['name']);
$degre = $Arabic->utf8Glyphs($dgr);

//imagettftext($im, 20, 0, 10, 100, $blue, $font, 'Arabic Glyphs:');
imagettftext($im, 14, 0, 680, 190, $black, $font, $name);
imagettftext($im, 20, 0, 505, 190, $black, $font, $level);
imagettftext($im, 20, 0, 300, 190, $black, $font, $dgr);
######## Prepare to Print Arabic Date
date_default_timezone_set('GMT+3');
$time = time();
$Arabic2 = new I18N_Arabic('Date');
$Arabic2->setMode(8);
//$date =  $Arabic2->date('l dS F Y j', $time, $correction);
$day =  $Arabic2->date('j', $time, $correction);
$day = $Arabic->utf8Glyphs($day);
imagettftext($im, 14, 0, 798, 480, $black, $font, $day);

$year =  $Arabic2->date('Y', $time, $correction);
//$year = $Arabic->utf8Glyphs($year);
$Arabic3 = new I18N_Arabic('Transliteration');
$year = $Arabic3->arNum($year);
imagettftext($im, 11, 0, 710, 480, $black, $font, $year);

$month =  $Arabic2->date('F', $time, $correction);
//$month = $Arabic3->en2ar($month);
//$month = $Arabic->utf8Glyphs($month);
// chng the month from english words to arabic
if(strcmp($month, 'Muḥarram') == 0){
	$month = $Arabic->utf8Glyphs('مُحَرَّم');
}else if(strcmp($month, 'Ṣafar') == 0){
	$month = $Arabic->utf8Glyphs('صَفَر');
}else if(strcmp($month, 'Rabī‘ al-awwal') == 0){
	$month = $Arabic->utf8Glyphs('رَبيع الأوّل');
}else if(strcmp($month, 'Rabī‘ ath-thānī') == 0){
	$month = $Arabic->utf8Glyphs('رَبيع الثاني');
}else if(strcmp($month, 'Jumādá al-ūlá') == 0){
	$month = $Arabic->utf8Glyphs('جُمادى الأولى');
}else if(strcmp($month, 'Jumādá al-ākhirah') == 0){
	$month = $Arabic->utf8Glyphs('جُمادى الآخرة');
}else if(strcmp($month, 'Rajab') == 0){
	$month = $Arabic->utf8Glyphs('رجب');
}else if(strcmp($month, 'Sha‘bān') == 0){
	$month = $Arabic->utf8Glyphs('شَعْبان');
}else if(strcmp($month, 'Ramaḍān') == 0){
	$month = $Arabic->utf8Glyphs('رَمَضان');
}else if(strcmp($month, 'Shawwāl') == 0){
	$month = $Arabic->utf8Glyphs('شَوّال');
}else if(strcmp($month, 'Dhū al-Qa‘dah') == 0){
	$month = $Arabic->utf8Glyphs('ذو القعدة');
}else if(strcmp($month, 'Dhū al-Ḥijjah') == 0){
	$month = $Arabic->utf8Glyphs('ذو الحجة');
}
imagettftext($im, 12, 0, 760, 480, $black, $font, $month);
// number of certif
$idCert = $Arabic3->arNum($id);
imagettftext($im, 20, 0, 680, 590, $black, $font, $idCert);

// Feel the table
#nisba l3ama pecentage
$gnrScore = $Arabic3->arNum($noteall);
imagettftext($im, 20, 0, 170, 425, $black, $font, $gnrScore);
#nisba l3ama ta9dir
imagettftext($im, 20, 0, 170, 385, $black, $font, $dgr);

######################### Begin Tajwid

// tajwid nadari
if($notegeneral[0]['degreeExam'] <= 30){
								$dgrTilawa = 'ضعيف';
							}else if($notegeneral[0]['degreeExam'] > 30 && $notegeneral[0]['degreeExam']<= 60){
								$dgrTilawa = 'متوسط';
							}else if($notegeneral[0]['degreeExam'] > 60 && $notegeneral[0]['degreeExam']<= 80){
								$dgrTilawa = 'جيد';
							}else if($notegeneral[0]['degreeExam'] > 80){
								$dgrTilawa = 'ممتاز';
							}
$dgrTilawa = $Arabic->utf8Glyphs($dgrTilawa);
imagettftext($im, 20, 0, 320, 385, $black, $font, $dgrTilawa);
// tajwid nadari Percent
$ntTilawa = $Arabic3->arNum($notegeneral[0]['degreeExam']);
imagettftext($im, 20, 0, 320, 425, $black, $font, $ntTilawa);

// tajwid tatbi9i
if($notegeneral[1]['degreeExam'] <= 30){
								$dgrTilawa2 = 'ضعيف';
							}else if($notegeneral[1]['degreeExam'] > 30 && $notegeneral[1]['degreeExam']<= 60){
								$dgrTilawa2 = 'متوسط';
							}else if($notegeneral[1]['degreeExam'] > 60 && $notegeneral[1]['degreeExam']<= 80){
								$dgrTilawa2 = 'جيد';
							}else if($notegeneral[1]['degreeExam'] > 80){
								$dgrTilawa2 = 'ممتاز';
							}
$dgrTilawa2 = $Arabic->utf8Glyphs($dgrTilawa2);
imagettftext($im, 20, 0, 400, 385, $black, $font, $dgrTilawa2);
// tajwid tatbi9i Percent
$ntTilawa2 = $Arabic3->arNum($notegeneral[1]['degreeExam']);
imagettftext($im, 20, 0, 420, 425, $black, $font, $ntTilawa2);
######################### End Tajwid


######################### Begin Quran

// Quran 7ifd
if($notegeneral[2]['degreeExam'] <= 30){
								$dgrTilawa3 = 'ضعيف';
							}else if($notegeneral[2]['degreeExam'] > 30 && $notegeneral[2]['degreeExam']<= 60){
								$dgrTilawa3 = 'متوسط';
							}else if($notegeneral[2]['degreeExam'] > 60 && $notegeneral[2]['degreeExam']<= 80){
								$dgrTilawa3 = 'جيد';
							}else if($notegeneral[2]['degreeExam'] > 80){
								$dgrTilawa3 = 'ممتاز';
							}
$dgrTilawa3 = $Arabic->utf8Glyphs($dgrTilawa3);
imagettftext($im, 20, 0, 500, 385, $black, $font, $dgrTilawa3);
// Quran 7ifd Percent
$ntTilawa3 = $Arabic3->arNum($notegeneral[2]['degreeExam']);
imagettftext($im, 20, 0, 510, 425, $black, $font, $ntTilawa3);

// Quran tilawa
if($notegeneral[3]['degreeExam'] <= 30){
								$dgrTilawa4 = 'ضعيف';
							}else if($notegeneral[3]['degreeExam'] > 30 && $notegeneral[3]['degreeExam']<= 60){
								$dgrTilawa4 = 'متوسط';
							}else if($notegeneral[3]['degreeExam'] > 60 && $notegeneral[3]['degreeExam']<= 80){
								$dgrTilawa4 = 'جيد';
							}else if($notegeneral[3]['degreeExam'] > 80){
								$dgrTilawa4 = 'ممتاز';
							}
$dgrTilawa4 = $Arabic->utf8Glyphs($dgrTilawa4);
imagettftext($im, 20, 0, 600, 385, $black, $font, $dgrTilawa4);
// Quran tilawa Percent
$ntTilawa4 = $Arabic3->arNum($notegeneral[3]['degreeExam']);
imagettftext($im, 20, 0, 610, 425, $black, $font, $ntTilawa4);
######################### End Quran



// Using imagepng() results in clearer text compared with imagejpeg()
//imagepng($im);
//imagedestroy($im);
imagejpeg($im,$certifTitle,100);
			 
			 #################### End Code 2 Print Name into Certif With Arabic Version
		
                if($update){
                    $data['status'] = 'OK';
                    $data['msg'] = 'تم اصدار الشهادة بنجاح';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'حدث هناك خطأ .. يرجى إعادة المحاولة';
                }

      
			echo  $data['msg']."<meta http-equiv='refresh' content='2; url=certif.php' />";
  }
  #End  Data Certif from link Click

?>
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0" style="font-family: myFirstFont;">خيارات الشهادات</h3>
                        
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
<div id="accordion">
  <div class="card alignRight">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         إضافة شهادة
        </button>
		<button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
         إصدار شهادة
        </button>
		<button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
         إصدار شهادة تجريبي
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form class="form-horizontal form-material" action="certif.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">عنوان الشهادة</label>
                                        <div class="col-md-12">
                                            <input type="text"  class="form-control form-control-line" name="description">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">صورة الشهادة</label>
                                        <div class="col-md-12">
										<input type="file"  class="form-control form-control-line" name="img">
                                            
                                        </div>
                                    </div>
                                   
                                     <div class="form-group">
                                        <label class="col-sm-12">المستوى</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="level">
											<?php
											foreach($levels as $level=>$val){
											?>
											<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
											<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">إضافة شهادة</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
      </div>
    </div>
<!-- Begin Menu 2 -->
<div id="collapse2" class="collapse hide" aria-labelledby="heading2" data-parent="#accordion">
      <div class="card-body">
        <!-- column -->
                    <div class="col-sm-12" style="overflow: auto; max-height: 500px;">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">طلاب بإنتظار إصدار الشهادات</h4>
                                
							   <div class="table-responsive">
								 <table class="table">
									<thead>
									<tr>
									  <td>#</td>
									  <td>اسم الطالب</td>
									  <td>المستوى</td>
									  <td>عنوان الشهادة</td>
									  <td>خيارات</td>
									</tr>
								  </thead>
								  <tbody>
									<?php
											$conditionstdEx['where'] = array('getCertif'=>0, 'isCertif'=>0);
											$stdntExams 		= $db->getRows($tblName6, $conditionstdEx);
											foreach($stdntExams as $stdntExam=>$certified){
											?>
									<tr>
									<td><?php echo $certified['id']; ?></td>
									<td><?php 
									
									// get the student name
									
									$conditionUser['where'] = array('id'=>$certified['idStudent']);
									$Users = $db->getRows('users', $conditionUser);
									echo $Users[0]['name']; 
									
									?></td>
									<td><?php 
									// get the Level
									
									$conditionLevel['where'] = array('id'=>$certified['idLevel']);
									$levls = $db->getRows('level', $conditionLevel);
									echo $levls[0]['name']; 
									
									?></td>
									<td><?php 
									//get the certif name
									$conditionCertif['where'] = array('level'=>$certified['idLevel']);
									$Cert = $db->getRows('certif', $conditionCertif);
									echo $Cert[0]['description']; 
									
									?></td>
									<td>
									<a href="?certif=done&id=<?php echo $certified['id'];?>&l=<?php echo $certified['idLevel']; ?>&s=<?php echo $certified['idStudent']; ?>" title="إصدار" onclick="return confirm('تأكيد ');"><i class="fa fa-check-circle-o m-r-10" aria-hidden="true"></i></a>
									
									</td>
									</tr>
									<?php } ?>
									  
									
								  </tbody>
								</table>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
    </div>
<!-- Begin Menu 2 -->
<!-- Begin Menu 3 -->
<div id="collapse3" class="collapse hide" aria-labelledby="heading3" data-parent="#accordion">
      <div class="card-body">
        <!-- column -->
                    <div class="col-sm-12" style="overflow: auto; max-height: 500px;">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">طلاب بإنتظار إصدار الشهادات</h4>
                                
							   <div class="table-responsive">
								 <table class="table">
									<thead>
									<tr>
									  <td>#</td>
									  <td>اسم الطالب</td>
									  <td>المستوى</td>
									  <td>عنوان الشهادة</td>
									  <td>خيارات</td>
									</tr>
								  </thead>
								  <tbody>
									<?php
											$conditionstdEx['where'] = array('getCertif'=>0, 'isCertif'=>1);
											$stdntExams 		= $db->getRows($tblName6, $conditionstdEx);
											foreach($stdntExams as $stdntExam=>$certified){
											?>
									<tr>
									<td><?php echo $certified['id']; ?></td>
									<td><?php 
									
									// get the student name
									
									$conditionUser['where'] = array('id'=>$certified['idStudent']);
									$Users = $db->getRows('users', $conditionUser);
									echo $Users[0]['name']; 
									
									?></td>
									<td><?php 
									// get the Level
									
									$conditionLevel['where'] = array('id'=>$certified['idLevel']);
									$levls = $db->getRows('level', $conditionLevel);
									echo $levls[0]['name']; 
									
									?></td>
									<td><?php 
									//get the certif name
									$conditionCertif['where'] = array('level'=>$certified['idLevel']);
									$Cert = $db->getRows('certif', $conditionCertif);
									echo $Cert[0]['description']; 
									
									?></td>
									<td>
									<a href="?certif=done&id=<?php echo $certified['id'];?>" title="إصدار" onclick="return confirm('تأكيد ');"><i class="fa fa-check-circle-o m-r-10" aria-hidden="true"></i></a>
									
									</td>
									</tr>
									<?php } ?>
									  
									
								  </tbody>
								</table>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
    </div>
<!-- end Menu 3 -->
  </div>
</div>  

<div class="row">
                    <!-- column -->
                    <div class="col-sm-12" style="overflow: auto; max-height: 500px;">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">قائمة الشهادات</h4>
                                
							   <div class="table-responsive">
								 <table class="table">
									<thead>
									<tr>
									  <td>#</td>
									  <td>عنوان الشهادة</td>
									  <td>المستوى</td>
									  <td>خيارات</td>
									</tr>
								  </thead>
								  <tbody>
									
									<?php
										foreach($certifs as $certif=>$value){
									?>
									<tr>
									  <td><?php echo $value['id'];?></td>
									  <td><a href="../certif/<?php echo $value['img'];?>"><?php echo $value['description'];?></a></td>
									  <td><?php 
									  $conditions['where'] = array('id'=>$value['level']);

									  $levels2 = $db->getRows($tblName, $conditions);
									 
									  echo $levels2[0]['name'];?></td>
									<td>
									<a href="?del=certif&id=<?php echo $value['id'];?>" title="حذف" onclick="return confirm('تأكيد الحذف؟');"><i class="fa fa-trash-o m-r-10" aria-hidden="true"></i></a>
									
									</td>
									</tr>
									<?php } ?>
									  
									
								  </tbody>
								</table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
<?php
include 'inc/footer.php';
?>