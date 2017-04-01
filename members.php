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
<title><?php echo $row_Recordset1['family']; ?></title>
</head>

<body>
<p>Members of family 
  
  <strong><?php echo $row_Recordset1['family']; ?></strong></p>
<table width="200" border="1">
<tr>
<td>Member</td><td>Frequency</td></tr>
<?php if ($row_Recordset1['freq1'] > 0){?>
  <tr>
    <td><?php echo $row_Recordset1['member1']; ?></td>
    <td><?php echo $row_Recordset1['freq1']; ?></td>
  </tr>
  
  
  <?php if ($row_Recordset1['freq2'] > 0){?>

  <tr>
    <td>
  <?php echo $row_Recordset1['member2']; ?>
 </td>
    <td><?php echo $row_Recordset1['freq2']; ?></td>
  </tr>
  
  <?php } ?>
  
  <?php if ($row_Recordset1['freq3'] > 0){?>

  <tr>
    <td><?php echo $row_Recordset1['member3']; ?></td>
    <td><?php echo $row_Recordset1['freq3']; ?></td>
  </tr>

<?php } if ($row_Recordset1['freq4'] > 0){?>

  <tr>
    <td><?php echo $row_Recordset1['member4']; ?></td>
    <td><?php echo $row_Recordset1['freq4']; ?></td>
  </tr>
  
 <?php } } else echo "<tr><td colspan=2>No results</td></tr>";?> 
</table>
<form action="edit.php?family=<?php echo $_GET['family']; ?>" method="post">
<input type="submit" value="Edit"/>

<input type="button" value="Close" onclick="self.close();"/></form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
