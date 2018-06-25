<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
session_start();
if(isset($_SESSION['userid'])){
	unset($_SESSION['userid']);
	session_destroy();
}

if (isset($_POST['txtuser'])){
	require("p_login.php");	
}
?>
<?php 
$judul 		= "Login";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
?>        
<script type="text/javascript">
      $(document).ready(function() {
		  $("#txtuser").focus();
  	    $(':input:not([type="submit"]):not([type="reset"])').each(function() {
	        $(this).focus(function() {
	            $(this).addClass('hilite');
	        }).blur(function() {
	            $(this).removeClass('hilite');});
	     });
      });    
</script>
<?php include('atas.php');?>
<form id="form1" name="form1" method="post" action=""> 
<table width="300" border="0" align="center" cellpadding="2" cellspacing="0" >
  <tr>
    <th height="4" colspan="3" align="center" valign="bottom"> <strong>
      <hr width="100%" />
      User Login
      <hr width="100%" />
    </strong></th>
  </tr>
  <tr>
    <td width="19" >&nbsp;</td>
    <td width="96" align="left">User ID</td>
    <td width="173" align="left"><input name="txtuser" type="text" id="txtuser" size="20" 
    value="<?php echo $userid;?>" autocomplete="off" /></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td align="left">Password</td>
    <td align="left"><input name="txtpasswd" type="password" id="txtpasswd" size="20" /></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><hr width="100%" />
      <input type="submit" name="login" id="login" value="Login" onclick="show_alert()" />
      <input type="reset" name="batal" id="batal" value="Cancel" /></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><hr width="100%" /></td>
  </tr>
</table>
</form>
<?php include('bawah.php');?>
