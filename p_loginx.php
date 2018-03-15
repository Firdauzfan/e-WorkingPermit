<?php 
require_once('Connections/konek.php'); 
if (isset($_POST['txtuser']) and isset($_POST['txtpasswd'])){
  $userid 		= $_POST['txtuser']; 
  $password		= md5($_POST['txtpasswd']);  
   
  $sql_1		= "SELECT * FROM tb_user WHERE no_id = '12078212' and password = '$password'";    
  $sql_query_1 	= mysql_query($sql_1, $konek) or die(mysql_error());
  $result_1		= mysql_fetch_array($sql_query_1);   
 
  $sql_2		= "SELECT * FROM `tb_user` WHERE `no_id` = '$userid' ";    
  $sql_query_2	= mysql_query($sql_2, $konek) or die(mysql_error());
  $result_2		= mysql_fetch_array($sql_query_2);  
    
  if ($result_1 and $result_2){
	session_start();	
	$_SESSION['userid']		= $userid;
	$_SESSION['bagian'] 	= $result_2['bagian'];	
	$_SESSION['lokasi']		= $tempat;	
	$_SESSION['nama']		= $result_2['nama'];
	$_SESSION['telp']		= $result_2['telp'];	
	header("Location: " . "inform.php" );
 }else{
 $pesan = 'User ID atau Password Salah';
 }
}	  
?>