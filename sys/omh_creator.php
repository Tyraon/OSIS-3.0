<?php
if(@$_GET['a']=="1") {
	if(@file_exists('.omh')){
		echo '<script>var mess = confirm("File already exists!\n\n Override?");
		if(mess == false){
			location.replace("omh_creator.php");
		} </script>';
	}
	if(@copy('blank.txt','.omh')) {
	$dsatz='#TITEL:'.$_POST['titel'].'
#AUTHOR:'.$_POST['author'].'
#IDX:'.$_POST['idx'].'
#VERS:'.$_POST['version'].':'.$_POST['core'];
	$fp = fopen('.omh','w');
	fwrite($fp,$dsatz);
	fclose($fp);
	echo 'File created!';}
}
?>
<form action="omh_creator.php?a=1" method="post">
<input name="titel" placeholder="Titel" /><br />
<input name="author" placeholder="Author" /><br />
<input name="idx" placeholder="Indexdatei (e.g. index.php)" /><br />
<select name="core" size="1">
<option value="mangos">Mangos</option>
<option value="trinity">Trinity</option>
<option value="other">Other</option>
<option value="free">Free</option>
</select><br />
<input name="version" type="number" min="0" max="10" value="1" /><br />
<input type="submit" value="Create" />
</form>