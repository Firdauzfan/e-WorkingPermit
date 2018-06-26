<?php 
	if(isset($tempat)){
	$Sql_email		= "SELECT email FROM tb_user where no_id = '$p_no_id'";
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