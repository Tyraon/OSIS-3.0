<?php
@session_start();
@include('../class/user_ini.php');

if(@$_GET['a'] == "1") {
	updateIni($_POST['key'],$_POST['value']);
}

$dsatz = '';
for($i = 0; $i < count($_SESSION); $i++) {
	if(key($_SESSION) != "username" && key($_SESSION) != "gm" && key($_SESSION) != "uid") {
		$dsatz .= '<form action="prefs.php?a=1" method="post"><tr><td>*.'.key($_SESSION).'<input name="key" type="hidden" value="'.key($_SESSION).'" /></td><td><input name="value" value="'.current($_SESSION).'" class="login" /></td><td><button id="'.key($_SESSION).'" class="update" type="submit"><img src="../img/package_settings.png" height="20" /></button></th></tr></form>';
	}
	next($_SESSION);
}

?>
<html>
<head>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="sys/jquery.fullscreen-0.4.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.4.1.js"></script>
    <script src="sys/html2canvas.js"></script>
    <style>
		body{background:#333;}
		.update{background:none; border:none; padding:0px;}
	</style>
    <link type="text/css" rel="stylesheet" href="../main.css" />
	<title>Preference @ OSIS 3.0</title>
</head>
<body>
<h2 style="color:#f1f1f1;">Einstellungen</h2>
<table border="0">
<tr>
<th>Dateiformat</th><th>Module</th><th></th>
</tr>
<?php echo $dsatz;?>
</table>
</body>
</html>