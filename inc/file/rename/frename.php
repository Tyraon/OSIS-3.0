<?php
@include('../../../class/file_handler.php');
renameFileOnDesktop(strtok($_GET['f'],'.'),substr(strstr($_GET['f'],'.'),1),'',strtok($_GET['n'],'.'),substr(strstr($_GET['n'],'.'),1));
?>