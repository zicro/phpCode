<?php
if (isset($_POST['Convert'])){

$am    = urlencode($_POST['amount']);
$from  = urlencode($_POST['from']);
$to    = urlencode($_POST['to']);


echo Currency($am, $from, $to);
}

//echo Currency("222", "USD", "MAD");


function Currency($amount, $from, $to){
//$url = "http://www.google.com/ig/calculatoe?q=$amount$from=?$to";
//$url = "https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to";

      $data = file_get_contents("http://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
      preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
      $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
      return number_format(round($converted, 3),2);
}

?>
<form action="index.php" method="post">
<input type="text" name="amount" />
FROM : <select name="from">
  <option value="MAD">MAD</option>
  <option value="EGP">EGP</option>
  <option value="USD">USD</option>
</select>
To : <select name="to">
  <option value="USD">USD</option>
  <option value="EGP">EGP</option>
  <option value="MAD">MAD</option>
</select>
<input type="submit" value="Convert"  name="Convert" />
</form>
