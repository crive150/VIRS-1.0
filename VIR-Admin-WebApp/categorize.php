<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Categorize Demo</title>
</head>

<body>
<p><strong>Categorize Demo</strong></p>
<p>Input:</p>
<form id="form1" name="form1" method="post" action="categorizer.php">
  <p>
    <label for="input"></label>
    <textarea name="input" cols="64" rows="16" id="input"></textarea>
  </p>
  <p>
    <input name="AWL" type="checkbox" id="AWL" checked="checked" />
    <label for="AWL">AWL</label>
  </p>
  <p>
    <input type="checkbox" name="lo" id="lo" />
    <label for="lo">Low Frequency</label>
  </p>
  <p>
    <input type="checkbox" name="med" id="med" />
    <label for="med">Medium  Frequency</label>
  </p>
  <p>
    <input name="hi" type="checkbox" id="hi" checked="checked" />
    <label for="hi">High Frequency</label>
  </p>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Categorize" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>