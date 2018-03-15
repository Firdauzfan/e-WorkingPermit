<?php
//Paging
$hal 	= $_GET['hal'];

if(!isset($_GET['hal'])){
	$page = 1;
}else{
	$page = $_GET['hal'];
} 

$maxRows 	= 15;
$startRow 	= (($page * $maxRows) - $maxRows);  
$sekarang 	= gmdate('Ymd', time()+60*60*7);
//nomor urut
$nomer = ($page-1) * $maxRows; 
?>