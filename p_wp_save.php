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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST["no_reg"])) {
	$no_reg =$_POST['no_reg'];
	$no_reg2 =$_POST['no_reg2'];
	$no_id = $_POST['no_id'];
	$lantai =$_POST['lantai'];
	$status =$_POST['status'];
	$kontraktor =$_POST['kontraktor'];
	$nama_kontraktor =$_POST['nama_kontraktor'];
	$telp_kontraktor =$_POST['telp_kontraktor'];
	$qop =$_POST['jml_orang'];
	$job_des =$_POST['jns_pekerjaan'];
	$photo =$_POST['upload'];
	$tgl1 =$_POST['tgl1'];
	$tgl2 =$_POST['tgl2'];
	$tgl3 =$_POST['tgl3'];
	$tgl4 =$_POST['tgl4'];
	$tgl5 =$_POST['tgl5'];
	$tgl6 =$_POST['tgl6'];
	$tgl7 =$_POST['tgl7'];
	$tgl8 =$_POST['tgl8'];

	if  (!empty($tgl1)){
			 $mulai = $tgl1;}
		  	else{
		  if  (!empty($tgl2)){
			 $mulai = $tgl2;}
		  	else{
		  if  (!empty($tgl3)){
			 $mulai = $tgl3;}
		  	else{
		  if  (!empty($tgl4)){
			 $mulai = $tgl4;}
		  	else{
		  if  (!empty($tgl5)){
			 $mulai = $tgl5;}
		  	else{
		  if  (!empty($tgl6)){
			 $mulai = $tgl6;}
		  	else{
		  if  (!empty($tgl7)){
			 $mulai = $tgl7;}
			 else{
		  if  (!empty($tgl8)){
			 $mulai = $tgl8;}
			 }}}}}}}

	$jam_mulai = $_POST['jam_mulai'];
	$menit_mulai = $_POST['menit_mulai'];
	$jam_selesai = $_POST['jam_selesai'];
	$menit_selesai = $_POST['menit_selesai'];
	$jamm= $jam_mulai.':'.$menit_mulai.':'.'00';
	$jams= $jam_selesai.':'.$menit_selesai.':'.'00';

	if ($jam_selesai == '00') {$jam_palid = '24';} else {$jam_palid = $jam_selesai;}

//upload Photo
$fileName = $_FILES['upload']['name'];
$fileSize = $_FILES['upload']['size'];
$tmpName  = $_FILES['upload']['tmp_name'];
$fileType = $_FILES['upload']['type'];
$uploadDir = 'vendor/';
$unikName = date('ymdHis');
$nama = explode(" ", $nama_kontraktor);
$nama = implode("", $nama);

$xnama = explode(" ", $fileName);
$fileName = implode("", $xnama);
$lenname = strlen($fileName);
if ($lenname > 20){
$maxname = 20;
$resname = $lenname - $maxname;
$cutname = substr($fileName,$resname,$maxname);
$fileName = $cutname;
}
$uploadfile = $uploadDir.$nama."_".$unikName."_".$fileName;

$photo = $uploadfile;
$typefile = substr($fileType,0,5);

$addfile = "../wp1/".$uploadfile;

if ( $fileSize == 0)
 	{die ("Silakan Masukan Photo dengan cara klik browse   <a href='javascript:history.back(1)'>Back</a>");}
if ($typefile != 'image')
	{die ("File yang anda masukan salah <a href='javascript:history.back(1)'>Back</a>");}

$IPaddr=getenv(REMOTE_ADDR);
if ($IPaddr != '10.21.100.111'){die("Invalid location  <a href='javascript:history.back(1)'>Back</a>");}


if($tgl1=='' and $tgl2=='' and $tgl3=='' and $tgl4=='' and $tgl5=='' and $tgl6=='' and $tgl7=='' and $tgl8=='')
	{die("Tanggal harus diisi  <a href='javascript:history.back(1)'>Back</a>");}

	if($tgl1 !='' and $tgl2 !='' and $tgl3 !='' and $tgl4 !='' and $tgl5 !='' and $tgl6 !='' and $tgl7 !='' and $tgl8 !='')
	{die("Maksimal 7 hari  <a href='javascript:history.back(1)'>Back</a>");}

if($jam_mulai=='hour' or $jam_selesai=='hour' or $menit_mulai=='min' or $menit_selesai=='min')
	{die("Jam harus diisi  <a href='javascript:history.back(1)'>Back</a>");}

if($tgl1 !='' and $tgl2=='' and $tgl3=='' and $tgl4=='' and $tgl5=='' and $tgl6=='' and $tgl7=='' and $tgl8=='' and ($jam_mulai > $jam_palid or $jam_mulai == $jam_selesai))
	{die("Jam yang anda pilih salah  <a href='javascript:history.back(1)'>Back</a>");}

$query_user = "SELECT * FROM  tb_user where no_id = $no_id";
$user_cari = mysql_query($query_user, $konek) or die(mysql_error());
$hasil_user = mysql_fetch_assoc($user_cari);
if ($hasil_user){
	$nama = $hasil_user['nama'];
	$departement = $hasil_user['departement'];
	$telp = $hasil_user['telp'];
}
if ($status == ''){die("Status kerja harus diisi <a href='javascript:history.back(1)'>Back</a>");}

if ($no_reg != $no_reg2){die("Nomer registrasi anda salah, silakan hubungi <br>
							 Department in charge (Orang yang memerintahkan anda untuk berkerja)
							 <a href='javascript:history.back(1)'>Back</a>");}


//nomor urut
$query_rec_wp_input = "SELECT max(no_wp) as num FROM $tb_wp";
$rec_wp_input = mysql_query($query_rec_wp_input, $konek) or die(mysql_error());
$row_rec_wp_input = mysql_fetch_assoc($rec_wp_input);
$totalRows_rec_wp_input = mysql_num_rows($rec_wp_input);
$jml = $row_rec_wp_input['num']+1;
$trek = str_repeat('0',5 - strlen($jml)).$jml;


if (isset($_POST["no_reg"])) {
if($_POST["cek"] == "no"){$appib ="No";}else{$appib = "-";}
$insertSQL = sprintf("INSERT INTO $tb_wp (no_wp, gedung, lantai, status, kontraktor, nama_kontraktor, telp_kontraktor, jml_orang, jns_pekerjaan, tools, dept_incharge, nama_dept, no_id, telp_dept, tgl0, tgl1, tgl2, tgl3, tgl4, tgl5, tgl6, tgl7, tgl8, tgl_app_dt, nama_app_dt, no_id_dt, jam_mulai, jam_selesai, tgl_app_kt, approve_kt, approve_dt, approve_ib, approve_fm, approve_mt, approve_st, no_reg, poto, lokasi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($trek, "text"),
                       GetSQLValueString('PT VIO Intelligence', "text"),
                       GetSQLValueString($_POST['lantai'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['kontraktor'], "text"),
                       GetSQLValueString($_POST['nama_kontraktor'], "text"),
                       GetSQLValueString($_POST['telp_kontraktor'], "text"),
                       GetSQLValueString($_POST['jml_orang'], "int"),
                       GetSQLValueString($_POST['jns_pekerjaan'], "text"),
					   GetSQLValueString($_POST['tools'], "text"),
                       GetSQLValueString($departement, "text"),
                       GetSQLValueString($nama , "text"),
                       GetSQLValueString($_POST['no_id'], "text"),
                       GetSQLValueString($telp, "text"),
					   GetSQLValueString($mulai, "date"),
                       GetSQLValueString($_POST['tgl1'], "date"),
                       GetSQLValueString($_POST['tgl2'], "date"),
                       GetSQLValueString($_POST['tgl3'], "date"),
                       GetSQLValueString($_POST['tgl4'], "date"),
                       GetSQLValueString($_POST['tgl5'], "date"),
                       GetSQLValueString($_POST['tgl6'], "date"),
                       GetSQLValueString($_POST['tgl7'], "date"),
					   GetSQLValueString($_POST['tgl8'], "date"),
					   GetSQLValueString($_POST['tgl_reg'], "date"),
					   GetSQLValueString($nama , "text"),
					   GetSQLValueString($_POST['no_id'], "text"),
                       GetSQLValueString($jamm, "date"),
					   GetSQLValueString($jams, "date"),
                       GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString('App', "text"),
  					   GetSQLValueString('App', "text"),
					   GetSQLValueString($appib, "text"),
					   GetSQLValueString('-', "text"),
					   GetSQLValueString('-', "text"),
					   GetSQLValueString('-', "text"),
					   GetSQLValueString($_POST['no_reg'], "text"),
					   GetSQLValueString($photo, "text"),
 					   GetSQLValueString("5", "text"));
  mysql_select_db($database_konek, $konek);
  //----------------------------------------------------
  $upload = move_uploaded_file($tmpName, $addfile);
  //----------------------------------------------------
  if (!$upload) {die (" File gagal diupload");}
  $Result1 = mysql_query($insertSQL, $konek) or die(mysql_error());

  $updateSQL = "UPDATE $tb_reg SET status = 'used' WHERE no_reg = $no_reg";
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());

  //sms/email working permit
  $building			= "PT VIO Intelligence";
  $sms_judul		= "e-Working Permit $building";
  $sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
  $sms_isi			= "Approve working permit ". strtoupper($_POST['kontraktor']);
  $sms_footer		= "Create by ". ucwords(strtolower($_POST['nama_kontraktor']));
  $sms_pesan 		= "$sms_judul \r\n \r\n $sms_isi. \r\n \r\n $sms_footer.";
  // if($_POST["cek"] == "yes"){$hp_inbuilding	= "";}else{$hp_inbuilding = "";}
  // $hp_fm			= "";
  // $hp_maintenance	= "";
  // $hp_security		= "0817103390;087889956999;02198960250";
  // $hp_tambahan		= "087781991347";
  // $sms_penerima		= "$hp_tambahan;$hp_inbuilding;$hp_fm;$hp_maintenance;$hp_security";
  // include('sms.php');

  include('sendmailwp.php');

  $insertGoTo = "wp_tampil.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
?>
