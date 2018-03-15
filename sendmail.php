<?php 
	if(isset($tempat)){
	$Sql_email		= "SELECT email FROM tb_user where (lokasi = '$tempat' and bagian = 'Facility Management' and status = 'Aktif') or no_id = '654321'";
	$r = mysql_query($Sql_email);

		while ($d=mysql_fetch_array($r)) {
		$emval=$d['email'];
		$tujuan .= $emval.",";
		}
	mail($tujuan, $sms_judul, $sms_pesan);
	}

?>