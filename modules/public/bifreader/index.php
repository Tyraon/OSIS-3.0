<html>
<head>
<style>
body{margin:0px;}
</style>
</head>
<body>
<?php
@include('../../../class/file_handler.php');

$output = readFileOnDesktop(strtok($_GET['f'],'.'),substr(strstr($_GET['f'],'.'),1),'');
echo '<img src="'.$output.'" />';

?>
</body>
</html>