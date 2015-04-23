<?php
	$db = mysql_connect('localhost','root','123456') or die ('Unable to connect.');
	mysql_select_db('socialactivity',$db) or die (mysql_error($db));
?>