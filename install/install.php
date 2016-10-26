<?php
if(@$_GET['a']=="1") {
	if(@copy('index.php','../config.php')) {
		$dsatz="<?php /*
############################
# Configuration
############################*/

//General
\$site_title='".$_POST['site_title']."';		//Title of the Page

//Database
\$database_host='".$_POST['dbhost']."';
\$database_user='".$_POST['dbuser']."';
\$database_pass='".$_POST['dbpass']."';
\$database_name='".$_POST['dbname']."';		//Databasename for Login (e.g. realmd) | default => osis


\$emu_core='".$_POST['emucore']."';			//Core of emulator (Options: mangos, trinity, arcemu, other)

\$core_version='".$_POST['corevers']."';			//Version of Server (Only first INT! e.g.: 3.3.5a => 3 | 2.4.3 => 2)

\$public_level='".$_POST['pulevel']."';			//Minimum required GMLevel

\$gm_level='".$_POST['gmlevel']."';				//GMLevel for Supporter

\$private_level='".$_POST['prlevel']."';			//GMLevel for admin

\$wallpaper='".$_POST['wallpaper']."';	//Desktopwallpaper

\$background='".$_POST['background']."';	//Backgroundimage for Blankwindows


?>";
		$fp = fopen('../config.php','w');
		fwrite($fp,$dsatz);
		fclose($fp);
		
		if($_POST['emucore']=="other") {
			$pass = sha1(strtoupper($_POST['username']).":".strtoupper($_POST['pass']));
			$db=@mysql_connect($_POST['dbhost'],$_POST['dbuser'],$_POST['dbpass']);
			@mysql_select_db($_POST['dbname']);
			@mysql_query("CREATE TABLE IF NOT EXISTS `login` ( `id` int(10) NOT NULL, `username` varchar(255) NOT NULL, `password` varchar(255) NOT NULL, `gm_level` int(1) NOT NULL)");
			@mysql_query("ALTER TABLE `login` ADD PRIMARY KEY (`id`);");
			@mysql_query("ALTER TABLE `login` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;");
			@mysql_query("INSERT INTO login VALUES('0','{$_POST['adminu']}','".$pass."','{$_POST['prlevel']}')");
			@mysql_close($db);
		}
		echo '<script>location.replace("../index.php");</script>';
	}
}
?>
<html>
<head>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<title>Install @ OSIS 3.0</title>
</head>
<body>
<center>
<form action="install.php?a=1" method="post">
<table border="0" style="margin-top:30px; box-shadow: 0px 0px 10px 2px black; border-radius:10px;">
	<tr>
    	<td>
        <h3 style="text-align:center;">Installation<br /><small>OSIS 3.0</small></h3><hr />
        	<table border="0">
        		<tr>
                	<td>Titel der Seite</td>
                    <td><input name="site_title" value="OSIS 3.0" /></td>
                </tr>
        		<tr>
                	<td>MySQL Host</td>
                    <td><input name="dbhost" value="localhost" /></td>
                </tr>
        		<tr>
                	<td>MySQL Benutzer</td>
                    <td><input name="dbuser" value="root" /></td>
                </tr>
        		<tr>
                	<td>MySQL Passwort</td>
                    <td><input name="dbpass" value="" /></td>
                </tr>
        		<tr>
                	<td>MySQL Datenbank</td>
                    <td><input name="dbname" value="osis" /></td>
                </tr>
                <tr>
                	<td colspan="2"><hr /></td>
                </tr>
        		<tr>
                	<td>Emu Core</td>
                    <td><select id="emu" name="emucore" size="1">
                    <!--<option value="arcemu">ArcEmu</option>-->
                    <option value="mangos">Mangos</option>
                    <option value="trinity">Trinity</option>
                    <option value="other">Sonstiger</option>
                    </select></td>
                </tr>
        		<tr>
                	<td>Core Version</td>
                    <td><input name="corevers" type="number" min="0" max="10" value="1" pattern="[0-9]{2}" /></td>
                </tr>
        		<tr>
                	<td>Public-Level</td>
                    <td><input name="pulevel" type="number" min="0" max="10" value="1" /></td>
                </tr>
        		<tr>
                	<td>GM-Level</td>
                    <td><input name="gmlevel" type="number" min="0" max="10" value="2" /></td>
                </tr>
        		<tr>
                	<td>Private-Level</td>
                    <td><input name="prlevel" type="number" min="0" max="10" value="4" /></td>
                </tr>
                <tr>
                	<td colspan="2"><hr /></td>
                </tr>
        		<tr>
                	<td>Wallpaper</td>
                    <td><input name="wallpaper" value="img/14.jpg" /></td>
                </tr>
        		<tr>
                	<td>Background-Image</td>
                    <td><input name="background" value="img/KU3umM.jpg" /></td>
                </tr>
                <tr>
                	<td colspan="2"><hr /></td>
                </tr>
        		<tr id="ad1">
                	<td>Administrator</td>
                    <td><input name="adminu" value="admin" /></td>
                </tr>
        		<tr id="ad2">
                	<td>Passwort</td>
                    <td><input name="adminp" value="admin" /></td>
                </tr>
        	</table>
        </td>
    </tr>
    <tr>
    	<td align="center">
        	<button type="submit" style="background-image:url('../img/installer-icon-5838.png'); background-size:30px 30px; background-repeat:no-repeat; background-position:left; height:34px; width:200px; border-radius:10px; font-size:18px; border:2px outset #333;">Installieren</button>
        </td>
    </tr>
</table>
</form>
</center>
	<script>
		$('#ad1').css({"visibility":"hidden"});
		$('#ad2').css({"visibility":"hidden"});
		$('#emu').change(function(){
			if($('#emu').val() != "other"){
				$('#ad1').css({"visibility":"hidden"});
				$('#ad2').css({"visibility":"hidden"});
			}else{
				$('#ad1').css({"visibility":"visible"});
				$('#ad2').css({"visibility":"visible"});
			}
		});
	</script>

</body>
</html>