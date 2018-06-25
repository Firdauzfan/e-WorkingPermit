<?php 
	if(isset($tempat)){
	$Sql_email		= "SELECT email FROM tb_user where (bagian = 'admin' or no_id = '$sms_no_id')";
	$r = mysql_query($Sql_email);
		while ($d=mysql_fetch_array($r)) {
			$emval=$d['email'];
			$tujuan .= $emval.",";
			}
	mail($tujuan, $sms_judul, $sms_pesan);
	}

?>