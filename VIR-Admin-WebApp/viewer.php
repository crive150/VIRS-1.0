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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 15;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT freq, family FROM freq";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $sql) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$colname_results = "-1";
if (isset($_GET['family'])) {
  $colname_results = $_GET['family'];
}
mysql_select_db($database_sql, $sql);
$query_results = sprintf("SELECT * FROM freq WHERE family = %s", GetSQLValueString($colname_results, "text"));
$results = mysql_query($query_results, $sql) or die(mysql_error());
$row_results = mysql_fetch_assoc($results);
$totalRows_results = mysql_num_rows($results);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIRS Admin Panel v1.0</title>
</head>

<body >
<div align="center">
<p>VIRS Administration Panel v1.0</p>
<p><a href="index.php">Frequency Table</a></p>
<p><a href="./edit.php">Edit Data</a></p>
<p><a href="viewer.php">Wordlist Viewer</a></p>
<p><a href="dict.php">Dictionary</a><br />
  </p>
<p><br />
  <a href="awl.php" onclick="window.open(this.href, 'mywin',
'left=400,top=100,width=500,height=800,toolbar=0,scrollbars=1,resizable=0'); return false;">AWL</a><br  />
  <a href="lo.php" onclick="window.open(this.href, 'mywin',
'left=400,top=100,width=500,height=800,toolbar=0,scrollbars=1,resizable=0'); return false;">Low frequency</a><br />
  <a href="med.php" onclick="window.open(this.href, 'mywin',
'left=400,top=100,width=500,height=800,scrollbars=1,toolbar=0,resizable=0'); return false;">Medium frequency</a><br />
  <a href="hi.php" onclick="window.open(this.href, 'mywin',
'left=400,top=100,width=500,height=800,toolbar=0,scrollbars=1,resizable=0'); return false;">High frequency</a> </p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($results);
?>
