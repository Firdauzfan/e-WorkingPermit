<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
session_start();
require_once('Connections/konek.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$no_id = $_SESSION['MM_Username']; 
mysql_select_db($database_konek, $konek);  
$strquery = "SELECT  * FROM tb_user where no_id = '$no_id'";
$hasil = mysql_query($strquery, $konek) or die(mysql_error());
$aray = mysql_fetch_assoc($hasil);
$nama = $aray['nama'];
$noid = $aray['no_id'];
$bagian = $aray['bagian'];
 	 
  
if ((isset($_GET['no_wp'])) && ($_GET['no_wp'] != "")) {
  $updateSQL = sprintf("UPDATE $tb_wp SET approve_dt=%s, tgl_app_dt=%s, nama_app_dt=%s, no_id_dt=%s WHERE `no_wp`=%s",
                       GetSQLValueString("App", "text"),					  
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString("$nama", "text"),
					   GetSQLValueString("$noid", "text"),
                       GetSQLValueString($_GET['no_wp'], "text"));

  mysql_select_db($database_konek, $konek);
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
  $updateGoTo = "wp_app_di.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>


