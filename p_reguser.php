<?php 
require_once('Connections/konek.php');
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

if (isset($_POST["no_id"])) {
	$userid 	= $_POST["no_id"];
	$sqlcariid	= "SELECT * FROM `tb_user` WHERE `no_id` = $userid"; 
	$hasil 		= mysql_query($sqlcariid,$konek) or die(mysql_error());
	$FoundUser 	= mysql_fetch_array( $hasil); 
	
	if ($FoundUser){
		echo 'Nomor ID anda telah terdaftar silahkan login terlebih dahulu untuk menganjukan ijin kerja<br>
		<a href =" login.php">Klik disini untuk Login</a>';
	}else{
		function antiinjection($data){
			$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
			return $filter_sql;
		}
		
		$ip			=getenv(REMOTE_ADDR);
		$job_des 	= $_POST['job_des'];
		$job_des	= antiinjection($job_des);
		
		$nama_user		= $_POST['nama'];		
		// upload photo  
		$fileName 	= $_FILES['upload']['name'];  
		$fileSize 	= $_FILES['upload']['size'];
		$tmpName  	= $_FILES['upload']['tmp_name'];
		$fileType 	= $_FILES['upload']['type'];
		//penamaan photo
		$tglupload 	= date('ymdHis');
		$fileName	= explode(" ", $fileName);
		$fileName 	= implode("", $fileName);
		//hitung jumlah karakter nama file
		$lenname 	= strlen($fileName);
		//pemotongan nama file
		if ($fileName > 20){
			$maxname 	= 20;
			$resname 	= $lenname - $maxname;
			$cutname 	= substr($fileName,$resname,$maxname);
			$fileName 	= $cutname;
		}
		//edit nama user yang diinput
		$nama_user	= explode(" ", $nama_user);
		$nama_user	= implode("", $nama_user);	
		
		//Folder tujuan penyimpanan file	
		$nama_poto	= $nama_user."_".$tglupload."_".$fileName;
		$uploadfile	= "poto/".$nama_poto;
		$tempatfile = "../wp1/".$uploadfile;		
		
		//nama file yang disimpan di database
		$photo 		= $uploadfile;
		$typefile 	= substr($fileType,0,5);
		
		if ($fileName == '' || $fileSize == 0){
			die ("Silakan Masukan Photo <a href='javascript:history.back(1)'>Back</a>");
		}elseif($typefile != 'image'){
			die ("File yang anda masukan salah <a href='javascript:history.back(1)'>Back</a>");
		}else{
			$upload = move_uploaded_file($tmpName, $tempatfile);
			if (!$upload){
				die (" File gagal diupload");
			}
		}		
		//end upload
				
		$insertSQLa = sprintf("INSERT INTO tb_user 
		(no_id, nama, email, password, telp, bagian, status, departement, photo, title, lokasi)
		VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['no_id'], "text"),					  
						   GetSQLValueString(ucwords($nama_user), "text"),
						   GetSQLValueString(strtolower($_POST['email']), "text"),
						   GetSQLValueString(md5($_POST['password']), "text"),
						   GetSQLValueString($_POST['telp'], "text"),
						   GetSQLValueString('Departement', "text"),
						   GetSQLValueString('Waiting', "text"),
						   GetSQLValueString(ucwords($_POST['departement']), "text"),
						   GetSQLValueString($uploadfile, "text"),
						   GetSQLValueString(ucwords($_POST['title']), "text"),
						   GetSQLValueString($tempat, "text"));
		$Resulta = mysql_query($insertSQLa, $konek) or die(mysql_error());
		
		$insertSQLb = sprintf("INSERT INTO $tb_reg (no_id, no_reg, kontraktor, job_des, qop, date,  lantai, ip, mulai, selesai, lokasi)
		VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['no_id'], "text"),		
						   GetSQLValueString('-', "text"),	
						   GetSQLValueString(strtoupper($_POST['kontraktor']), "text"),
						   GetSQLValueString(ucwords($job_des), "text"),
						   GetSQLValueString($_POST['qop'], "text"),
						   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
						   GetSQLValueString($_POST['lantai'], "text"),	
						   GetSQLValueString($ip, "text"),	
						   GetSQLValueString($_POST['mulai'], "text"),					  
						   GetSQLValueString($_POST['selesai'], "text"), 
						   GetSQLValueString($tempat, "text"));
		$Resultb = mysql_query($insertSQLb, $konek) or die(mysql_error());	
		header("Location: " . "reg_req.php" );
	}
}
?>