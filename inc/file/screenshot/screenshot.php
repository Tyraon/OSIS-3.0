<?php
@session_start();
@include('../../../class/file_handler.php');

$max = 100;
$current = 0;
for($i=0;$i<$max;$i++) {
	$status = checkFileOnDesktop(strtok($_GET['f'],'.').'_'.$i,substr(strstr($_GET['f'],'.'),1),'');
	if($status['status'] == '404') {
		$current = $i;
		createFileOnDesktop(strtok($_GET['f'],'.').'_'.$current,substr(strstr($_GET['f'],'.'),1),$_POST['bild'],'1','');
		break;
	}
}

/*$msg = 'ERR';
  if ( @ copy ( $_FILES['file']['tmp_name'],
                '../../../data/desktop/Tyraon/Screenshot.png' ) )
  {
    echo '<b>Upload beendet!</b><br>';

    echo 'Dateiname: ' . $_FILES['file']['name'] . '<br>';

    echo 'Dateigröße: ' . $_FILES['file']['size'] . 'Byte';
	$msg = 'SUCC';
  }    
echo $msg;*/

?>