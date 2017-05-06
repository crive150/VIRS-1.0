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
$query_med = "SELECT word FROM med ORDER BY word ASC";
$med = mysql_query($query_med, $sql) or die(mysql_error());
$row_med = mysql_fetch_assoc($med);
$totalRows_med = mysql_num_rows($med);

mysql_select_db($database_sql, $sql);
$query_hi = "SELECT word FROM hi ORDER BY word ASC";
$hi = mysql_query($query_hi, $sql) or die(mysql_error());
$row_hi = mysql_fetch_assoc($hi);
$totalRows_hi = mysql_num_rows($hi);
?>


<?php

// Writes an array to an open CSV file with a custom end of line.
//
// $fp: a seekable file pointer. Most file pointers are seekable, 
//   but some are not. example: fopen('php://output', 'w') is not seekable.
// $eol: probably one of "\r\n", "\n", or for super old macs: "\r"
function fputcsv_eol($fp, $array, $eol) {
  fputcsv($fp, $array);
  if("\n" != $eol && 0 === fseek($fp, -1, SEEK_CUR)) {
    fwrite($fp, $eol);
  }
}




if (isset($_GET['awl'])){
	
	$fp = fopen('awl.csv', 'w');
	while($row_awl = mysql_fetch_assoc($awl)){
 	   fputcsv_eol($fp, $row_awl, "\r\n");
	}
	fclose($fp);

	header('Location: awl.csv');

} else if(isset($_GET['lo'])){ //else if to ensure only one dl at a time
	$fp = fopen('lo.csv', 'w');
	while($row_lo = mysql_fetch_assoc($lo)){
    fputcsv_eol($fp, $row_lo, "\r\n");
	}
	fclose($fp);
	header('Location: lo.csv');
	
} else if (isset($_GET['med'])) {
	
	$fp = fopen('med.csv', 'w');
	while($row_med = mysql_fetch_assoc($med)){
    fputcsv_eol($fp, $row_med, "\r\n");
	}
	fclose($fp);
	header('Location: med.csv');

} else if (isset($_GET['hi'])) {
	$fp = fopen('hi.csv', 'w');
	while($row_hi = mysql_fetch_assoc($hi)){
    fputcsv_eol($fp, $row_hi, "\r\n");
	}
	fclose($fp);
	header('Location: hi.csv');
}



?>



<?php $active = 5; require 'header.php';?> 
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Backup/Import Database <small> Export Data</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-table"></i> Please select the databases you wish to export.</li>
                        </ol>
                    </div>
                </div>

<style type="text/css">
#main {
	color: #666;
	text-decoration: line-through;
}
</style>




<p><a href="export.php?awl=1">AWL</a></p>
<p><a href="export.php?lo=1">Low Frequency</a></p>
<p><a href="export.php?med=1">Medium Frequency</a></p>
<p><a href="export.php?hi=1">High Frequency</a></p>
<p id="main">Main Frequency</p>
<p>&nbsp;</p></body>
</html>