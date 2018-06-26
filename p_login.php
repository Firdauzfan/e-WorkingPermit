<?php 
$userid = strtoupper($_POST['txtuser']); 
if (isset($_POST['txtuser']) && $_POST['txtuser'] != "" && $_POST['txtpasswd'] != ""){  
  $password		= md5($_POST['txtpasswd']); 
  $sql			= "SELECT * FROM tb_user WHERE upper(no_id) = '$userid'";    
  $sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
  $result 		= mysql_fetch_array($sql_query); 
  $nama 		= $result['nama'];
  $telp 		= $result['telp'];
  $passwd 		= $result['password']; 
  $status 		= $result['status'];
  $lokasi 		= $result['lokasi'];
  $salah  		= $result['salah'] + 1;
  $hapus		= $result['hapus'];
  $bagian 		= $result['bagian'];
  $id 			= substr($userid,0,3);
  $employee		= "0";
  
if($lokasi == 1){
	$clokasi = "Graha Sumber Prima Elektronik";}
	elseif($lokasi == 2){
		$clokasi = "VIO Intelligence";}
		elseif($lokasi == 3){
			$clokasi = "";}
			elseif($lokasi == 4){
				$clokasi = "";}
				elseif($lokasi == 5){
					$clokasi = "";}
					elseif($lokasi == 6){
						$clokasi = "";}
						elseif($lokasi == 7){
							$clokasi = "";}
							elseif($lokasi == 8){
								$clokasi = "";}
								elseif($lokasi == 9){
									$clokasi = "";}
									elseif($lokasi == 10){
										$clokasi = "";}
										elseif($lokasi == 11){
											$clokasi = "";}
  
   if($id == "900" and $lokasi != "$tempat"){
	   $lokasi 	= "$tempat";
	   $bagian  = "Departement"	;
   }
  
  if($bagian == "Departement" or $userid == "654321"){
	$lokasi 	= "$tempat";	
  }       
  if (!$result){
	  $pesan = " User ID $userid salah atau belum terdaftar";	 
  }elseif ($status == 'Waiting' ){
		   $pesan = "Maaf User ID anda Sedang menunggu konfirmasi dari admin, silakan hubungi Admin
		   untuk mempercepat proses pengaktifan User Id anda.<br> <a href='info.php'>Klik di sini
		   untuk mendapatkan Informasi Admin</a>";		   
	   }elseif ($salah > 3){
			   $pesan = "Maaf password anda sudah lebih dari 3 kali salah, silakan hubungi Admin yang ada pada menu info untuk 
			   mengaktifkan kembali account anda";				     
		   }elseif ($status == 'Nonaktif' || $status == 'Delete'){
				   $pesan = "Maaf User ID anda tidak bisa Login, silakan hubungi Admin yang ada pada menu info untuk mengaktifkan
				    kembali account anda";	  
			   }elseif ( $lokasi != "$tempat" ){
					   $pesan = "Anda hanya diperbolehkan login di $clokasi";					  
				   }elseif ($passwd != $password) {
						   $sql = "UPDATE tb_user SET salah = '$salah', last_login = '$time' WHERE no_id = '$userid' and no_id != '12078212'";
						   $result1 = mysql_query($sql, $konek) or die(mysql_error());
						   $pesan = "Password Anda Salah";
					   }else{			   
						   session_start();
						   $_SESSION['userid'] 			= $userid;   
						   $_SESSION['bagian'] 			= $bagian;	
						   $_SESSION['lokasi']			= $lokasi;	
						   $_SESSION['nama'] 			= $nama;	
						   $_SESSION['telp']			= $telp;
						   //update nilai salah menjadi 0
						   $sql = "UPDATE tb_user SET salah = 0, last_login = '$time' WHERE no_id = '$userid'";		
						   $Result1 = mysql_query($sql, $konek) or die(mysql_error()); 
						   
						   if ($bagian == "Admin"){
							   header("Location: " . "wp_list.php" );
						   }elseif ($bagian == "Departement"){
							   header("Location: " . "inform.php" );
						   }else{
							   header("Location: " . "wp_list_app.php" );
						   }
					   }
}else{
	$pesan = "User ID dan password harus diisi";
}
?>