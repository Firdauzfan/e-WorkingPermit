<?php
//sms ke FM
if(isset($tempat)){
	$Sql_sms		= "SELECT telp FROM tb_user where (lokasi = '$tempat' and bagian = 'Facility Management' and status = 'Aktif') or no_id = '567890'";
}
?>