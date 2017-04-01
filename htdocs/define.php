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

$colname_results = "-1";
if (isset($_GET['word'])) {
  $colname_results = $_GET['word'];
}
mysql_select_db($database_sql, $sql);
$query_results = sprintf("SELECT * FROM dict WHERE word = %s", GetSQLValueString($colname_results, "text"));
$results = mysql_query($query_results, $sql) or die(mysql_error());
$row_results = mysql_fetch_assoc($results);
$totalRows_results = mysql_num_rows($results);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Definition for  word <em><strong><?php echo $row_results['word']; ?></strong></em> <?php echo $row_results['wordtype']; ?></p>
<p>&quot;<?php echo $row_results['definition']; ?>&quot;</p>
<div align="center">
<p><a href="javascript:history.back()">Go back</a> &nbsp; &nbsp;<a href="close.php">Close</a> <a href="javascript:history.back()"></a></p></div>
</body>
</html>
<?php
mysql_free_result($results);
?>
