<?php
require_once('Connections/konek.php');
$sql 		= "SELECT (telp) FROM tb_user where bagian = 'Security' and lokasi = 9 and status = 'Aktif'";
$sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
$result		= mysql_fetch_assoc($sql_query); 
do { 
	$t	= $result['telp'];
	$tl = $tl.$t.';';	
}while ($result = mysql_fetch_assoc($sql_query)); 
echo $tl;
?>
