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
$atr = $_POST['atr']; //awl truncate flag
$aup = $_POST['aup']; //awl upload flag 
$ltr = $_POST['ltr'];
$lup = $_POST['lup'];
$mtr = $_POST['mtr'];
$mup = $_POST['mup'];
$htr = $_POST['htr'];
$hup = $_POST['hup'];
$ftr = $_POST['ftr'];
$fup = $_POST['fup'];


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	
	
	if($atr){
  $atrSQL = sprintf("TRUNCATE TABLE awl");} 
  
   if ($aup) {
	  $awlSQL = sprintf("LOAD DATA INFILE '../../htdocs/upload/awl.csv' INTO TABLE awl 
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
  LINES TERMINATED BY \"\r\n\"
  (word)");}
  
  
  
  if($ltr){
    $ltrSQL = sprintf("TRUNCATE TABLE lo"); } 
  
  if($lup){
	  $loSQL = sprintf("LOAD DATA INFILE '../../htdocs/upload/lo.csv' INTO TABLE lo 
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
  LINES TERMINATED BY \"\r\n\"
  (word)"); }
  
  
  
  if($mtr){
    $mtrSQL = sprintf("TRUNCATE TABLE med "); } 
  
  if($mup){
	  $medSQL = sprintf("LOAD DATA INFILE '../../htdocs/upload/med.csv' INTO TABLE med 
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
  LINES TERMINATED BY \"\r\n\"
  (word)"); }
  
  
  if($htr){
    $htrSQL = sprintf("TRUNCATE TABLE hi"); } 
  
  if($hup){  
 	 $hiSQL = sprintf("LOAD DATA INFILE '../../htdocs/upload/hi.csv' INTO TABLE hi 
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
  LINES TERMINATED BY \"\r\n\"
  (word)"); }
	  
	  
  
  //$freqSQL = sprintf("LOAD DATA INFILE '../../htdocs/upload/freq.csv' INTO TABLE freq 
  //FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
  //LINES TERMINATED BY \"\r\n\"
  //(word)");

  mysql_select_db($database_sql, $sql);
  
  if($atr) $Result01 = mysql_query($atrSQL, $sql) or die(mysql_error());

  if($aup) $Result1 = mysql_query($awlSQL, $sql) or die(mysql_error());
  
  if($ltr) $Result02 = mysql_query($ltrSQL, $sql) or die(mysql_error()); 
 
  if($lup) $Result2 = mysql_query($loSQL, $sql) or die(mysql_error());
  
  if($mtr) $Result03 = mysql_query($mtrSQL, $sql) or die(mysql_error());
  
  if($mup) $Result3 = mysql_query($medSQL, $sql) or die(mysql_error());
  
  if($htr) $Result04 = mysql_query($htrSQL, $sql) or die(mysql_error());
  
  if($hup) $Result4 = mysql_query($hiSQL, $sql) or die(mysql_error());
  
  //$Result5 = mysql_query($freqSQL, $sql) or die(mysql_error());
  
 sleep(3); //wait for the redirect, morty. they love the slow redirect. it really gets their dicks hard when they see the computer taking a little bit to do the upload. 
 //instantaneity makes people nervous
 
  $insertGoTo = "success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIRS Admin Access</title>
<style type="text/css">
#must {
	color: #F00;
	font-weight: bold;
}
</style>
</head>

<body>
<?php // this should never be seen by the user since the headers will be edited . . . ?>
<h1>Auto-magically updating MySQL database . . . (cross your fingers :D:D:D:D:D:p)</h1>

</body>
</html>