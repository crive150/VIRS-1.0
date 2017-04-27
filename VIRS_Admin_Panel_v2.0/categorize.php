  
 
  <?php   $active = 0;   require 'header.php';   ?>
  
  
  <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            VIR Dashboard <small> Upload Text</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                        Welcome to <strong>Vocabulary in Reading</strong>! Please upload your text below. </div>
                    </div>
                </div>
                <!-- /.row -->

<form id="form1" name="form1" method="post" action="categorizer.php">
<p>Input:</p>
  <p>
    <label for="input"></label>
    <textarea name="input" cols="64" rows="16" id="input">A secret always has a strengthening effect upon a newborn friendship, as does the shared impression than an external figure is to blame: the men of the Crown have become united less by their shared beliefs, we observe, than by their shared misgivings–which are, in the main, externally directed. In their analyses, variously made, of Alastair Lauderback, George Shepard, Lydia Wells, Francis Carver, Anna Wetherell, and Emery Staines, the Crown men have become more and more suggestive, despite the fact that nothing has been proven, no body has been tried, and no new information has come to light. Their beliefs have become more fanciful, their hypotheses less practical, their counsel less germane. Unconfirmed suspicion tends, over time, to become wilful, fallacious, and prey to the vicissitudes of mood–it acquires all the qualities of common superstition–and the men of the Crown Hotel, whose nexus of allegiance is stitched, after all, in the bright thread of time and motion, have, like all men, no immunity to influence.</textarea>
  </p>
  <p>
  <!-- more colors at https://www.w3schools.com/colors/colors_names.asp - near inf many with hex codes -->
  <input type="hidden" value = '0' name = "AWL" />
    <input name="AWL" type="checkbox" value='1'/>
    <label for="AWL">AWL</label>
    <select name="awlc" id="awlc">
      <option value="Green" selected="selected">Green</option>
      <option value="Blue">Blue</option>
      <option value="Pink">Pink</option>
      <option value="Red">Red</option>
      <option value="Purple">Purple</option>
      <option value="Cyan">Cyan</option>
      <option value="Lime">Lime</option>
      <option value="Gold">Gold</option>
    </select>
  </p>
  <p>
    <input type="hidden" value = '0' name = "lo" />
    <input name="lo" type="checkbox" value='1'/>
    <label for="lo">Low Frequency</label>
    <select name="loc" id="loc">
      <option value="Green">Green</option>
      <option value="Blue">Blue</option>
      <option value="Pink">Pink</option>
      <option value="Red" selected="selected">Red</option>
      <option value="Purple">Purple</option>
      <option value="Cyan">Cyan</option>
      <option value="Lime">Lime</option>
      <option value="Gold">Gold</option>
    </select>
  </p>
  <p>
    <input type="hidden" value = '0' name = "med" />
    <input name="med" type="checkbox" value='1'/>
    <label for="med">Medium  Frequency</label>
    <select name="medc" id="medc">
      <option value="Green">Green</option>
      <option value="Blue">Blue</option>
      <option value="Pink">Pink</option>
      <option value="Red">Red</option>
      <option value="Purple" selected="selected">Purple</option>
      <option value="Cyan">Cyan</option>
      <option value="Lime">Lime</option>
      <option value="Gold">Gold</option>
    </select>
  </p>
  <p>
  <input type="hidden" value = '0' name = "hi" />
    <input name="hi" type="checkbox" value='1'/>
    <label for="hi">High Frequency</label>
    <select name="hic" id="hic">
      <option value="Green">Green</option>
      <option value="Blue" selected="selected">Blue</option>
      <option value="Pink">Pink</option>
      <option value="Red">Red</option>
      <option value="Purple">Purple</option>
      <option value="Cyan">Cyan</option>
      <option value="Lime">Lime</option>
      <option value="Gold">Gold</option>
    </select>
  </p>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Categorize" />
  </p>
</form>
<?php require 'footer.php';?>