<?php $active = 5; require 'header.php';?>
<style type="text/css">
#must {
	color: #F00;
	font-weight: bold;
}
</style>

 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Backup/Import Database <small> Import Data</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-file"></i> The following files have been uploaded to the server. If no files are shown, the files were not accepted by the system. In that case, please <a href="./import.php"><strong>try again</strong></a>.</li>
                        </ol>
                    </div>
                </div>

               <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
<p><span id="must">WARNING:</span> It is <strong>YOUR</strong> responsibility to check that the files are correct before attempting to update the database, including checking if the columns are correct. The previews <strong>WILL</strong> be the data going into the database. Good luck.
<p>Hint: Selecting <span id="must">TRUNCATE</span> will <strong>delete all existing data in the database</strong> for that specific list before adding the uploaded data. Not selecting it will append the uploaded data to 
the end of the existing data. </p>
</div></div></div>

<form action="sql.php" method="post">

<input name="atr" type="hidden" value="0" /> <?php // initialize truncate flags ?>
<input name="ltr" type="hidden" value="0" />
<input name="mtr" type="hidden" value="0" />
<input name="htr" type="hidden" value="0" />
<input name="ftr" type="hidden" value="0" />
<input name="aup" type="hidden" value="0" /><?php // initialize upload flags ?>
<input name="lup" type="hidden" value="0" />
<input name="mup" type="hidden" value="0" />
<input name="hup" type="hidden" value="0" />
<input name="fup" type="hidden" value="0" />




<?php

if(!empty($_FILES['awl_file'])) {
	
$awlf = $_FILES['awl_file']; 

$atgt = "../upload/awl.csv";

if((substr(strrchr($awlf["name"], "."), 1) == "csv" || substr(strrchr($awlf["name"], "."), 1) == "CSV") ){
	move_uploaded_file($awlf["tmp_name"], $atgt );
?>

<p>AWL File Uploaded : <a href = "./upload/awl.csv">AWL.csv</a> <br />
   TRUNCATE before updating AWL ? 
  <input name="atr" type="checkbox" value="1" /><input name="aup" type="hidden" value="1" /></p> 
  
  <?php
echo "<p>Previewing AWL table . . .</p><table border=\"1\">\n\n";
$f = fopen("../upload/awl.csv", "r");
$i = 0;
while (($line = fgetcsv($f)) !== false && $i < 10) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n"; $i++;
}
fclose($f);
echo "\n</table>";

} } ?>

<?php

if(!empty($_FILES['lo_file'])) {
	
$lof = $_FILES['lo_file'];

$ltgt = "../upload/lo.csv";

if((substr(strrchr($lof["name"], "."), 1) == "csv" || substr(strrchr($lof["name"], "."), 1) == "CSV") ){
	move_uploaded_file($lof["tmp_name"], $ltgt );
?>

<p>Low frequency File Uploaded : <a href = "./upload/lo.csv">lo.csv</a> <br />
   TRUNCATE before updating lo ? 
  <input name="ltr" type="checkbox" value="1" /><input name="lup" type="hidden" value="1" /></p>

<?php
echo "<p>Previewing lo table . . .</p><table border=\"1\">\n\n";
$f = fopen("../upload/lo.csv", "r");
$i = 0;
while (($line = fgetcsv($f)) !== false && $i < 10) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n"; $i++;
}
fclose($f);
echo "\n</table>";

} } ?>


<?php

if(!empty($_FILES['med_file'])) {
	
$medf = $_FILES['med_file']; 

$mtgt = "../upload/med.csv";

if((substr(strrchr($medf["name"], "."), 1) == "csv" || substr(strrchr($medf["name"], "."), 1) == "CSV") ){
	move_uploaded_file($medf["tmp_name"], $mtgt );
?>

<p>Medium frequency File Uploaded : <a href = "./upload/med.csv">med.csv</a> <br />
   TRUNCATE before updating med ? 
   <input name="mtr" type="checkbox" value="1" /><input name="mup" type="hidden" value="1" /></p>

<?php
echo "<p>Previewing med table . . .</p><table border=\"1\">\n\n";
$f = fopen("../upload/med.csv", "r");
$i = 0;
while (($line = fgetcsv($f)) !== false && $i < 10) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n"; $i++;
}
fclose($f);
echo "\n</table>";

} } ?>

<?php

if(!empty($_FILES['hi_file'])) {
	
$hif = $_FILES['hi_file']; 

$htgt = "../upload/hi.csv";

if((substr(strrchr($hif["name"], "."), 1) == "csv" || substr(strrchr($hif["name"], "."), 1) == "CSV") ){
	move_uploaded_file($hif["tmp_name"], $htgt );
?>

<p>High frequency File Uploaded : <a href = "./upload/hi.csv">hi.csv</a> <br />
   TRUNCATE before updating hi ? 
   <input name="htr" type="checkbox" value="1" /><input name="hup" type="hidden" value="1" /></p>

<?php
echo "<p>Previewing hi table . . .</p><table border=\"1\">\n\n";
$f = fopen("../upload/hi.csv", "r");
$i = 0;
while (($line = fgetcsv($f)) !== false && $i < 10) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n"; $i++;
}
fclose($f);
echo "\n</table>";

} } ?>

<?php

if(!empty($_FILES['freq_file'])) {

$freqf = $_FILES['freq_file'];

$ftgt = "../upload/freq.csv";

if((substr(strrchr($freqf["name"], "."), 1) == "csv" || substr(strrchr($freqf["name"], "."), 1) == "CSV") ){
	move_uploaded_file($freqf["tmp_name"], $ftgt );
?>

<p>Main Frequency Table Uploaded : <a href = "./upload/freq.csv">freq.csv</a> <br />
   TRUNCATE before updating freq ? 
   <input name="ftr" type="checkbox" value="1" /><input name="fup" type="hidden" value="1" /></p>

<p>
<?php
echo "<p>Previewing freq table . . .</p><table border=\"1\">\n\n";
$f = fopen("../upload/freq.csv", "r");
$i = 0;
while (($line = fgetcsv($f)) !== false && $i < 10) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n"; $i++;
}
fclose($f);
echo "\n</table>";

} } ?>
  
</p>
<p>&nbsp;</p>
<p>
  <input type="submit" name="update" id="update" value="Update SQL Database" />
</p>
</form>
  
  
<p><a href="javascript:window.history.back();">Back</a></p>
</body>
</html>