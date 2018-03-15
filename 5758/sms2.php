<?php
if(isset($Sql_sms)){
	$sql_query_sms 	= mysql_query($Sql_sms, $konek) Or die(mysql_error());
	$result_sms 	= mysql_fetch_assoc($sql_query_sms);	
	if ($result_sms){
		do {		
			$sms_hp		= $result_sms['telp'];
			$hitung		= strlen($sms_hp);
			$potong1	= substr($sms_hp,0,1);
			$potong2	= substr($sms_hp,0,2);	

			if ($hitung >9 and $hitung <15){
				if($potong1 == "8") {
					$no_fix	= "62".$sms_hp;				
				}
				if($potong2 == "+6") {
					$no_fix	= substr($sms_hp,1,$hitung-1);		
				}
				if($potong2 == "08") {
					$no_fix	= "62".substr($sms_hp,1,$hitung-1);			
				}
				if($potong2 == "62") {
					$no_fix	= $sms_hp;			
				}							
			@simplexml_load_file("http://jktbtrsmsapp01:8080/sapsms/fm5758.php?isi_pesan=$sms_pesan&daftar_MSISDN=$no_fix");
			}				
		} while ($result_sms = mysql_fetch_assoc($sql_query_sms));
	}	
}
?>