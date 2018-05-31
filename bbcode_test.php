<?php
	$bbcode = (isset($_POST["bbcode"]) ? $_POST["bbcode"] : "");

	if(!empty($bbcode)) {
		include("bbcode.php");

		$html_code = bbcode::tohtml($bbcode);
		$no_bbcode = bbcode::remove($bbcode);	
	}
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<link rel="icon" href="favicon.ico">
	<link rel="shortcut icon" href="favicon.ico">
	<title>BBcode example</title>
</head>
<body>

<div style="margin: 0 auto; width: 900px;">

<h1>PHP BBcode Parser example</h1>

<form action="#" method="POST">
	<textarea name="bbcode" style="width: 100%; height: 400px"><?=$bbcode?></textarea>
	<input type="submit" value="Convert to HTML" />
</form>

<?php if(!empty($bbcode)): ?>
<h2>Parsed HTML</h2>
<div style="border: 1px solid #000000; padding: 10px;">
	<?=$html_code . "\n" ?>
</div>

<h2>HTML source code</h2>
<textarea style="width: 100%; height: 100px"><?=$html_code ?></textarea>

<h2>Without BBcode</h2>
<textarea style="width: 100%; height: 100px"><?=$no_bbcode ?></textarea>

<?php endif ?>
</div>

</body>
</html>
