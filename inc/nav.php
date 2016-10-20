<?php
@include('../config.php');
$verz = array('public');
if($_SESSION['gm'] >= $gm_level) { array_push($verz,'gm'); }
if($_SESSION['gm'] >= $private_level) { array_push($verz,'private'); }

$output = array();

for($i=0;$i<3;$i++) {
	$lookup = opendir('modules/'.$verz[$i]);
	//$modules = readdir($lookup);
	while($module = readdir($lookup)) {
		if($module != '.' && $module != '..') {
			$head = 'modules/'.$verz[$i].'/'.$module.'/.omh';
			if(file_exists($head)) {
				$fp = fopen($head,'r');
				$str = fread($fp,filesize($head));
				fclose($fp);
				$block = @explode('#',$str);
				$titel = @explode(':',$block[1]);
				$version = @explode(':',$block[4]);
				$core = $version[2];
				if($core == "free" || ($core == $emu_core && $version[1] == $core_version)) {
					$titel_val = $titel[1];
					$source = @explode(':',$block[3]);
					$source_val = $source[1];
					$nav = array($titel_val,$source_val,str_replace('../','',str_replace('/.omh','',$head)));
					array_push($output,$nav);
				} else {
					if(!file_exists('log/module.log')) {
						copy('sys/blank.txt','log/module.log');
					}
					$fp = @fopen('log/module.log','a');
					$dsatz = date('d.m.Y - H:i').' : Module not loaded. Invalid core or version ('.$titel[1].'.'.$core.'.'.$version[1].')
';
					@fwrite($fp,$dsatz);
					@fclose($fp);
				}
			}
		}
	}
}


foreach($output as $dsatz) {
	echo '<span class="menuitem" id="'.$dsatz[2].'/'.$dsatz[1].'" title="'.$dsatz[0].'">'.$dsatz[0].'</span><br>';
	//echo $dsatz;
}

//echo count($output);


?>