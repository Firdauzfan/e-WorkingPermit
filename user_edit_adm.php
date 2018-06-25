<?php
include('palidasi.php'); 
require_once('Connections/konek.php'); 
$pesan = '';
if ((isset($_POST["password1"])) && ($_POST["password2"] != "")){
	$gp_no_id 	= $_POST['no_id'];	
	$new_passwd	= md5($_POST["password1"]);
	
	if ($_POST["password1"] == $_POST["password2"]){
		$sql_update = "UPDATE tb_user SET  password='$new_passwd', salah = 0 WHERE no_id='$gp_no_id'";
		$Result 	= mysql_query($sql_update, $konek) or die(mysql_error());
		$pesan 		= "Reset Password Sukses";
	}else{
		$pesan 		= "Konfirmasi Password Salah";
	}
}	
if (isset($_GET['no_id'])){
	$gp_no_id	= $_GET['no_id'];
}else{
	$gp_no_id	= $_POST['no_id'];
}
	

$sql 			= "SELECT * FROM tb_user where no_id = '$gp_no_id'";
$sql_query 		= mysql_query($sql,$konek) or die(mysql_error());
$rowe 			= mysql_fetch_assoc($sql_query);
$poto 			= $rowe['photo'];
$bagian			= $rowe['bagian'];
$photo 			= "../wp1/".$poto;

if ($bagian == "Departement"){
	$bagian = "Department In Charge";
}else{			
	$bagian = $rowe['bagian'];
}
?>

<?php 
$judul 		= "Reset Password User";
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
<?php include("atasb.php"); ?>
<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
 <table border="1" cellpadding="5" cellspacing="10" align="center">
      <tr>
       <td><table border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td width="100">Number ID</td>
        <td width="10">:</td>
        <td><label><span id="sprytextfield1">
          <input name="no_id" type="text" id="no_id" value="<?php echo $gp_no_id; ?>" size="15" readonly />
        </span> </label></td>
        <td rowspan="10" align="center" valign="top"><img class ="classfancy" href ="<?php echo $photo; ?>" src="<?php echo $photo; ?>" title="<?php echo $rowe['nama']; ?>"  name="img" width="149" height="160" border="1" id="img" style="border-color:#FC9" /></td>
      </tr>
      <tr>
        <td><label>Name</label></td>
        <td align="left">:</td>
        <td><input name="nama" type="text" id="nama" value="<?php echo $rowe['nama']; ?>" size="30" readonly /></td>
       </tr>
      <tr>
        <td>Department</td>
        <td align="left">:</td>
        <td><input name="departement" type="text" id="depar" size="30" value="<?php echo $rowe['departement']; ?>" readonly /></td>
      </tr>
      <tr>
        <td>Email</td>
        <td align="left">:</td>
        <td><input name="imel" type="text" id="imel" value="<?php echo $rowe['email']; ?>" size="30" readonly /></td>
      </tr>
      <tr>
        <td>Mobile </td>
        <td align="left">:</td>
        <td><input name="telp" type="text" id="telp" value="<?php echo $rowe['telp']; ?>" size="30" readonly /></td>
      </tr>
 		<tr>
          <td align="left">Ext</td>
          <td>:</td>
          <td align="left"><input name="ext" type="text" id="ext" size="30" value="<?php echo $rowe['ext'];?>" readonly /></td>
        </tr>
      <tr>
        <td>Title</td>
        <td align="left">:</td>
        <td><input name="title" type="text" id="title" value="<?php echo $rowe['title']; ?>" size="30" readonly /></td>
      </tr>
      <tr>
        <td>Login Status</td>
        <td align="left">:</td>
        <td><input name="bagian" type="text" id="bagian" value="<?php echo $bagian; ?>" size="30" readonly /></td>
      </tr>
      <tr>
        <td>New Password</td>
        <td align="left">:</td>
        <td nowrap="nowrap"><span id="sprytextfield2">
        <input name="password1" type="text" id="password1" value="<?php echo $_POST['password1']; ?>" size="30" /></span></td>
      </tr>
      <tr>
        <td nowrap="nowrap">Confirm Password</td>
        <td align="left">:</td>
        <td nowrap="nowrap"><span id="sprytextfield3">
        <input name="password2" type="text" id="password2" value="<?php echo $_POST['password2']; ?>" size="30" /></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><input type="submit" name="simpan" id="simpan" value="Change Password" /></td>
      </tr>      
    </table></td>
  </tr>
</table>
</form>
<?php include("bawahb.php"); ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:8});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:6});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:6});
</script>

             
