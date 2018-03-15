<?php 
include('palidasi.php'); 
if ($s_bagian != 'Facility Management'){ header('Location: '.'login.php');}

if (isset($_GET['no'])) {
  $G_no 		= $_GET['no'];   
  // Mecari No ID In charge
  $Sql 			= "SELECT * FROM $tb_reg WHERE md5(no) = '$G_no'";
  $sql_query 	= mysql_query($Sql, $konek) Or die(mysql_error());
  $result 		= mysql_fetch_assoc($sql_query);
  $incharge		= $result['no_id'];
  $vendor		= $result['kontraktor'];
  $no_regs		= $result['no_reg'];
  
  if($no_regs == "" || $no_regs == "-"){  
	// nomor registrasi
	$rand1 		= rand(1,9);
	$rand2 		= rand(2,9);
	$no_reg1 	= date('mi');
	$no_reg2 	= date('dyhs');
	$no_reg 	= $rand2.$no_reg1.$rand1.$no_reg2;
  
	// Update no registrasi	
	$sql 			= "UPDATE $tb_reg SET status = 'App', no_reg = '$no_reg', app_by = '$s_userid', app_from = '$ip_komp', app_time = '$time' WHERE md5(no) = '$G_no'";   
	$Result 		= mysql_query($sql, $konek) or die(mysql_error());  
  	
	//sms working permit	
	$sms_judul		= "e-WP $building";
	$sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
	$sms_isi		= "Use this number $no_reg, to create e-working permit $vendor";
	$sms_footer		= "Approve by ".$_SESSION['nama'];
	$sms_pesan 		= "$sms_judul. \r\n \r\n $sms_isi. \r\n \r\n $sms_footer.";	
	//sms ke In Charge departemen
	$sms_no_id		= $incharge;
	// include('sms_no_id.php');
	// include('sms2.php');
	include('sendmailfm.php');
  }	
}
header("Location: " . "reg_list_app.php" );	
?>