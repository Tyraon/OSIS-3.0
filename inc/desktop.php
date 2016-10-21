<?php
$username = @$_SESSION['username'];
if(@$_GET['username'] != "") {
	$username = $_GET['username'];
}
$pl='';
if(@$_GET['pl'] != "") {
	$pl=$_GET['pl'];
}
$i=0;
$verz = @opendir($pl.'data/desktop/'.$username);
if(@scandir($pl.'data/desktop/'.$username)){
	echo '<div id="desktop" style="height:100%; max-height:100%; display:block;">';
	while($file = @readdir($verz)) {
		if($file != '.' && $file != '..') {
			switch(strstr($file,'.')) {
				default:
				$icon = 'generic.png';
				break;
				case ".jpg":
				$icon = 'jpg.png';
				break;
				case ".png":
				$icon = 'png.png';
				break;
				case ".zip":
				$icon = 'zip.png';
				break;
				case ".avi":
				$icon = 'avi.png';
				break;
				case ".doc":
				$icon = 'doc.png';
				break;
				case ".pdf":
				$icon = 'pdf.png';
				break;
				case ".txt":
				$icon = 'txt.png';
				break;
				case ".bif":
				$icon = 'bif.png';
				break;
				case ".omf":
				$icon = 'omf.png';
				break;
			}
			
			echo '<table border="0" class="dSym" id="'.$i.'" title="'.$file.'"><tr><td align="center" title="'.$file.'"><img src="img/'.$icon.'" class="dIcon" height="40" title="'.$file.'" id="'.$i.'" /></td></tr><tr><td class="dText" title="'.$file.'" id="'.$i.'">'.$file.'</td></tr></table>';
			$i++;
		}
	}
	echo '</div>';
	echo '<script>$(".dSym").mousedown(function(e){if(event.button == 2){newContext(e); return false;}}); $(".dSym").dblclick(function(e){winOpen(e);});$("#desktop").mousedown(function(e){if(event.button == 2){deskContext(e); return false;}});</script>';
}

?>
