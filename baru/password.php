<?php
include('palidasi.php'); 
require_once('Connections/konek.php'); 
?>
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

if(isset($_SESSION['MM_Username'])){
$no_id = $_SESSION['MM_Username']; 
mysql_select_db($database_konek, $konek);
$sql = "SELECT * FROM `tb_user` WHERE `no_id` = '$no_id'";
$sqlquery = mysql_query($sql,$konek) or die(mysql_error());
$rowe = mysql_fetch_assoc($sqlquery);
$password = $rowe['password'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
$password0 = md5($_POST['password0']);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
if ($password0 == $password){ 
$updateSQL = sprintf("UPDATE tb_user SET password=%s WHERE no_id=%s",                      
                       GetSQLValueString(md5($_POST['password1']), "text"),                      
                       GetSQLValueString($_POST['no_id'], "text"));
  mysql_select_db($database_konek, $konek);
  $Result1 = mysql_query($updateSQL, $konek) or die(mysql_error());
}else {die( "Password Lama Anda Salah <a href='password.php'>Back</a>");}
}}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Account</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function poto(){
document.getElementById("img").src = document.getElementById("upload").value;
}
//-->
</script>
<style type="text/css">
<!--
b {
	color: #F00;
}
.judul1 {font-size: 12px;
	font-weight: normal;
	color: #999;
	font-family: "Courier New", Courier, monospace;
}
body,td,th {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 10pt;
}
.aa {
	color: #000;
}
-->
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>
<body onload="MM_preloadImages('/img/t_input-usera.jpg','/img/edit_accounta.jpg')"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
<table width="980"  border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td colspan="2"><table width="100%" border="0" cellpadding="0">
    <tr>
      <td><?php include ('header.php')?></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"  background="img/tab_menu.jpg"><?php include("tabs.php"); ?></td>
    </tr>
  </table></td>
  </tr> 
  <tr >
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="1">
          <tr>
            <td valign="top" nowrap="nowrap"><span class="judul1">Change Password</span></td>
            <td align="right" nowrap="nowrap">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><table cellspacing="10"><tr><td><fieldset>
  		<legend>Change Password</legend>
          <table border="0" cellpadding="0" >
            <tr>
              <td width="112" align="left" class="aa">Old Password</td>
              <td width="4" align="center" class="aa">:</td>
              <td width="176" align="left" nowrap="nowrap"><span id="sprytextfield1">
                <label>
                  <input type="password" name="password0" id="password0" />
                </label>
                </span></td>
            </tr>
            <tr>
              <td align="left" class="aa">New Password</td>
              <td align="center" class="aa">:</td>
              <td align="left" nowrap="nowrap"><span id="sprypassword1">
                <label>
                  <input type="password" name="password1" id="password1" />
                </label>
                </span></td>
            </tr>
            <tr>
              <td align="left" nowrap="nowrap" class="aa">Confirm Password</td>
              <td align="center" class="aa">:</td>
              <td align="left" nowrap="nowrap"><span id="spryconfirm1">
                <label>
                  <input type="password" name="password2" id="password2" />
                </label>
               <span class="confirmInvalidMsg">The values don't match.</span></span></td>
            </tr>
            <tr>
      <td align="left" nowrap="nowrap"><input type="hidden" name="no_id" id="no_id" value="<?php echo $no_id; ?>" />
                <input type="hidden" name="MM_update" value="form1" /></td>
              <td align="center">&nbsp;</td>
              <td align="right" nowrap="nowrap"><label>
                <input type="submit" name="Save" id="Save" value="Save" />
                <input type="reset" name="Reset" id="button" value="Reset" />
                </label></td>
            </tr>
            </table></fieldset></td></tr></table></td>
      </tr>
  </table></td></tr> 
  <tr>
    <td colspan="2" align="center"><?php include("foot.php"); ?></td>
  </tr>
</table> </form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password1");
//-->
</script>
</body>
</html>
