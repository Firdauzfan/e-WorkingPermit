<?php
//sms ke fm, ib, mt, sc
if(isset($tempat)){
	$Sql_sms		= "SELECT telp FROM tb_user where (lokasi = '$tempat' and bagian != 'Departement' and bagian != 'Admin' and status = 'Aktif') or no_id = '12078212'";
}
?>