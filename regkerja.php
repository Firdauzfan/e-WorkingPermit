<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
$pesan = "";

 if ((isset($_POST["no_id"])) && ($_POST["no_id"] != "")) {	 
	 $p_no_id 		= strtoupper($_POST['no_id']);
	 $p_nama 		= $_POST['nama'];
	 $p_dept 		= $_POST['departement'];
	 $p_email 		= $_POST['email'];
	 $p_telp 		= $_POST['telp'];
	 $p_ext 		= $_POST['ext'];
	 $p_title 		= $_POST['title'];	
	 $p_password	= md5($_POST['password']);
	 $p_password1	= $_POST['password'];	
	 
	 // upload photo
	 $fileName 		= $_FILES['upload']['name']; 
	 $fileSize 		= $_FILES['upload']['size'];
	 $tmpName  		= $_FILES['upload']['tmp_name'];
	 $fileType 		= $_FILES['upload']['type'];
	 //penamaan photo
	 $tglupload 	= gmdate('ymdHis',time()+60*60*7);
	 $fileName		= explode(" ", $fileName);
	 $fileName 		= implode("", $fileName);
	 //hitung jumlah karakter nama file
	 $lenname 		= strlen($fileName);
	 //pemotongan nama file
	 if ($lenname > 20){
		 $maxname 	= 20;
		 $resname 	= $lenname - $maxname;
		 $cutname 	= substr($fileName,$resname,$maxname);
		 $fileName 	= $cutname;
	 }
	 //edit nama user yang diinput
	 $ex_nama		= explode(" ", $p_nama);
	 $im_nama		= implode("", $ex_nama);	
	 //Folder tujuan penyimpanan file	
	 $nama_poto		= $im_nama."_".$p_no_id."_".$tglupload."_".$fileName;
	 $uploadfile	= "poto/".$nama_poto;
	 $tempatfile 	= "$uploadfile";	
	 //nama file yang disimpan di database
	 $photo 		= $uploadfile;
	 $typefile 		= substr($fileType,0,5); 	 
	 
	 if ($fileName == '' || $fileSize == 0){
		 $pesan = "Silakan Masukan Photo";
	 }elseif($typefile != 'image'){
		 $pesan = "File yang anda masukan salah";
	 }elseif($fileSize > 200000){
		 $pesan = "Ukuran file Photo maksimal 200 kb";
	 }else{
		 $sql 			= "SELECT * FROM `tb_user` WHERE upper(no_id) = '$p_no_id'";
		 $sql_query 	= mysql_query($sql,$konek) or die(mysql_error());
		 $result 		= mysql_fetch_assoc($sql_query);
		 if ($result){
			 $pesan = " Nomor ID telah Terdaftar";
		 }else{
			 $upload = move_uploaded_file($tmpName, $tempatfile);
			 if (!$upload){
				 $pesan = "File gagal diupload";
			 }
			 $sql = "INSERT INTO tb_user 
			 (no_id, nama, email, password, telp, bagian, departement, photo, lokasi, title, reg_from, reg_time, ext, status) 
			 VALUES
			 ('$p_no_id','$p_nama','$p_email','$p_password', '$p_telp', 'Departement', '$p_dept', '$photo', '$tempat', '$p_title',
			 '$ip_komp', '$time', '$p_ext', 'Waiting')";   
			 
			 $Result1 = mysql_query($sql, $konek) or die(mysql_error());
			 if($Result1){
				 $pesan 		= "Register Berhasil, account anda sedang menunggu konfirmasi dari admin";
				 //sms working permit	
				 $cNama			= strtoupper($p_nama);
				 $sms_judul		= "e-WP $building";  
				 $sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
				 $sms_isi		= "$cNama ($p_telp) has been registered with No ID $p_no_id, please check this user";				
				 $sms_pesan 	= "$sms_judul. $sms_waktu WIB. $sms_isi.";
				 //sms ke Admin
				 include('sms_admin.php');
				 include('sms2.php'); 
				 
				 $p_no_id 		= "";
				 $p_nama 		= "";
				 $p_dept 		= "";
				 $p_email 		= "";
				 $p_telp 		= "";
				 $p_ext 		= "";
				 $p_title 		= "";
				 $p_bagian 		= "";
				 $p_password1	= "";				 
			 }else{
				 $pesan = "Data Gagal disimpan";
			 }
		 }
	 }
 }	
