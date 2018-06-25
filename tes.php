<?php
require_once('Connections/konek.php');
$sms_no_id = '12078219';
include('sms_no_id.php');
if(isset($Sql_sms)){
$sql_query_sms 	= mysql_query($Sql_sms, $konek) Or die(mysql_error());
$result_sms 	= mysql_fetch_assoc($sql_query_sms);
do{
echo $result_sms['telp'];
echo "<br>";
}while ($result_sms 	= mysql_fetch_assoc($sql_query_sms));
}
?>

