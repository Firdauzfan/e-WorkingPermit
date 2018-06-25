<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin'){ header('Location: '.'login.php');}
require_once('Connections/konek.php'); 
$pesan = "";

 if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	 
	 $p_no_id 		= $_POST['no_id'];
	 $p_nama 		= $_POST['nama'];
	 $p_dept 		= $_POST['departement'];
	 $p_email 		= $_POST['email'];
	 $p_telp 		= $_POST['telp'];
	 $p_ext 		= $_POST['ext'];
	 $p_title 		= $_POST['title'];
	 $p_bagian 		= $_POST['bagian'];
	 $p_password	= md5($_POST['password']);	
	 $p_password1	= $_POST['password'];	 

	 $ipkom			= @$_SERVER['REMOTE_ADDR'].'_'.gethostbyaddr(@$_SERVER['REMOTE_ADDR']);
	 
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
	 $tempatfile 	= "../wp1/".$uploadfile;	
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
		 $sql 			= "SELECT * FROM `tb_user` WHERE `no_id` = '$p_no_id'";
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
			 (no_id, nama, email, password, telp, bagian, departement, photo, lokasi, title, reg_from, reg_time, ext, app_by, app_time,
			 app_from) 
			 VALUES
			 ('$p_no_id','$p_nama','$p_email','$p_password', '$p_telp', '$p_bagian', '$p_dept', '$photo', '$tempat', '$p_title',
			 '$ipkom', '$time', '$p_ext', '$s_userid', '$time', '$ipkom')";   
			 
			 $Result1 = mysql_query($sql, $konek) or die(mysql_error());
			 if($Result1){
				 $pesan 		= "Data Berhasil disimpan";
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
$judul 		= "Input User";
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
<form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <table border="1" cellpadding="10" cellspacing="5" align="center">
    <tr>
      <td><table border="0" cellpadding="1">
        <tr>
          <td align="left">Number ID</td>
          <td>:</td>
          <td align="left"><label><span id="sprytextfield1">
            <input name="no_id" type="text" id="no_id" size="20" value="<?php echo $p_no_id;?>" />
            <span class="textfieldInvalidFormatMsg">Diisi dengan Angka</span><span class="textfieldMinCharsMsg">8 Karakter</span><span class="textfieldMaxCharsMsg">8 Karakter</span></span></label></td>
          <td rowspan="11" align="left" valign="top"><img src="$photo" alt=""  name="img" width="168" height="187" id="img" border="1" style="border-color:#FC9" /></td>
        </tr>
        <tr>
          <td align="left"><label>Name</label></td>
          <td>:</td>
          <td align="left"><span id="sprytextfield2">
            <input name="nama" type="text" id="nama" size="30" value="<?php echo $p_nama;?>" />
          </span></td>
        </tr>
        <tr>
          <td align="left">Departement</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield6">
            <label>
              <input name="departement" type="text" id="departement" size="30" value="<?php echo $p_dept;?>" />
            </label>
          </span></td>
        </tr>
        <tr>
          <td align="left">Email</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield3">
            <label>
              <input name="email" type="text" id="email" size="30" value="<?php echo $p_email;?>"/>
            </label>
            <span class="textfieldInvalidFormatMsg">Format email salah.</span></span></td>
        </tr>
        <tr>
          <td align="left">Mobile</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield4">
            <label>
              <input name="telp" type="text" id="telp" size="30" value="<?php echo $p_telp;?>" />
              <span class="textfieldInvalidFormatMsg">Nomor Handphone Salah.</span><span class="textfieldMinCharsMsg">Nomor Handphone Salah.</span><span class="textfieldMaxCharsMsg">Nomor Handphone Salah.</span></label>
          </span></td>
        </tr>
        <tr>
          <td align="left">Ext</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield8">
            <label>
              <input name="ext" type="text" id="ext" size="30" value="<?php echo $p_ext;?>" />
            </label>
          </span></td>
        </tr>
        <tr>
          <td align="left">Title</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield5">
            <label>
              <input name="title" type="text" id="title" size="30" value="<?php echo $p_title;?>" />
            </label>
          </span></td>
        </tr>
        <tr>
          <td align="left">Login Status</td>
          <td>:</td>
          <td align="left"><span id="spryselect1">
            <label>
              <select name="bagian" id="bagian" >
                <option value="<?php echo $p_bagian;?>"><?php echo $p_bagian;?></option>
                <option value="In Building">In Building</option>
                <option value="Facility Management">Facility Management</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Security">Security</option>
              </select>
            </label>
          </span></td>
        </tr>
        <tr>
          <td width="120" align="left" nowrap="nowrap">Password</td>
          <td>:</td>
          <td align="left"><span id="sprypassword1">
            <label>
              <input name="password" type="password" id="password" size="30" value="<?php echo $p_password1;?>" />
            </label>
            <span class="passwordInvalidStrengthMsg">Minimal 6 Karakter.</span><span class="passwordMinCharsMsg">Minimal 6 Karakter.</span></span></td>
        </tr>
        <tr>
          <td align="left">Confirm</td>
          <td>:</td>
          <td align="left"><span id="spryconfirm1">
            <label>
              <input name="password2" type="password" id="password2" size="30" value="<?php echo $p_password1;?>" />
            </label>
            <span class="confirmInvalidMsg">Konfirmasi Password Salah</span></span></td>
        </tr>
        <tr>
          <td align="left">Photo</td>
          <td>:</td>
          <td align="left" nowrap="nowrap"><span id="sprytextfield7">
            <input type="file" name="upload" id="upload" onchange="poto()"/>
          </span></td>
        </tr>
        <tr>
          <td><input type="hidden" name="MM_insert" value="form1" /></td>
          <td>&nbsp;</td>
          <td>File photo maksimal 200 kb.</td>
          <td align="right"><label>
            <input type="submit" name="simpan" id="simpan" value="Save" />
          </label>
            <input name="batal" type="reset" value="Cancel" /></td>
        </tr>
      </table></td>
    </tr>
  </table>  
</form>
<?php include('bawahb.php');?>
<script type="text/javascript">
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"0"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {minChars:10, maxChars:13});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email" );
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:3});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:8, maxChars:8});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {minChars:2});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none");
</script>