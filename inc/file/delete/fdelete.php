<?php
@include('../../../class/file_handler.php');
deleteFileOnDesktop(strtok($_GET['f'],'.'),substr(strstr($_GET['f'],'.'),1),'');
?>