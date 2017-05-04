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

 $active = 0;   require 'header.php';   ?>
  
  
  <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            VIR Dashboard <small> Upload Text</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                
<p>Output:</p>


<p><?php

	function helper($needle, $haystack){
	foreach ( $haystack as $i ){
		//echo "Looking for $needle...";
	if( $i == $needle) { return 1; }
	} return 0; } 
	
	//get input
	ob_start();
	echo $_POST['input'];
	$out = ob_get_contents();
	ob_end_clean();
	
	//$out_arr = array();
	$out_arr = preg_split('/[\s]+/', $out);
	//print_r($out_arr);
	
	
	//get arrays
	
	do {  $awl_array[] = $row_awl['word']; 
   } while ($row_awl = mysql_fetch_assoc($awl)); 
   
   do {  $lo_array[] = $row_lo['word']; 
   } while ($row_lo = mysql_fetch_assoc($lo)); 
	
	do {  $med_array[] = $row_med['word']; 
   } while ($row_med = mysql_fetch_assoc($med)); 
   
   do {  $hi_array[] = $row_hi['word']; 
   } while ($row_hi = mysql_fetch_assoc($hi)); 	
	
	 
	//$tok = strtok($out, " ");
	

/*    //using string tokenizer instead of arr (buggy)

while ($tok !== false)
{
	if(in_array($tok, $awl_array)){echo "<font color = \"green\">$tok </font>";}
	else if(in_array($tok, $hi_array)){echo "<font color = \"blue\">$tok </font>";}
	else if(in_array($tok, $med_array)){echo "<font color = \"pink\">$tok </font>";}
	else if(in_array($tok, $lo_array)){echo "<font color = \"red\">$tok </font>";}
	else{
	
echo "$tok ";}
$tok = strtok(" ");
}*/


//get dropdown values for custom color-coding (php complained when trying to use 
//POST array in echo so I gave them their own variables whatever)

$awlcolor = $_POST['awlc'];
$locolor = $_POST['loc'];
$medcolor = $_POST['medc'];
$hicolor = $_POST['hic'];

//print_r($med_array);
		
						//Output loop : POST check marks act as binary flags for each category
	foreach ($out_arr as $tok){
	if(helper($tok, $awl_array) && $_POST['AWL']){echo "<font color = \"$awlcolor\">$tok </font>";}
	else if(helper($tok, $hi_array) && $_POST['hi']){echo "<font color = \"$hicolor\">$tok </font>";}
	else if(helper($tok, $med_array) && $_POST['med']){echo "<font color = \"$medcolor\">$tok </font>";}
	else if(helper($tok, $lo_array) && $_POST['lo']){echo "<font color = \"$locolor\">$tok </font>";}
	else{ echo "$tok ";}

}
?>
	
	
	


  

</p>

