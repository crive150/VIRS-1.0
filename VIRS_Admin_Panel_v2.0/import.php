<?php $active = 5; require 'header.php';?> 
 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Backup/Import Database <small> Import Data</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-gear"></i> Please select the databases you wish to update.</li>
                        </ol>
                    </div>
                </div>

<form id="form1" name="form1" method="post" action="upload.php">
  <p>
  <input name="AWL" type="hidden" value="0" />
  <input name="lo" type="hidden" value="0" />
  <input name="med" type="hidden" value="0" />
  <input name="hi" type="hidden" value="0" />
  <input name="freq" type="hidden" value="0" />
    <label>
      <input type="checkbox" name="AWL" value="1" id="AWL" />
      AWL</label>
    <br />
    <label>
      <input type="checkbox" name="lo" value="1" id="lo" />
      Low Frequency</label>
    <br />
    <label>
      <input type="checkbox" name="med" value="1" id="med" />
      Medium Frequency</label>
    <br />
    <label>
      <input type="checkbox" name="hi" value="1" id="hi" />
      High Frequency</label>
    <br />
  
      <input type="checkbox" name="freq" value="1" id="frew" disabled/>
      Main Frequency Chart
  </p>
  <p>
    <input type="submit" name="select" id="select" value="Select" />
    <br />
  </p>
</form>
<?php require 'footer.php';?>