?>

<?php 
$judul 		= "Register for GSPE user";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
?>
<script type="text/javascript">
function poto(){
document.getElementById("img").src = document.getElementById("upload").value;
}
</script>
<?php
include("atas.php"); 
?>        
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
<table border="1" cellpadding="10" cellspacing="5" align="center">
<tr>
  <td>
<table border="0" cellpadding="1">
  <tr>
    <td>Number ID</td>
    <td>:</td>
    <td>
    <span id="sprytextfield1">
    <label>
      <input name="no_id" type="text" id="no_id" size="20" value="<?php echo $p_no_id;?>" />
    </label>
    <span class="textfieldMinCharsMsg">6 characters.</span><span class="textfieldMaxCharsMsg">8 characters.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
    </td>
    <td rowspan="10" align="left" valign="top"><!-- <img src="$photo" alt="Photo" name="img" width="139" height="148" id="img" longdesc="$photo" style="border-color:#FC0 !important" border="1"  /> --></td>
  </tr>
  <tr>
    <td>Name</td>
    <td>:</td>
    <td>
    <span id="sprytextfield2">
    <label>
    <input name="nama" type="text" id="nama" size="30" value="<?php echo $p_nama;?>" />
    </label>
    </span>
    </td>
  </tr>
  <tr>
    <td>Department</td>
    <td>:</td>
    <td>
    <span id="sprytextfield3">
    <label>
    <input name="departement" type="text" id="departement" size="30" value="<?php echo $p_dept;?>" />
    </label>
    </span>
    </td>
  </tr>
  <tr>
    <td>Title</td>
    <td>:</td>
    <td>
    <span id="sprytextfield4">
    <label>
    <input name="title" type="text" id="title" size="30" value="<?php echo $p_title;?>" />
    </label>
	</span>
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td>
    <span id="sprytextfield5">
    <label>
    <input name="email" type="text" id="email" size="30" value="<?php echo $p_email;?>"  />
    </label>
    <span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
    </td>
  </tr>
  <tr>
    <td>Mobile Phone</td>
    <td>:</td>
    <td>
    <span id="sprytextfield6">
    <label>
      <input name="telp" type="text" id="telp" size="30" value="<?php echo $p_telp;?>"  />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum  of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum  of characters.</span></label>
    </span>
    </td>
  </tr>
  <tr>
    <td>Extention</td>
    <td>:</td>
    <td>
    <span id="sprytextfield8">
    <label>
      <input name="ext" type="text" id="ext" size="30"  value="<?php echo $p_ext;?>" />
<span class="textfieldMaxCharsMsg">Exceeded maximum  of characters.</span></label>
    </span>
    </td>
  </tr>
  <tr>
    <td>Login Password </td>
    <td>:</td>
    <td>
    <span id="sprypassword1">
    <label>
    <input name="password" type="password" id="password" size="30"  value="<?php echo $p_password1;?>"/>
    </label>
    <span class="passwordMinCharsMsg">Minimum 6 character</span></span>
    </td>
  </tr>
  <tr>
    <td>Confirm </td>
    <td>:</td>
    <td>
    <span id="spryconfirm1">
    <label>
    <input name="konfirmasi" type="password" id="konfirmasi" size="30"  value="<?php echo $p_password1;?>"/>
    </label>
    <span class="confirmInvalidMsg">The values don't match.</span></span>  
    </td>
  </tr>
  <tr>
    <td>Photo</td>
    <td>:</td>
    <td>
    <span id="sprytextfield7">
    <label>
    <input type="file" name="upload" id="upload" onchange="poto()"/>
    </label>
    </span>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>File photo maksimal 200 kb.</td>
    <td align="right">
    <input type="submit" name="submit" id="submit" value="Register" />
  	<input type="reset" name="reset" id="reset" value="Reset" />
    </td>
  </tr>
</table>
</td></tr> 
</table>
</form>
<?php include('bawahb.php');?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:6, maxChars:8});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "integer", {minChars:10, maxChars:13});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {maxChars:6});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");

//-->
</script>
