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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO freq (freq, family, member1, freq1, member2, freq2, member3, freq3, member4, freq4) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['freq'], "int"),
                       GetSQLValueString($_POST['family'], "text"),
                       GetSQLValueString($_POST['member1'], "text"),
                       GetSQLValueString($_POST['freq1'], "int"),
                       GetSQLValueString($_POST['member2'], "text"),
                       GetSQLValueString($_POST['freq2'], "int"),
                       GetSQLValueString($_POST['member3'], "text"),
                       GetSQLValueString($_POST['freq3'], "int"),
                       GetSQLValueString($_POST['member4'], "text"),
                       GetSQLValueString($_POST['freq4'], "int"));

  mysql_select_db($database_sql, $sql);
  $Result1 = mysql_query($insertSQL, $sql) or die(mysql_error());

  $insertGoTo = "edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Creating new word family...</p>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="400" height="200" border="1">
    <tr>
      <td>&nbsp;</td>
      <td>Word</td>
      <td>Frequency</td>
    </tr>
    <tr>
      <td>Family</td>
      <td><label for="family"></label>
      <input type="text" name="family" id="family" /></td>
      <td><label for="freq"></label>
      <input type="text" name="freq" id="freq" /></td>
    </tr>
    <tr>
      <td>Member</td>
      <td><label for="member1"></label>
      <input type="text" name="member1" id="member1" /></td>
      <td><label for="freq1"></label>
      <input type="text" name="freq1" id="freq1" /></td>
    </tr>
    <tr>
      <td>Member</td>
      <td><label for="member2"></label>
      <input type="text" name="member2" id="member2" /></td>
      <td><label for="freq2"></label>
      <input type="text" name="freq2" id="freq2" /></td>
    </tr>
    <tr>
      <td>Member</td>
      <td><label for="member3"></label>
      <input type="text" name="member3" id="member3" /></td>
      <td><label for="freq3"></label>
      <input type="text" name="freq3" id="freq3" /></td>
    </tr>
    <tr>
      <td>Member</td>
      <td><label for="member4"></label>
      <input type="text" name="member4" id="member4" /></td>
      <td><label for="freq4"></label>
      <input type="text" name="freq4" id="freq4" /></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Save" />
    <input type="reset" name="Reset" id="Reset" value="Clear" />
    <input type="button" name="Cancel" id="Cancel" value="Cancel" onclick="self.close();" />
  </p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>