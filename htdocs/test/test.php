<html>
<head>
<title> PHP Testing </title>
</head>
<body>
<?php
$db = mysql_connect('localhost','root','123456') or die ('Unable to connect.');
mysql_select_db('socialactivity',$db) or die (mysql_error($db));
echo "<p> If you see this then we did it right! </p>";

$query = "SELECT * FROM USERS";
$query_result = mysql_query($query,$db);
while ( $row = mysql_fetch_array($query_result)){
	print_r($row);
	echo "<br>";
}
?>
</body>
</html>