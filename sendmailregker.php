<?php 
	if(isset($tempat)){
	$Sql_email		= "SELECT email FROM tb_user where (lokasi = '$tempat' and bagian = 'Admin' and status = 'Aktif') or no_id = '654321'";
	$r = mysql_query($Sql_email);

		while ($d=mysql_fetch_array($r)) {
		$emval=$d['email'];
		$tujuanfm .= $emval.",";
		}
		// $tujuan='firdauzfanani@gmail.com';
    	mail($tujuanfm, $sms_judul, $sms_pesan);	
	//echo $tujuanfm;
	}

?>