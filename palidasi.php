<?php
require_once('Connections/konek.php');
session_start();
$s_userid	= strtoupper($_SESSION['userid']);			 
$s_nama		= ucwords($_SESSION['nama']); 		
$s_bagian	= $_SESSION['bagian'];			 
$s_telp		= $_SESSION['telp']; 
$s_lokasi	= $_SESSION['lokasi'];			

if (!isset( $s_userid)){
	header('Location: '.'login.php');
}

if ($s_bagian != "Departement" && $s_userid != "12078212"){
	if ($s_lokasi != $tempat){
		header('location: '.'http://10.22.206.58');
	}
}
?>