<?php
@include('../../../class/file_handler.php');
transferFileOnDesktop(strtok($_GET['f'],'.'),substr(strstr($_GET['f'],'.'),1),'',$_GET['touser']);
?>