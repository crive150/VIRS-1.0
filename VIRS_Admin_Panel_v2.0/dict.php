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

$maxRows_results = 100;
$pageNum_results = 0;
if (isset($_GET['pageNum_results'])) {
  $pageNum_results = $_GET['pageNum_results'];
}
$startRow_results = $pageNum_results * $maxRows_results;

$colname_results = "-1";
if (isset($_GET['word'])) {
  $colname_results = $_GET['word'];
}
mysql_select_db($database_sql, $sql);
$query_results = sprintf("SELECT * FROM dict WHERE word = %s", GetSQLValueString($colname_results, "text"));
$query_limit_results = sprintf("%s LIMIT %d, %d", $query_results, $startRow_results, $maxRows_results);
$results = mysql_query($query_limit_results, $sql) or die(mysql_error());
$row_results = mysql_fetch_assoc($results);

if (isset($_GET['totalRows_results'])) {
  $totalRows_results = $_GET['totalRows_results'];
} else {
  $all_results = mysql_query($query_results);
  $totalRows_results = mysql_num_rows($all_results);
}
$totalPages_results = ceil($totalRows_results/$maxRows_results)-1;

$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_sql, $sql);
$query_Recordset1 = "SELECT * FROM dict";
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

$currentPage = $_SERVER["PHP_SELF"];

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

 $active = 2;   require 'header.php';
?>

  
  <?php if ($totalRows_results == 0) { // Show if recordset empty ?>
  <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
  Showing words <?php echo ($startRow_Recordset1 + 1) ?> to <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> of <?php echo $totalRows_Recordset1 ?> total words.<br /></div></div></div>
  
 
  
     <form action="dict.php" method="get">
       <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit">
    <input name="word" type="text" />
    <input name="define" type="submit" value="Define" /> &nbsp;&nbsp;
    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Prev</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>  
  </i><small> 
 </li>  </ol>  </p>   </form>  
    <table width="90%" border="20" >
      <style>td, th { border: 2px solid }</style>
      
      <tr>
        <td>Word</td>
        <td>Part of speech</td>
        <td>Definition</td>
      </tr>
      <tr >
        
          <?php do { ?>
            <td><?php echo $row_Recordset1['word']; ?></td>
            <td><?php echo $row_Recordset1['wordtype']; ?></td>
            <td><?php echo $row_Recordset1['definition']; ?></td>
      </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          
      
    </table>
    <?php } // Show if recordset empty ?>
  <?php if ($totalRows_results > 0) { // Show if recordset not empty ?>
   <form action="dict.php" method="get">
       <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-edit">
    <input name="word" type="text" />
    <input name="define" type="submit" value="Define" /> &nbsp;&nbsp;
    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Prev</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a> - <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>  
  </i><small> 
 </li>  </ol>  </p>   </form>
 
  <table width="90%" border="10">
    <tr>
      <td>Word</td>
      <td>Part of speech</td>
      <td>Definition</td>
    </tr>
    <tr>
      <td><?php echo $row_results['word']; ?></td>
      <td><?php echo $row_results['wordtype']; ?></td>
      <td><?php echo $row_results['definition']; ?></td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
  </p>

<p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($results);

mysql_free_result($Recordset1);

require 'footer.php';
?>
