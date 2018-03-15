<?php 
require_once('Connections/konek.php'); 
if (isset($_GET['no_wp'])) {
  $no_wp = $_GET['no_wp'];      
  $sql			= "SELECT * FROM $tb_wp WHERE no_wp = '$no_wp'";    
  $sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
  $result 		= mysql_fetch_array($sql_query); 
  $status		= $result['sts']; 
  
  if ($status == 'Yes') {  
  		$sql2 = "UPDATE $tb_wp SET sts = 'No' WHERE no_wp = '$no_wp'";		
	}else {
  		$sql2 = "UPDATE $tb_wp SET sts = 'Yes' WHERE no_wp = '$no_wp'";		
	}	 
 	 $Result2 = mysql_query($sql2, $konek) or die(mysql_error()); 	
	 header("Location: " . "wp_list.php" );	
} 
?>