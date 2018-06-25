<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
session_start();
require_once('Connections/konek.php'); 

if(isset($_POST['pesan']) && !empty($_POST['pesan']) ){
	$no_wppes = $_GET['no_wp'];
	$pesan= $_POST['pesan'];

	$sqlpes = "SELECT * FROM $tb_wp WHERE md5(no_wp) = '$no_wppes'";
	$sqlquerypes = mysql_query($sqlpes,$konek) or die(mysql_error());
	$rowepes = mysql_fetch_assoc($sqlquerypes);

	$judul=$rowepes['kontraktor'];
	$no_id_incharge= $rowepes['no_id'];

	$s_useridpes	= $_SESSION['userid'];

	$sqlpes1 = "SELECT email FROM tb_user where no_id = '$no_id_incharge'";
	$sqlquerypes1 = mysql_query($sqlpes1,$konek) or die(mysql_error());
	$rowepes1 = mysql_fetch_assoc($sqlquerypes1);

	$sqlpes2 = "SELECT bagian FROM tb_user where no_id = '$s_useridpes'";
	$sqlquerypes2 = mysql_query($sqlpes2,$konek) or die(mysql_error());
	$rowepes2 = mysql_fetch_assoc($sqlquerypes2);

	$email_incharge= $rowepes1['email'];
	$bagian_incharge= $rowepes2['bagian'];

	$email_judul= "Reject e-Working Permit $judul";
	$email_footer= "Rejected by $bagian_incharge";

	$pesanreject="$email_judul \r\n \r\n $pesan. \r\n \r\n $email_footer.";

	mail($email_incharge,$email_judul, $pesanreject);
}

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
$s_userid	= $_SESSION['userid'];
$strquery 	= "SELECT  * FROM tb_user where no_id = '$s_userid'";
$hasil 		= mysql_query($strquery, $konek) or die(mysql_error());
$aray 		= mysql_fetch_assoc($hasil);
$nama 		= $aray['nama'];
$noid 		= $aray['no_id'];
$bagian 	= $aray['bagian'];
 
  if ($bagian == "Departement"){
	 $app_id 	= "approve_dt";
	 $tgl_app 	= "tgl_app_dt";
	 $nama_app 	= "nama_app_dt";
	 $no_id 	= "no_id_dt";}
	 else  if ($bagian == "Security"){
	 $app_id 	= "approve_st";
	 $tgl_app 	= "tgl_app_st";
	 $nama_app	= "nama_app_st";
	 $no_id 	= "no_id_st";}
	 else  if ($bagian == "Facility Management"){
	 $app_id 	= "approve_fm";
	 $tgl_app 	= "tgl_app_fm";
	 $nama_app 	= "nama_app_fm";
	 $no_id 	= "no_id_fm";}
	 else  if ($bagian == "Kontraktor"){
	 $app_id 	= "approve_kt";
	 $tgl_app 	= "tgl_app_kt";
	 $nama_app 	= "nama_app_kt";
	 $no_id 	= "no_id_kt";}
	 else  if ($bagian == "Maintenance"){
	 $app_id 	= "approve_mt";
	 $tgl_app 	= "tgl_app_mt";
	 $nama_app 	= "nama_app_mt";
	 $no_id 	= "no_id_mt";}
	 else  if ($bagian == "In Building"){
	 $app_id 	= "approve_ib";
	 $tgl_app 	= "tgl_app_ib";
	 $nama_app 	= "nama_app_ib";
	 $no_id 	= "no_id_ib";}
	 else{header("Location: " . "login.php" ); return false;}
	   
if ((isset($_GET['no_wp'])) && ($_GET['no_wp'] != "")) {
$no_wp = $_GET['no_wp'];
$sql = "SELECT * FROM $tb_wp WHERE md5(no_wp) = '$no_wp'";
$sqlquery = mysql_query($sql,$konek) or die(mysql_error());
$rowe = mysql_fetch_assoc($sqlquery);

 $appib = $rowe['approve_ib'];
 $noib = $rowe['no_id_ib'];
 $nofm = $rowe['no_id_fm'];
 $nomt = $rowe['no_id_mt'];
 
if ($bagian == "Security"){	
	 $apps= $rowe['approve_st'];	 
	}
	 else  if ($bagian == "Facility Management"){	
	 $apps= $rowe['approve_fm'];
	}	
	 else  if ($bagian == "Maintenance"){	
	 $apps= $rowe['approve_mt'];
	}
	 else  if ($bagian == "In Building"){	
	 $apps= $rowe['approve_ib'];
	}


}
	 
	 
if ($apps == "-" || $apps == "" || $apps=="App"){
if ($bagian == "In Building" and $appib =='-'){	
$updateSQL = sprintf("UPDATE $tb_wp SET $app_id=%s, $tgl_app=%s, $nama_app=%s, $no_id=%s WHERE md5(no_wp)=%s",
                       GetSQLValueString("Reject", "text"),					  
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString("$nama", "text"),
					   GetSQLValueString("$noid", "text"),
                       GetSQLValueString($_GET['no_wp'], "text"));

  
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
} 
if ($bagian == "Facility Management" and $appib != "-"){	
$updateSQL = sprintf("UPDATE $tb_wp SET $app_id=%s, $tgl_app=%s, $nama_app=%s, $no_id=%s WHERE md5(no_wp)=%s",
                       GetSQLValueString("Reject", "text"),					  
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString("$nama", "text"),
					   GetSQLValueString("$noid", "text"),
                       GetSQLValueString($_GET['no_wp'], "text"));

 
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
}
if ($bagian == "Maintenance" and $nofm != ""){	
$updateSQL = sprintf("UPDATE $tb_wp SET $app_id=%s, $tgl_app=%s, $nama_app=%s, $no_id=%s WHERE md5(no_wp)=%s",
                       GetSQLValueString("Reject", "text"),					  
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString("$nama", "text"),
					   GetSQLValueString("$noid", "text"),
                       GetSQLValueString($_GET['no_wp'], "text"));

 
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
}
if ($bagian == "Security" and $nomt != ""){	
$updateSQL = sprintf("UPDATE $tb_wp SET $app_id=%s, $tgl_app=%s, $nama_app=%s, $no_id=%s WHERE md5(no_wp)=%s",
                       GetSQLValueString("Reject", "text"),					  
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString("$nama", "text"),
					   GetSQLValueString("$noid", "text"),
                       GetSQLValueString($_GET['no_wp'], "text"));

 
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
}
}
  $updateGoTo = "wp_app.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));

?>