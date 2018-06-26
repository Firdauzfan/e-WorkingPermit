<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin'){ header('Location: '.'login.php');}	 
	
	if (isset($_GET['no_id'])) {
	  $no_id 	= $_GET['no_id']; 
	  $link 	= $_GET['link'];
	   
	  $sql 			= "SELECT * FROM `tb_user` WHERE `no_id` = '$no_id'"; 	 
	  $sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
	  $result 		= mysql_fetch_array($sql_query); 
	  $status 		= $result['status']; 
	  $bagian 		= $result['bagian']; 
	  $telp			= $result['telp'];
	  $g_nama		= $result['nama'];	 
	  
	  if ($result){ 		  
			$sms_judul		= "e-WP $building";
			$sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
			  if ($status == 'Waiting') {  
					$sql2 = "UPDATE tb_user SET status = 'Aktif', app_by = '$s_userid', app_time = '$time', app_from = '$ip_komp' WHERE no_id = '$no_id'";
					$Result1 = mysql_query($sql2, $konek) or die(mysql_error()); 	
					//sms working permit						
					$sms_isi		= "Account anda telah diaktifkan silahkan login untuk request e-working permit di http://35.202.49.101/e-WorkingPermit/login.php";
					$sms_footer		= "Approved by ".$_SESSION['nama'];
					$sms_pesan 		= "$sms_judul. $sms_waktu WIB. $sms_isi. $sms_footer.";					
					//sms ke user
					$sms_no_id	= $no_id;
					// include('sms_no_id.php');
					// include('sms2.php');
					include('sendmailstatus.php');
			  }elseif ($status == 'Aktif') { 
				if ($no_id != $s_userid){
					$sql2 = "UPDATE tb_user SET `status` = 'Nonaktif' WHERE no_id = '$no_id'";
					$Result1 = mysql_query($sql2, $konek) or die(mysql_error()); 	
					//sms working permit						
					$sms_isi		= "Account $g_nama($no_id) telah dinonaktifkan";
					$sms_footer		= "oleh ".$_SESSION['nama'];
					$sms_pesan 		= "$sms_judul. $sms_waktu WIB. $sms_isi $sms_footer.";					
					//sms ke user
					$sms_no_id	= $no_id;
					// include('sms_tes.php');
					// include('sms2.php');
					include('sendmailstatus.php');
					}
			  }else{	  
					$sql2 = "UPDATE tb_user SET `status` = 'Aktif' WHERE no_id = '$no_id'";
					$Result1 = mysql_query($sql2, $konek) or die(mysql_error()); 	
					//sms working permit						
					$sms_isi		= "Account $g_nama($no_id) telah diaktifkan kembali";
					$sms_footer		= "oleh ".$_SESSION['nama'];
					$sms_pesan 		= "$sms_judul. $sms_waktu WIB. $sms_isi $sms_footer.";					
					//sms ke user
					$sms_no_id	= $no_id;
					// include('sms_no_id.php');
					// include('sms2.php');
					include('sendmailstatus.php');
			  }					
			}			
	header("Location: " . $link );	
}
?>
