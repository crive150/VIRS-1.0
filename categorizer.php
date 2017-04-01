<?php require_once('Connections/sql.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sql, $sql);
$query_awl = "SELECT word FROM awl ORDER BY word ASC";
$awl = mysql_query($query_awl, $sql) or die(mysql_error());
$row_awl = mysql_fetch_assoc($awl);
$totalRows_awl = mysql_num_rows($awl);

mysql_select_db($database_sql, $sql);
$query_lo = "SELECT word FROM lo ORDER BY word ASC";
$lo = mysql_query($query_lo, $sql) or die(mysql_error());
$row_lo = mysql_fetch_assoc($lo);
$totalRows_lo = mysql_num_rows($lo);

mysql_select_db($database_sql, $sql);
$query_med = "SELECT word FROM awl ORDER BY word ASC";
$med = mysql_query($query_med, $sql) or die(mysql_error());
$row_med = mysql_fetch_assoc($med);
$totalRows_med = mysql_num_rows($med);

mysql_select_db($database_sql, $sql);
$query_hi = "SELECT word FROM awl ORDER BY word ASC";
$hi = mysql_query($query_hi, $sql) or die(mysql_error());
$row_hi = mysql_fetch_assoc($hi);
$totalRows_hi = mysql_num_rows($hi);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Categorize Demo</title>
</head>

<body>
<p><strong>Categorize Demo</strong></p>
<p>Output:</p>
<p><?php

	
	//get input
	ob_start();
	echo $_POST['input'];
	$out = ob_get_contents();
	ob_end_clean();
	
	
	//get awl
	ob_start();
	
		do { echo $row_awl['word']; }
   		while (	$row_awl = mysql_fetch_assoc($awl)	);
   
	$awl = ob_get_contents();
	ob_end_clean();
	
	//get lo
	ob_start();
	
		do { echo $row_lo['word']; }
   		while (	$row_lo = mysql_fetch_assoc($awl)	);
   
	$lo = ob_get_contents();
	ob_end_clean();
	
	//get med
	ob_start();
	
		do { echo $row_med['word']; }
   		while (	$row_med = mysql_fetch_assoc($awl)	);
   
	$med = ob_get_contents();
	ob_end_clean();
	
	
	//get hi
	ob_start();
	
		do { echo $row_hi['word']; }
   		while (	$row_hi = mysql_fetch_assoc($awl)	);
   
	$hi = ob_get_contents();
	ob_end_clean();
	
	
		//flags
		$a = false;
		$l = false;
		$m = false;
		$h = false;
		
		
		$atok = strtok($awl, " ");
		$tok = strtok($out, " ");

		//horrible quadratic complexity, times out after 30 seconds 
		/*while($awl !== false) {
			while($tok !== false) {
			
				if($awl == $tok){
					$a = true;
					break;	
					$tok = strtok(" "); }
			}
			$awl = strtok(" ");
			
			break;
		} */
		
		
		
	
	 
	$tok = strtok($out, " ");
	$regex = "/\b" + "$tok" + "@";
	//$regex = "/\b("+ $tok + ")#";
	
	while($tok !== false) {
		
		
		
		
		
		if (strpos($awl, $tok)){
 				echo "<font color = \"yellow\">$tok </font>";
		}
		 else {
		
		echo "$tok " ; }
		
		
		$tok = strtok(" ");
	}
	
	
	
	


  ?>

</p>

<p>Input:</p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="input"></label>
    <textarea name="input" cols="64" rows="16" id="input"><?php echo $_POST['input']; ?></textarea>
  </p>
  <p>
    <input name="AWL" type="checkbox" id="AWL" checked="checked" />
    <label for="AWL">AWL</label>
  </p>
  <p>
    <input type="checkbox" name="lo" id="lo" />
    <label for="lo">Low Frequency</label>
  </p>
  <p>
    <input type="checkbox" name="med" id="med" />
    <label for="med">Medium  Frequency</label>
  </p>
  <p>
    <input name="hi" type="checkbox" id="hi" checked="checked" />
    <label for="hi">High Frequency</label>
  </p>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Categorize" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php

mysql_free_result($awl);

mysql_free_result($lo);

mysql_free_result($med);

mysql_free_result($hi);
?>
