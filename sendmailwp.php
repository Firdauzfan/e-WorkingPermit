<?php 
	if(isset($tempat)){
	$Sql_email		= "SELECT email FROM tb_user where lokasi = '$tempat' and bagian = 'Facility Management' or bagian ='Maintenance' or bagian='Security' and status = 'Aktif'";
	$r = mysql_query($Sql_email);

	while ($d=mysql_fetch_array($r)) {
	$emval=$d['email'];
	// $tujuan = echo $emval.",";
	}
	}
	// $tujuan='firdauzfanani@gmail.com';
    mail($tujuan, $sms_judul, $sms_pesan);

?>