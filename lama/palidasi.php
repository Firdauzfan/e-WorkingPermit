<?php
session_start();
$userid = $_SESSION['MM_Username'] ;   
$bagian = $_SESSION['bagian'];	
$lokasi = $_SESSION['lokasi'];

if (!isset( $userid)) {header('Location: '.'login.php');} 
if ($lokasi != '3') {header('location: '.'..');}
?>