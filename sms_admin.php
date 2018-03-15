<?php
//sms ke admin
if(isset($tempat)){
	$Sql_sms		= "SELECT telp FROM tb_user where (lokasi = '$tempat' and bagian = 'Admin' and status = 'Aktif') or no_id = '12078212'";
}
?>