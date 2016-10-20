<?php
@include('../../../config.php');
@include('../../../class/file_handler.php');
$file="";
$content="";

if(@$_GET['a']=="1") {
	$fcheck = checkFileOnDesktop(strtok($_POST['fname'],'.'),substr(strstr($_POST['fname'],'.'),1),'');
	if($fcheck['status'] == "404") {
		createFileOnDesktop(strtok($_POST['fname'],'.'),substr(strstr($_POST['fname'],'.'),1),$_POST['content'],'1','');
	}
	writeFileOnDesktop(strtok($_POST['fname'],'.'),substr(strstr($_POST['fname'],'.'),1),$_POST['content'],'w','');
	$content=$_POST['content'];
	$file = $_POST['fname'];
}

if(@$_GET['a']=="2") {
	$content = readFileOnDesktop(strtok($_GET['f'],'.'),substr(strstr($_GET['f'],'.'),1),'');
	$file = $_GET['f'];
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
    <style>
		body{background:url(../../../<?php echo $background;?>);}
		#preview{visibility:hidden;}
		td{padding-left:5px;}
	</style>
    <link type="text/css" rel="stylesheet" href="../../../main.css" />
	<script src="../../../core.js" type="text/javascript"></script>
	<script src="../../../css_look.js" type="text/javascript"></script>
    <script>
		$(document).ready(function(){
			var hoehe = $(document).innerHeight()-30;
			console.log(hoehe);
			$('#content').css({"height":hoehe + "px"});
			
			window.parent.refreshDesktop();
			
			$('#save').click(function(){
				if($('#fname').val()==""){
					alert('Bitte einen Dateinamen eingeben!');
				}else{
					$('#formular').submit();
				}
			});
		});
	</script>
<title>LookUp @ <?php echo $site_title;?></title>

</head>
<body>
<form id="formular" action="index.php?a=1&f=<?php echo $file;?>" method="post">
<div style="width:100%; height:30px; vertical-align:middle;">
<button id="save" type="button" style="background-image:url('../../../img/save-icon-png--4.png'); background-size: 30px 30px; background-repeat:no-repeat; background-position:center; border:none; width:30px; height:30px;"></button>
<input type="text" id="fname" name="fname" value="<?php echo $file;?>" placeholder="Dateiname.Format" style="margin-bottom:5px;" />
</div>
<textarea id="content" name="content" style="width:100%; height:100%; background:beige;"><?php echo $content;?></textarea>
</form>
</body>
</html>