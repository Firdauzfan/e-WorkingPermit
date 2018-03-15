<?php require_once('Connections/konek.php'); ?>
<?php
if (isset($_POST['txtuser'])){
  $userid = $_POST['txtuser']; 
  $password=md5($_POST['txtpasswd']); 
   mysql_select_db($database_konek, $konek);   
 
  $LoginRS__query= "SELECT * FROM `tb_user` WHERE `no_id` = '$userid' ";    
  $LoginRS = mysql_query($LoginRS__query, $konek) or die(mysql_error());
  $loginFoundUser = mysql_fetch_array($LoginRS); 
  $passwd = $loginFoundUser['password'];
  $bagian = $loginFoundUser['bagian'];
  $status = $loginFoundUser['status'];
  $lokasi = $loginFoundUser['lokasi'];
  $salah = $loginFoundUser['salah'] + 1; 
  
  $id = substr($userid,0,3);
  
  if($id == "900" and $lokasi != "3")
  {
	  $bagian = "Departement";
	  $lokasi = "3";  		
  } 
  
  if($userid == "12078212")
  {
	  $lokasi ="3";
  }

   
   if ( $lokasi != "3")
   {
	   die("<font size = '5'>Access Denied (policy_denied)</font>
		<br>Please select your location register
		<br> <a href='http://bdgdrcewpjnb01/'>Back</a>
		");

   }
   
 
   if (!$loginFoundUser){
	    echo "Maaf User ID Anda tidak terdaftar <a href='javascript:history.back(1)'>Back</a>";} 
  else{
	  if ($status == 'Waiting' ){
	  echo "Maaf User ID anda Sedang menunggu konfirmasi dari admin,<br> silakan hubungi Admin untuk mempercepat proses pengaktifan user id anda.<br> <a href='info.php'>Klik di sini untuk mendapatkan Informasi lebih lanjut</a>"; } 	
  else{ 
  if ($salah > 3 or $status == 'Nonaktif' ){
	  echo "Maaf User ID anda tidak bisa Login, silakan hubungi Admin untuk mengaktifkan kembali account anda <a href='index.php'>Back</a>"; } 	
  else{ 
   if ($passwd != $password) {
	  $sql = "UPDATE `wp_db`.`tb_user` SET `salah` = $salah WHERE `tb_user`.`no_id` = '$userid'";
	  mysql_select_db($database_konek, $konek);
 	 $Result1 = mysql_query($sql, $konek) or die(mysql_error()); 
	  echo "Password Anda Salah <a href='javascript:history.back(1)'>Back</a>";} 
	  else {
	
	session_start();
	$_SESSION['MM_Username'] =  $userid;   
	$_SESSION['bagian'] = $bagian;	
	$_SESSION['lokasi'] = $lokasi;
	
	$sql = "UPDATE `wp_db`.`tb_user` SET `salah` = 0 WHERE `tb_user`.`no_id` = '$userid'";	
	mysql_select_db($database_konek, $konek);
 	$Result1 = mysql_query($sql, $konek) or die(mysql_error()); 
	
	if ($bagian == "Admin"){
		header("Location: " . "wp_list_adm.php" );}
	 else{
		 if ($bagian == "Departement"){
		header("Location: " . "inform.php" );}
	 else{
		 header("Location: " . "wp_list_app.php" );}  
	  }}}}}}
	  
?>