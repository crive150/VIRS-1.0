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

$colname_Recordset1 = "-1";
if (isset($_GET['family'])) {
  $colname_Recordset1 = $_GET['family'];
}
mysql_select_db($database_sql, $sql);
$query_Recordset1 = sprintf("SELECT * FROM freq WHERE family = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script language="javascript">

  function resizeVideoPage(){
    var width = 600;
    var height = 400;
    window.resizeTo(width, height);
    window.moveTo(((screen.width - width) / 2), ((screen.height - height) / 2));      
  }
</script>
<body onload="resizeVideoPage();">
<div align="center">
<p>Search results for &quot;<strong><?php echo $_GET['family']; ?></strong>&quot;</p>
<?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <p>No results found.  </p>
  <?php } // Show if recordset empty ?>
  <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <p>Family: <strong><?php echo $row_Recordset1['family']; ?></strong></p>
  <p>Frequency:<em> <?php echo $row_Recordset1['freq']; ?></em></p>
  <p>Variants: </p>
  <p><?php echo $row_Recordset1['member1']; ?> </p>
  <p><?php echo $row_Recordset1['member2']; ?>  </p>
  <p><?php echo $row_Recordset1['member3']; ?>  </p>
  <p><?php echo $row_Recordset1['member4']; ?></p>
  <?php } // Show if recordset not empty ?>
  </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
