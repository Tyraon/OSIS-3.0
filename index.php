<?php
if(!file_exists('config.php')) {
	echo '<script>location.replace("./install");</script>';
}
@include("config.php");
@include("sys/cfg.php");
@include("class/user_ini.php");

//echo $_SESSION['txt'];
//echo $_SESSION['bif'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/ui-darkness/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="sys/jquery.fullscreen-0.4.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.4.1.js"></script>
    <script src="sys/html2canvas.js"></script>
    <script src="sys/sha1.js"></script>
    <style>
		body{background-image:url('<?php echo $wallpaper;?>');	overflow: hidden;
}
	</style>
    <link type="text/css" rel="stylesheet" href="main.css" />
    <script>
		var username = "<?php echo $_SESSION['username'];?>";
		var tempCheck = "<?php echo $_SESSION[$_SESSION['username']];?>";
		var userIni = {};
	</script>
    <?php splitIni(); ?>
	<script src="core.js" type="text/javascript"></script>
	<script src="css_look.js" type="text/javascript"></script>
<title><?php echo $site_title;?></title>
</head>

<body>
<div id="deskt" style="height:100%;">
<?php
@include('inc/desktop.php');
?>
</div>
<div id="newmenu">
<span class="menuitem" id="mentitel" style="font-weight:bold; border-bottom:1px solid black; margin-bottom:5px;">Men&uuml;</span><br><br />
<!--<span class="menuitem" id="mi1">Fenster</span><br>
<span class="menuitem" id="mi2">Buffed</span><br>
<span class="menuitem" id="mi3">Onlineliste</span><br>
<span class="menuitem" id="mi4">Tickets</span><br>
<?php
if($_SESSION['gm'] >= "4") {
?>
<span class="menuitem" id="mi5">Account</span><br>
<?php } ?>
<span class="menuitem" id="mi6">Character</span><br>-->
<?php
@include('inc/nav.php');
?>
<hr />
<span class="menuitem" id="logout">Abmelden</span>
<br />
<br />
</div>

<div id="menu">
<button id="menuclick"></button>
<span class="pipe">|</span>
<span id="taskbar">
</span>
<span style="float:right;">
<button class="screenshot" type="button" onclick="screenShot(document.body);" title="Screenshot erzeugen."></button>
<button class="prefs" type="button"></button>
<!--<button class="fulls" type="button"></button>-->
<span class="pipe">|</span>
<span id="clock">Initialisiere</span>
</span>
</div>
<div id="loading"></div>
</body>
</html>
