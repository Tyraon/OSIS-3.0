<?php
@session_start();
@include("../config.php");
//@include("cfg.php");
$err = '';

function logging($err,$user) {
	if(!file_exists('../log/login.log')) {
		copy('../sys/blank.txt','../log/login.log');
	}
	$fp = @fopen('../log/login.log','a');
	$dsatz = date('d.m.Y - H:i').' : Login failed ('.$user.'::'.$err.')
';
	@fwrite($fp,$dsatz);
	@fclose($fp);
}

if(@$_GET['a']=="1") {
	$db = @mysql_connect($database_host,$database_user,$database_pass);
	@mysql_select_db($database_name);
	if($emu_core == "mangos") {
		$data=@mysql_fetch_row(mysql_query("SELECT * FROM account WHERE username LIKE '{$_POST['username']}'"));
		if(sha1(strtoupper($_POST['username']).":".strtoupper($_POST['pass'])) == $data[2]) {
			if($data[3] >= $public_level) {
				$_SESSION['uid']=$data[0];
				$_SESSION['gm']=$data[3];
				$_SESSION['username']=$data[1];
				@include('../class/user_ini.php');
				readIni();
				echo '<script>location.replace("../index.php");</script>';
			} else {
				$err = 'Zugriff verweigert!<br><small>Du hast keine Berechtigung.</small>';
				logging($err,$_POST['username']);
			}
			} else {
				$err = 'Zugriff verweigert!<br><small>Benutzerdaten nicht korrekt.</small>';
				logging($err,$_POST['username']);
			}
	} elseif($emu_core == "trinity") {
		$data=@mysql_fetch_row(mysql_query("SELECT * FROM account WHERE username LIKE '{$_POST['username']}'"));
		if(sha1(strtoupper($_POST['username']).":".strtoupper($_POST['pass'])) == $data[2]) {
			$gml=@mysql_fetch_row(mysql_query("SELECT * FROM account_access WHERE id LIKE '{$data[0]}' LIMIT '0,1'"));
			if($gml[2] >= $public_level) {
				$_SESSION['uid']=$data[0];
				$_SESSION['gm']=$gml[2];
				$_SESSION['username']=$data[1];
				@include('../class/user_ini.php');
				readIni();
				echo '<script>location.replace("../index.php");</script>';
			} else {
				$err = 'Zugriff verweigert!<br><small>Du hast keine Berechtigung.</small>';
				logging($err,$_POST['username']);
			}
			} else {
				$err = 'Zugriff verweigert!<br><small>Benutzerdaten nicht korrekt.</small>';
				logging($err,$_POST['username']);
			}
	} else {
		$data=@mysql_fetch_row(mysql_query("SELECT * FROM login WHERE username LIKE '{$_POST['username']}'"));
		if($_POST['pass'] == $data[2]) {
			$_SESSION['uid']=$data[0];
			$_SESSION['gm']=$data[3];
			$_SESSION['username']=$data[1];
			@include('../class/user_ini.php');
			readIni();
			echo '<script>location.replace("../index.php");</script>';
		} else {
			$err = 'Zugriff verweigert!<br><small>Benutzerdaten nicht korrekt.</small>';
			logging($err,$_POST['username']);
		}
	}
}
?>
<html>
<head>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/ui-darkness/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="jquery.fullscreen-0.4.1.min.js"></script>
    <style>
		body{background:url(../<?php echo $wallpaper;?>);}
	</style>
    <link type="text/css" rel="stylesheet" href="../main.css" />
	<script src="../core.js" type="text/javascript"></script>
	<script src="../css_look.js" type="text/javascript"></script>
<title>Login @ <?php echo $site_title;?></title>

</head>
<body>
<center>
<br><font color="#CC0000"><?php echo $err;?></font>
<form id="login" action="login.php?a=1" method="post">
	<h3>Anmelden</h3>
	<input id="username" name="username" placeholder="Benutzer" class="login" /><br />
    <input type="password" name="pass" placeholder="Passwort" class="login" /><br />
	<button type="submit" class="login">Anmelden</button>
</form>
    <script>
		$('#username').focus();
	</script>

</body>
</html>