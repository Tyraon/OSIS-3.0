<?php
@session_start();

function readIni() {
	$file = '../data/ini/'.$_SESSION['username'].'.cfg';
	if(@file_exists($file)) {
		$fp = @fopen($file,"r");
		$content = @fread($fp,filesize($file));
		@fclose($fp);
		$block = @explode(';',$content);
		for($i = 1; $i < (substr_count($content,';')+1); $i++) {
			$kv = @explode('=',$block[$i]);
			$_SESSION[$kv[0]] = $kv[1];
		}
		echo $_SESSION['txt'];
	} else {
		@copy('../sys/blank.txt',$file);
		$fp = @fopen($file,"w");
		@fwrite($fp,';txt=TeEd;bif=BIF-Reader');
		@fclose($fp);
		$_SESSION['txt'] = 'TeEd';
		$_SESSION['bif'] = 'BIF-Reader';
	}
}

function splitIni() {
	for($i = 0; $i < count($_SESSION); $i++) {
		echo '<script>userIni["'.key($_SESSION).'"] = "'.current($_SESSION).'";</script>';
		next($_SESSION);
	}
}

function setIni($key,$val) {
	$file = '../data/ini/'.$_SESSION['username'].'.cfg';
	if(@file_exists($file)) {
		$fp = @fopen($file,"a");
		@fwrite($fp,';'.$key.'='.$val);
		@fclose($fp);
		$_SESSION[$key] = $val;
	}
}

?>