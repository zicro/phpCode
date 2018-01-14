<?php
//include pagination class file
include_once 'Pagination.class.php';

//include database configuration file
include_once 'dbConfig.php';

$limit = 5;
$offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;

//get number of rows
$queryNum = $db->query("SELECT COUNT(*) as postNum FROM users");
$resultNum = $queryNum->fetch_assoc();
$rowCount = $resultNum['postNum'];

//initialize pagination class
$pagConfig = array(
    'baseURL'=>'http://localhost/phpcode/Pagination/index.php',
    'totalRows'=>$rowCount,
    'perPage'=>$limit
);
$pagination =  new Pagination($pagConfig);

//get rows
$query = $db->query("SELECT * FROM users ORDER BY id DESC LIMIT $offset,$limit");

if($query->num_rows > 0){ ?>
    <div class="posts_list">
    <?php while($row = $query->fetch_assoc()){ ?>
        <div class="list_item"><a href="javascript:void(0);"><?php echo $row["first_name"]; ?></a></div>
    <?php } ?>
    </div>
    <!-- display pagination links -->
    <?php echo $pagination->createLinks(); ?>
<?php } ?>