<p>Input:</p>
<form id="form1" name="form1" method="post" action="categorizer.php">
  <p>
    <label for="input"></label>
    <textarea name="input" cols="64" rows="16" id="input"><?php echo $_POST['input']; ?></textarea>
  </p>
  <p>
  <input type="hidden" value = '0' name = "AWL" />
    <input name="AWL" type="checkbox" value='1' <?php if ($_POST['AWL']) { echo "checked";} //little bit of ingenuity ?>/>
    <label for="AWL">AWL</label>
    <select name="awlc" id="awlc">
      <option value="Green" <?php if ($awlcolor == "Green") echo "selected=\"selected\""; //little more ?>>Green</option> 
      <option value="Blue" <?php if ($awlcolor == "Blue") echo "selected=\"selected\"";?>>Blue</option>
      <option value="Pink" <?php if ($awlcolor == "Pink") echo "selected=\"selected\"";?>>Pink</option>
      <option value="Red" <?php if ($awlcolor == "Red") echo "selected=\"selected\"";?>>Red</option>
      <option value="Purple" <?php if ($awlcolor == "Purple") echo "selected=\"selected\"";?>>Purple</option>
      <option value="Cyan" <?php if ($awlcolor == "Cyan") echo "selected=\"selected\"";?>>Cyan</option>
      <option value="Lime" <?php if ($awlcolor == "Lime") echo "selected=\"selected\"";?>>Lime</option>
      <option value="Gold" <?php if ($awlcolor == "Gold") echo "selected=\"selected\"";?>>Gold</option>
    </select>
  </p>
  <p>
    <input type="hidden" value = '0' name = "lo" />
    <input name="lo" type="checkbox" value='1'  <?php if ($_POST['lo']) { echo "checked";} ?>/>
    <label for="lo">Low Frequency</label>
    <select name="loc" id="loc">
      <option value="Green" <?php if ($locolor == "Green") echo "selected=\"selected\"";?>>Green</option>
      <option value="Blue" <?php if ($locolor == "Blue") echo "selected=\"selected\"";?>>Blue</option>
      <option value="Pink" <?php if ($locolor == "Pink") echo "selected=\"selected\"";?>>Pink</option>
      <option value="Red" <?php if ($locolor == "Red") echo "selected=\"selected\"";?>>Red</option>
      <option value="Purple" <?php if ($locolor == "Purple") echo "selected=\"selected\"";?>>Purple</option>
      <option value="Cyan" <?php if ($locolor == "Cyan") echo "selected=\"selected\"";?>>Cyan</option>
      <option value="Lime" <?php if ($locolor == "Lime") echo "selected=\"selected\"";?>>Lime</option>
      <option value="Gold" <?php if ($locolor == "Gold") echo "selected=\"selected\"";?>>Gold</option>
    </select>
  </p>
  <p>
    <input type="hidden" value = '0' name = "med" />
    <input name="med" type="checkbox" value='1'  <?php if ($_POST['med']) { echo "checked";} ?>/>
    <label for="med">Medium  Frequency</label>
    <select name="medc" id="medc">
      <option value="Green" <?php if ($medcolor == "Green") echo "selected=\"selected\"";?>>Green</option>
      <option value="Blue" <?php if ($medcolor == "Blue") echo "selected=\"selected\"";?>>Blue</option>
      <option value="Pink" <?php if ($medcolor == "Pink") echo "selected=\"selected\"";?>>Pink</option>
      <option value="Red" <?php if ($medcolor == "Red") echo "selected=\"selected\"";?>>Red</option>
      <option value="Purple" <?php if ($medcolor == "Purple") echo "selected=\"selected\"";?>>Purple</option>
      <option value="Cyan" <?php if ($medcolor == "Cyan") echo "selected=\"selected\"";?>>Cyan</option>
      <option value="Lime" <?php if ($medcolor == "Lime") echo "selected=\"selected\"";?>>Lime</option>
      <option value="Gold" <?php if ($medcolor == "Gold") echo "selected=\"selected\"";?>>Gold</option>
    </select>
  </p>
  <p>
  <input type="hidden" value = '0' name = "hi" />
    <input name="hi" type="checkbox" value='1'  <?php if ($_POST['hi']) { echo "checked";} ?>/>
    <label for="hi">High Frequency</label>
    <select name="hic" id="hic">
      <option value="Green" <?php if ($hicolor == "Green") echo "selected=\"selected\"";?>>Green</option>
      <option value="Blue" <?php if ($hicolor == "Blue") echo "selected=\"selected\"";?>>Blue</option>
      <option value="Pink" <?php if ($hicolor == "Pink") echo "selected=\"selected\"";?>>Pink</option>
      <option value="Red" <?php if ($hicolor == "Red") echo "selected=\"selected\"";?>>Red</option>
      <option value="Purple" <?php if ($hicolor == "Purple") echo "selected=\"selected\"";?>>Purple</option>
      <option value="Cyan" <?php if ($hicolor == "Cyan") echo "selected=\"selected\"";?>>Cyan</option>
      <option value="Lime" <?php if ($hicolor == "Lime") echo "selected=\"selected\"";?>>Lime</option>
      <option value="Gold" <?php if ($hicolor == "Gold") echo "selected=\"selected\"";?>>Gold</option>
    </select>
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
