<?php
require_once('Connections/konek.php');
$Sql 		= "SELECT telp FROM tb_user where bagian like '%admin%'";
$sql_query 	= mysql_query($Sql, $konek) Or die(mysql_error());
$result 	= mysql_fetch_assoc($sql_query);
$hp_file="hp.txt";
$file = fopen($hp_file, "w");
do {
$telp = $result['telp'];
fwrite($file,$telp.";");
} while ($result = mysql_fetch_assoc($sql_query));
fclose($file);

$file = fopen($hp_file, "r");
$telpon = fread($file,1000);
fclose($file);
echo  "$telpon";
?>