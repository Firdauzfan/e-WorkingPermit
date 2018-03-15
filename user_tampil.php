<?php
session_start();	 
$bagian = $_SESSION['bagian'];	
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_user SET nama=%s, password=%s, bagian=%s, email=%s, telp=%s, title=%s, departement=%s WHERE no_id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString(md5($_POST['password']), "text"),
                       GetSQLValueString($_POST['bagian'], "text"),
                       GetSQLValueString($_POST['imel'], "text"),
                       GetSQLValueString($_POST['telp'], "text"),
					    GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['departement'], "text"),
                       GetSQLValueString($_POST['no_id'], "text"));
 
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
}

if(isset($_SESSION['MM_Username'])){
$no_id 		= $_SESSION['MM_Username']; 
$sql 		= "SELECT * FROM `tb_user` WHERE `no_id` = '$no_id'";
$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
$rowe 		= mysql_fetch_assoc($sqlquery);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Account</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style type="text/css">
<!--
b {
	color: #F00;
}
-->
</style>
</head>
<body onload="MM_preloadImages('/img/t_input-usera.jpg','/img/edit_accounta.jpg')">
<table width="980"  border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td colspan="2"><table width="100%" border="0">
    <tr>
      <td><?php include('header.php');?></td>
      </tr>
    <tr>
      <td align="right" valign="bottom"  background="img/tab_menu.jpg"><?php include("tabs.php") ; ?></td>
      </tr>
  </table></td>
  </tr> 
  <tr >
    <td><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="436" align="center">
    <tr>
      <td width="350"><table width="421" border="0">
        
        <tr>
          <td>Number ID</td>
           <td>:</td>
          <td><label><span id="sprytextfield1">
            
              <input name="no_id" type="text" id="no_id" value="<?php echo $no_id; ?>" size="8" readonly="readonly" />
           
            <span class="textfieldRequiredMsg">A value is required.</span></span> </label></td>
        </tr>         
        <tr>
          <td> <label>Name</label></td>
           <td>:</td>
          <td><span id="sprytextfield2">           
              <input name="nama" type="text" id="nama" value="<?php echo $rowe['nama']; ?>" size="20" readonly="readonly" />            
            <br /><span class="textfieldRequiredMsg"></span></span></td>
        </tr>
        <tr>
          <td>Departement</td>
           <td>:</td>
            <td><span id="sprytextfield6">
              <label>
                <input name="departement" type="text" id="departement" value="<?php echo $rowe['departement']; ?>" />
              </label>
             </span></td>
          </tr>
        <tr>
          <td width="116">Email</td>
          <td width="5">:</td>
          <td width="296"><span id="sprytextfield3">
          <label>
            <input name="imel" type="text" id="imel" value="<?php echo $rowe['email']; ?>" size="23" />
          </label>
          <br><span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
        </tr>
        <tr>
          <td>Phone</td>
           <td>:</td>
          <td width="296"><span id="sprytextfield4">
            <label>
              <input name="telp" type="text" id="telp" value="<?php echo $rowe['telp']; ?>" size="15" />
              </label>
          </span></td>
        </tr>
        <tr>
          <td>Title</td>
          <td>:</td>
          <td><span id="sprytextfield5">
            <label>
              <input name="title" type="text" id="title" value="<?php echo $rowe['title']; ?>" size="20" />
            </label>
            </span></td>
        </tr>
        <tr>
          <td>Login Status</td>
          <td>:</td>
          <td><label>
            <input name="bagian" type="text" id="bagian" value="<?php echo $rowe['bagian']; ?>" size="23" readonly="readonly" />
          </label></td>
        </tr>
        <tr>
          <td>New Password</td>
           <td>:</td>
          <td><span id="sprypassword1">
          <label>
            <input name="password" type="password" id="password" size="12" />
          </label>
          <span class="passwordInvalidStrengthMsg">Minimal 6 Karakter.</span><span class="passwordMinCharsMsg">
          Minimum 6 karakte</span></span></td>
        </tr>
        <tr>
          <td>Confirm</td>
           <td>:</td>
          <td><span id="spryconfirm1">
            <label>
              <input name="password2" type="password" id="password2" size="12" />
            </label>
            <span class="confirmInvalidMsg">The values don't matc</span></span></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
           <td>&nbsp;</td>
          <td align="right"><label>
            <input type="submit" name="simpan" id="simpan" value="Save" />
          </label> <input name="batal" type="reset" value="Cancel" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
    </form>
  <tr>
    <td colspan="2" align="center"><?php include("foot.php"); ?></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
//-->
</script>
</body>
</html>
