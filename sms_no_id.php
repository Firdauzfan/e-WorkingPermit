<?php
//sms berdasarkan no id atau perorangan
if (isset($sms_no_id)){
	$Sql_sms		= "SELECT telp FROM tb_user where (no_id = '654321' or no_id = '$sms_no_id')";	
}
?>