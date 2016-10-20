<?php
@session_start();

function writeFileOnDesktop($filename, $format, $content, $modus, $pathlevel) {
	$msg="Nicht gespeichert!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	if(file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		$fp = @fopen($pathToDesktop.'/'.$filename.'.'.$format,$modus);
		@fwrite($fp,$content);
		@fclose($fp);
		$msg="Gespeichert!".$filename.'.'.$format;
	}
	return $msg;
}

function createFileOnDesktop($filename, $format, $content, $overwrite, $pathlevel) {
	$msg = "Datei nicht angelegt!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	$blankFile = $pathlevel.'../../../sys/blank.txt';
	if(@scandir($pathToDesktop) == "") {
		@mkdir($pathlevel.'../../../data/desktop/'.$_SESSION['username'],0777);
	}
	if((file_exists($pathToDesktop.'/'.$filename.'.'.$format) && $overwrite == "1") || !file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		@copy($blankFile,$pathToDesktop.'/'.$filename.'.'.$format);
		writeFileOnDesktop($filename, $format, $content, 'w', $pathlevel);
		$msg = "Datei angelegt.";
	}
	return $msg;
}

function readFileOnDesktop($filename, $format, $pathlevel) {
	$msg = "Datei '".$filename.".".$format."' nicht gefunden!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	if(file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		$fp = @fopen($pathToDesktop.'/'.$filename.'.'.$format,"r");
		$datei = @fread($fp, filesize($pathToDesktop.'/'.$filename.'.'.$format));
		@fclose($fp);
		$msg = $datei;
	}
	return $msg;
}

function deleteFileOnDesktop($filename, $format, $pathlevel) {
	$msg = "Datei '".$filename.".".$format."' nicht gefunden!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	if(file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		if(@unlink($pathToDesktop.'/'.$filename.'.'.$format)) {
			$msg = "Datei wurde gelöscht!";
		}
	}
	return $msg;
}

function renameFileOnDesktop($filename, $format, $pathlevel, $newname, $newformat) {
	$msg = "Datei '".$filename.".".$format."' nicht gefunden!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	if(file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		if(rename($pathToDesktop.'/'.$filename.'.'.$format,$pathToDesktop.'/'.$newname.'.'.$newformat)) {
			$msg = "Datei wurde umbenannt!";
		}
	}
	return $msg;
}

function checkFileOnDesktop($filename, $format, $pathlevel) {
	$msg = array("status" => "404","filename" => "","filetype" => "","filesize" => "","fileatime" => "","filectime" => "","filemtime" => "");
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	if(file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		$msg['status'] = "401";
		$msg['filename'] = $filename.'.'.$format;
		$msg['filetype'] = filetype($pathToDesktop.'/'.$filename.'.'.$format);
		$msg['filesize'] = filesize($pathToDesktop.'/'.$filename.'.'.$format);
		$msg['fileatime'] = fileatime($pathToDesktop.'/'.$filename.'.'.$format);
		$msg['filectime'] = filectime($pathToDesktop.'/'.$filename.'.'.$format);
		$msg['filemtime'] = filemtime($pathToDesktop.'/'.$filename.'.'.$format);
	} else {
		$msg['status'] = "404";
	}
	return $msg;
}

function transferFileOnDesktop($filename, $format, $pathlevel, $touser) {
	$msg = "Datai ".$filename.".".$format." nicht gefunden!";
	$pathToDesktop = $pathlevel.'../../../data/desktop/'.$_SESSION['username'];
	$pathToNewDesktop = $pathlevel.'../../../data/desktop/'.$touser;
	if(@file_exists($pathToDesktop.'/'.$filename.'.'.$format)) {
		if(@file_exists($pathToNewDesktop.'/'.$filename.'.'.$format)) {
			$newfilename = $filename.'_1';
		} else {
			$newfilename = $filename;
		}
		@copy($pathToDesktop.'/'.$filename.'.'.$format,$pathToNewDesktop.'/'.$newfilename.'.'.$format);
		$msg = "Datei an Benutzer ".$touser." gesendet!";
	}
	return $msg;
}


?>