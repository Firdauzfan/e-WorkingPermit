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
			@simplexml_load_file("http://10.195.7.8:55000/webpush/push.jsp?APP_ID=basxl&APP_PWD=qyr2d5&DEST_ADDR=$no_fix&SOURCE_ADDR=5444&SHORT_NAME=bulkxlbas&PROTOCOL_ID=0F&MSG_CLASS=1&REGISTERED=yes&TEXT=$sms_pesan");
			}				
		} while ($result_sms = mysql_fetch_assoc($sql_query_sms));
	}	
}
?>
