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
                                <i class="fa fa-gear"></i> Please upload the data you wish to import into the database.</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
<p>Warning: The files uploaded here <span id="must">MUST</span> be of <strong>CSV</strong> format or the file will <strong>not</strong> be accepted. Export using Excel as CSV (<strong>Windows Formatted!!</strong>) <!-- [\r\n newlines] --></p>
<p>Also, this will <strong>overwrite</strong> any previously uploaded CSV files. You will be prompted before making any changes to the actual database.</p>
<p>All words <span id="must">MUST</span> be in a single column with NO header. <strong>The header would get included as another word.</strong> You will be given a preview after uploading your files.</p>
</div></div></div>


<form id="form1" name="form1" method="post" action="updater.php" enctype="multipart/form-data">
  <?php if ($_POST['AWL'] > 0) { ?>
  <p>Upload AWL .CSV file: <input type="file" value="Upload AWL .CSV file" name="awl_file" id="awl_file"></p>
  <?php }  if ($_POST['lo'] > 0) {?>
<p>Upload Low .CSV file: <input type="file" value="Upload Low .CSV file" name="lo_file" id="lo_file"></p>
<?php }  if ($_POST['med'] > 0) {?>
<p>Upload Medium .CSV file: <input type="file" value="Upload Medium .CSV file" name="med_file" id="med_file"></p>
<?php }  if ($_POST['hi'] > 0) {?>
  <p>Upload High .CSV file: <input type="file" value="Upload High .CSV file" name="hi_file" id="hi_file"></p>
  <?php }  if ($_POST['freq'] > 0) {?>
    <p>Upload Main Freq .CSV file: <input type="file" value="Upload Main Freq .CSV file" name="freq_file" id="freq_file"></p>
    <?php } if ( $_POST['AWL'] == 0 && $_POST['lo'] == 0 && $_POST['med'] == 0 && $_POST['hi'] == 0 && $_POST['freq'] == 0 ){ echo "No files selected."; }?>
    <p>&nbsp;</p>
  <p>
    <input type="submit" name="select" id="select" value="Upload" />
    <br />
  </p>
</form>
<?php require 'footer.php'?>