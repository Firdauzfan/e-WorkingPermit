<?php
include('palidasi.php'); 
$pesan = '';
if ((isset($_POST["no_id"])) && ($_POST["no_id"] != "")){
	$p_noid		= $_POST['no_id'];
	$p_nama		= $_POST['nama'];
	$p_email 	= $_POST['imel'];
	$p_telp 	= $_POST['telp'];
	$p_ext	 	= $_POST['ext'];
	$p_title 	= $_POST['title'];
	$p_dept 	= $_POST['departement'];
	$fileName 	= $_FILES['upload']['name'];  
	$fileSize 	= $_FILES['upload']['size'];
	$tmpName  	= $_FILES['upload']['tmp_name'];
	$fileType 	= $_FILES['upload']['type'];	

 if ($fileName == '' || $fileSize == 0){ 
	 $updateSQL = "UPDATE tb_user SET  email='$p_email', telp='$p_telp', ext='$p_ext', title='$p_title', departement='$p_dept' WHERE
	 no_id='$s_userid'";
	 $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
	 $pesan = "Data berhasil disimpan";
 }else{		
	//penamaan photo
	$tglupload 	= gmdate('ymdHis',time()+60*60*7);
	$fileName	= explode(" ", $fileName);
	$fileName 	= implode("", $fileName);
	//hitung jumlah karakter nama file
	$lenname 	= strlen($fileName);
	//pemotongan nama file
	if ($lenname > 20){
		$maxname 	= 20;
		$resname 	= $lenname - $maxname;
		$cutname 	= substr($fileName,$resname,$maxname);
		$fileName 	= $cutname;
	}
	//edit nama user yang diinput
	$ex_nama	= explode(" ", $p_nama);
	$im_nama	= implode("", $ex_nama);	
	
	//Folder tujuan penyimpanan file	
	$nama_poto	= $im_nama."_".$p_noid."_".$tglupload."_".$fileName;
	$uploadfile	= "/poto/".$nama_poto;
	$tempatfile = "../wp1/".$uploadfile;		
	
	//nama file yang disimpan di database
	$photo 		= $uploadfile;
	$typefile 	= substr($fileType,0,5);
	
	$upload = move_uploaded_file($tmpName, $tempatfile);
	if (!$upload){
		$pesan = " Upload file gagal";
	}elseif($fileSize > 200000){
		 $pesan = "Ukuran file Photo maksimal 200 kb";
	}else{
		$updateSQL = "UPDATE tb_user SET  email='$p_email', telp='$p_telp', ext='$p_ext', title='$p_title', departement='$p_dept',
		photo='$uploadfile' WHERE no_id='$s_userid'";
		$Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());		
		$pesan = "Data berhasil disimpan";
	}
 }
}	

$sql1 ="select value from tb_config where path='path'";
$r = mysql_query($sql1);
$d = mysql_fetch_array($r);
$path = $d['value'];

$sql 			= "SELECT * FROM tb_user where no_id = '$s_userid'";
$sql_query 		= mysql_query($sql,$konek) or die(mysql_error());
$rowe 			= mysql_fetch_assoc($sql_query);
$poto 			= $rowe['photo'];
$bagian			= $rowe['bagian'];
$photo 			= $path."/".$poto;
if ($bagian == "Departement"){
	$bagian = "Department In Charge";
}else{			
	$bagian = $rowe['bagian'];
}
?>

<?php 
$judul 		= "Update Account";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
include('fancy.php');
?>        
<script type="text/javascript">
function poto(){
	document.getElementById("img").src = document.getElementById("upload").value;
}
</script>
<?php include("atas.php"); ?>
<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
 <table border="1" cellpadding="5" cellspacing="10" align="center">
      <tr>
       <td><table border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td width="100">Number ID</td>
        <td width="10">:</td>
        <td><label><span id="sprytextfield1">
          <input name="no_id" type="text" id="no_id" value="<?php echo $s_userid; ?>" size="15" readonly />
        </span> </label></td>
        <td rowspan="9" align="left" valign="top">
        <img  name="img" id="img" class ="classfancy" src="<?php echo $photo; ?>" href = "<?php echo $photo; ?>" title="<?php echo $rowe['nama']; ?>" width="137" height="160" border="1" style="border-color:#FC9" /></td>
      </tr>
      <tr>
        <td><label>Name</label></td>
        <td align="left">:</td>
        <td><span id="sprytextfield2">
          <input name="nama" type="text" id="nama" value="<?php echo ucwords(strtolower($rowe['nama'])); ?>" size="30" readonly />         
        </span></td>
</tr>
      <tr>
        <td>Department</td>
        <td align="left">:</td>
        <td><span id="sprytextfield6">
          <input name="departement" type="text" id="departement" size="30" value="<?php echo ucwords($rowe['departement']); ?>"/>         
</span></td>
</tr>
      <tr>
        <td>Email</td>
        <td align="left">:</td>
        <td><span id="sprytextfield3">
          <input name="imel" type="text" id="imel" value="<?php echo strtolower($rowe['email']); ?>" size="30" />          
          <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
</tr>
      <tr>
        <td>Mobile </td>
        <td align="left">:</td>
        <td><span id="sprytextfield4">
          <input name="telp" type="text" id="telp" value="<?php echo $rowe['telp']; ?>" size="30" />          
          <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span> </span></td>
</tr>
 		<tr>
          <td align="left">Ext</td>
          <td>:</td>
          <td align="left"><span id="sprytextfield8">
            <label>
              <input name="ext" type="text" id="ext" size="30" value="<?php echo $rowe['ext'];?>" />
              <span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></label>
          </span></td>
</tr>
      <tr>
        <td>Title</td>
        <td align="left">:</td>
        <td><span id="sprytextfield5">
          <input name="title" type="text" id="title" value="<?php echo ucwords($rowe['title']); ?>" size="30" />         
</span></td>
</tr>
      <tr>
        <td>Login Status</td>
        <td align="left">:</td>
        <td><input name="bagian" type="text" id="bagian" value="<?php echo $bagian; ?>" size="30" readonly /></td>
      </tr>
      <tr>
        <td>Photo</td>
        <td align="left">:</td>
        <td nowrap="nowrap"><input type="file" name="upload" id="upload" onChange="poto()"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>File photo maksimal 200 kb.</td>
        <td align="right"><input type="submit" name="simpan" id="simpan" value="Update Account" /></td>
      </tr>      
    </table></td>
  </tr>
</table>
</form>
<?php include("bawahb.php"); ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {minChars:10, maxChars:13});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {minChars:10, maxChars:40});

var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {maxChars:6});
</script>

             
