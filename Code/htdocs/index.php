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
<p><a href="dict.php">Dictionary</a></p>
<form id="form1" name="form1" method="get" action="index.php">
  <label for="search"></label>
  <input type="text" name="family" id="family" />
  <label>
    <input type="submit" name="button" id="button" value="Search" />
  </label>
</form>
<?php if ($totalRows_results == 0) { // Show if recordset empty ?>
  <table width="200" border="1">
    <tr>
      <td>Word Family</td>
      <td>Frequency</td>
    </tr>
    <?php do { ?>
      <tr>
        
        <td><a href="members.php?family=<?php echo $row_Recordset1['family']; ?>" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=400,height=300,toolbar=0,resizable=0'); return false;"><?php echo $row_Recordset1['family']; ?></a></td>
        <td><?php echo $row_Recordset1['freq']; ?></td>
      </tr>
      
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    
  </table>
  <table width="200" border="1">
    <tr>
      <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <td><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">&lt;&lt; First</a></td>
        <td><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">&lt;= Prev</a></td>
        <?php } // Show if not first page ?>
      <td>&nbsp;<?php echo ($startRow_Recordset1 + 1) ?> - <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?></td>
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <td><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next =&gt;</a></td>
        <td><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last &gt;&gt;</a></td>
        <?php } // Show if not last page ?>
    </tr>
  </table>
    <?php } // Show if recordset empty ?>
  <?php if ($totalRows_results > 0) { // Show if recordset not empty ?>
  Search Results for &quot;<em><?php echo $_GET['family']; ?></em>&quot;<br />
    <table width="200" border="1">
      <tr>
        <td>Word Family</td>
        <td>Frequency</td>
      </tr>
      <tr>
     
        <td><a href="members.php?family=<?php echo $row_results['family']; ?>" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=250,height=250,toolbar=0,resizable=0'); return false;"><?php echo $row_results['family']; ?></a></td>
        <td><?php echo $row_results['freq']; ?></td>
      </tr>
    </table>
    <?php } // Show if recordset not empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($results);
?>
