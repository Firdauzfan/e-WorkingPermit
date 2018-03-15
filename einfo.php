<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
require_once('Connections/konek.php');
if ($s_bagian != 'Admin'){ header('Location: '.'login.php');}

$sql 		= "SELECT * FROM tb_info WHERE lok = '$tempat'";	
$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
$hasil 		= mysql_fetch_assoc($sqlquery);	

if ($hasil && !isset($_POST['lantaifm'])){
	$lantaifm 	= $hasil['lantaifm'];	
	$ketfm 		= $hasil['ketfm'];
	$extfm 		= $hasil['extfm'];
	$lantaimt 	= $hasil['lantaimt'];	
	$ketmt 		= $hasil['ketmt'];
	$extmt 		= $hasil['extmt'];
	$lantaiib 	= $hasil['lantaiib'];	
	$ketib		= $hasil['ketib'];
	$extib 		= $hasil['extib'];
	$lantaist 	= $hasil['lantaist'];	
	$ketst		= $hasil['ketst'];
	$extst 		= $hasil['extst'];	
}

if (isset($_POST['lantaifm']) and $_POST['lantaifm'] != ''){	
	$lantaifm 	= $_POST['lantaifm'];	
	$ketfm 		= $_POST['ketfm'];
	$extfm 		= $_POST['extfm'];
	$lantaimt 	= $_POST['lantaimt'];	
	$ketmt 		= $_POST['ketmt'];
	$extmt 		= $_POST['extmt'];
	$lantaiib 	= $_POST['lantaiib'];	
	$ketib		= $_POST['ketib'];
	$extib 		= $_POST['extib'];
	$lantaist 	= $_POST['lantaist'];	
	$ketst		= $_POST['ketst'];
	$extst 		= $_POST['extst'];	
	
	$query1 = "UPDATE tb_info SET lantaifm = '$lantaifm', ketfm = '$ketfm' , extfm = '$extfm', lantaimt = '$lantaimt',
	ketmt = '$ketmt', extmt = '$extmt', lantaiib = '$lantaiib', ketib = '$ketib', extib = '$extib', lantaist = '$lantaist',
	ketst = '$ketst', extst = '$extst' WHERE lok='$tempat'";
	$pesan		= 'Data Berhasil disimpan';
	$result1 = mysql_query($query1, $konek) or die(mysql_error());   
}
	
	 
                  
?>
<?php 
$judul 		= "Info Settings";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
include("atas.php"); 
?>
<form action="" method="post" name="form1" id="form1">
<table border="1" cellpadding="5" cellspacing="10" align="center">
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="3" cellpadding="1">
  <tr>
    <td colspan="3" class="e_imfo">Facility Department</td>
    <td>&nbsp;</td>
    <td colspan="3" class="e_imfo">In Building</td>
    </tr>
  <tr>
    <td>Lantai</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield1">
    <input name="lantaifm" type="text" id="lantaifm" size="30" value = "<?php echo $lantaifm ?>" /></span>
    </td>
    <td>&nbsp;</td>
    <td>Lantai</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield2">
    <input name="lantaiib" type="text" id="lantaiib" size="30"  value = "<?php echo $lantaiib ?>"/></span></td>
  </tr>
  <tr>
    <td>Ruangan</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield3">
    <input type="text" size = "30" name="ketfm" id="ketfm"  value = "<?php echo $ketfm ?>"/></span></td>
    <td>&nbsp;</td>
    <td>Ruangan</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield4">
    <input type="text" name="ketib" id="ketib" size="30"  value = "<?php echo $ketib ?>"/></span></td>
  </tr>
  <tr>
    <td>Extension</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield5">
    <input name="extfm" type="text" id="extfm"  value = "<?php echo $extfm ?>" size="30"/></span></td>
    <td>&nbsp;</td>
    <td>Extension</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield6">
    <input name="extib" type="text" id="extib"  value = "<?php echo $extib ?>" size="30"/></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="e_imfo">Maintenance</td>
    <td>&nbsp;</td>
    <td colspan="3" class="e_imfo"><h5>Security</td>
    </tr>
  <tr>
    <td>Lantai</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield7">
    <input name="lantaimt" type="text" id="lantaimt" size="30"  value = "<?php echo $lantaimt ?>"/></span></td>
    <td>&nbsp;</td>
    <td>Lantai</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield8">
    <input name="lantaist" type="text" id="lantaist" size="30"  value = "<?php echo $lantaist ?>"/></span></td>
  </tr>
  <tr>
    <td>Ruangan</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield9">
    <input type="text" name="ketmt" id="ketmt" size="30" value = "<?php echo $ketmt ?>"/></span></td>
    <td>&nbsp;</td>
    <td>Ruangan</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield10">
    <input type="text" name="ketst" id="ketst"  size="30"value = "<?php echo $ketst ?>"/></span></td>
  </tr>
  <tr>
    <td>Extension</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield11">
    <input name="extmt" type="text" id="extmt" value = "<?php echo $extmt ?>" size="30" /></span></td>
    <td>&nbsp;</td>
    <td>Extension</td>
    <td>&nbsp;</td>
    <td><span id="sprytextfield12">
    <input name="extst" type="text" id="extst"  value = "<?php echo $extst ?>" size="30"/></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><input type="submit" name="button" id="button" value="Save..." /></td>
  </tr>
</table>
            </td>
          </tr>
        </table>
</form>
<?php include("bawahb.php");?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
//-->
</script>