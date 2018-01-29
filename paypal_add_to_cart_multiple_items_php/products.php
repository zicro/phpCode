<?php
//Include db configuration file
include 'dbConfig.php';

//PayPal API URL
$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

//PayPal Business Email
$paypalID = 'omar@gmail.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PayPal Add to Cart for Multiple Items in PHP by CodexWorld</title>
<style>
.container{width: 100%;}
.proBox{width: 30%;float: left;}	
</style>
</head>
<body>
<h2>PayPal Add to Cart for Multiple Items in PHP by CodexWorld</h2>
<div class="container">
<?php
	//Fetch products from the database
	$results = $db->query("SELECT * FROM products");
	while($row = $results->fetch_assoc()){
?>
	<div class="proBox">
		<img src="images/<?php echo $row['image']; ?>"/>
		<p>Name: <?php echo $row['name']; ?></p>
		<p>Price: <?php echo $row['price']; ?></p>
		<form target="_self" action="<?php echo $paypalURL; ?>" method="post">
			<!-- Identify your business so that you can collect the payments. -->
			<input type="hidden" name="business" value="<?php echo $paypalID; ?>">
			
			<!-- Specify a PayPal Shopping Cart Add to Cart button. -->
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="add" value="1">
			
			<!-- Specify details about the item that buyers will purchase. -->
			<input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
			<input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
			<input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
			<input type="hidden" name="currency_code" value="USD">
			
			<!-- Specify URLs -->
			<input type='hidden' name='cancel_return' value='http://www.codexworld.com/cancel.php'>
			<input type='hidden' name='return' value='http://www.codexworld.com/success.php'>
			
			<!-- Display the payment button. -->
			<input type="image" name="submit"
			  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_addtocart_120x26.png"
			  alt="Add to Cart">
			<img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
		</form>
	</div>
<?php } ?>
</div>
</body>
</html>
